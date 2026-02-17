<?php

use Utils\Util;
use Components\ThemeSettings\ThemeSettingsFactory;
use Components\Product\Product;

// Add to cart AJAX calls
add_action("wp_ajax_get_header_cart_info", "get_header_cart_info");
add_action("wp_ajax_nopriv_get_header_cart_info", "get_header_cart_info");

function get_header_cart_info()
{
	if (KT::issetAndNotEmpty($_REQUEST)) {
		die(get_template_part(COMPONENTS_PATH . "HeaderEshop/HeaderEshopCart"));
	}

	die(wp_send_json_error(__('Nastala neočekávaná chyba, zkuste to, prosím, za chvíli.', 'PD_ADMIN_DOMAIN')));
}

add_action("wp_ajax_add_product_to_cart", "add_product_to_cart");
add_action("wp_ajax_nopriv_add_product_to_cart", "add_product_to_cart");

function add_product_to_cart()
{
	if (KT::issetAndNotEmpty($_REQUEST)) {
		$inputType = INPUT_POST;
		$data = filter_input_array($inputType);

		$productId = (int) $data['productId'];
		$quantity = (int) $data['quantity'];
		$variationId = (int) $data['variationId'];
		$variationParams = $data['variationParams'];

		if (!\KT::issetAndNotEmpty($variationParams)) {
			$variationParams = [];
		}

		WC()->cart->add_to_cart($productId, $quantity, $variationId, $variationParams);
		die();
	}

	die(wp_send_json_error(__('Nastala neočekávaná chyba, zkuste to, prosím, za chvíli.', 'PD_ADMIN_DOMAIN')));
}

// --- YOAST: breadcrumb ------------------------

//add_filter("wpseo_breadcrumb_links", "wpseo_breadcrumb_product_links_action");

function wpseo_breadcrumb_product_links_action($links)
{
	if (is_tax(Product::KEY)) {
		$Theme = ThemeSettingsFactory::create();
		$pageId = $Theme->getImportantPagesEshopId();

		$archive = [
			'text' => get_the_title($pageId),
			'url' => get_the_permalink($pageId),
			'allow_html' => TRUE
		];

		array_splice($links, 1, 0, [$archive]);
	}

	return $links;
}

// --- rewrite ---------------------------
// @url http://www.codeinhouse.com/remove-slug-from-custom-post-type-in-wordpress/

//add_filter("post_type_link", "product_link_filter", 99, 2);

function product_link_filter($post_link, $post)
{
	if ($post->post_type === Product::KEY && $post->post_status === "publish") {
		$post_link = str_replace("/{$post->post_type}/", "/", $post_link);
	}
	return $post_link;
}

//add_action("pre_get_posts", "product_pre_get_posts_action");

function product_pre_get_posts_action($query)
{
	if (!$query->is_main_query() || count($query->query) !== 2 || !isset($query->query[KT_WP_PAGE_KEY])) {
		return;
	}
	if (!empty($query->query["name"])) {
		$query->set("post_type", [KT_WP_POST_KEY, KT_WP_PAGE_KEY, Product::KEY]);
	}
}

//add_filter("pre_handle_404", "product_pre_handle_404_filter", 99, 2);

function product_pre_handle_404_filter($preempt, WP_Query $wp_query)
{
	global $wp;
	if ($wp_query->get("post_type") === Product::KEY) {
		if (Util::stringStartsWith($wp->request, Product::KEY . "/")) {
			$wp_query->set_404();
			return true;
		}
	}
	return $preempt;
}

// New stock status
/* adding stock option */

function add_custom_stock_status()
{
?>
	<script type="text/javascript">
		jQuery(function() {
			jQuery('._stock_status_field').not('.custom-stock-status').remove();
		});
	</script>
<?php

	woocommerce_wp_select(array('id' => '_stock_status', 'wrapper_class' => 'hide_if_variable custom-stock-status', 'label' => __('Stock status', 'woocommerce'), 'options' => array(
		'instock' => __('In stock', 'woocommerce'),
		'outofstock' => __('Out of stock', 'woocommerce'),
		'onbackorder' => __('On backorder', 'woocommerce'),
		'atsupplier' => __('Skladem u dodavatele', 'PD_ADMIN_DOMAIN'),
	), 'desc_tip' => true, 'description' => __('Controls whether or not the product is listed as "in stock" or "out of stock" on the frontend.', 'woocommerce')));
}

add_action('woocommerce_product_options_stock_status', 'add_custom_stock_status');

add_filter('woocommerce_product_stock_status_options', 'add_variant_custom_stock_status');

function add_variant_custom_stock_status($statuses)
{
	$statuses['atsupplier'] = __('Skladem u dodavatele', 'PD_ADMIN_DOMAIN');

	return $statuses;
}

function save_custom_stock_status($product_id)
{
	update_post_meta($product_id, '_stock_status', wc_clean($_POST['_stock_status']));
}

add_action('woocommerce_process_product_meta', 'save_custom_stock_status', 99, 1);

function woocommerce_get_custom_availability($data, $product)
{
	switch ($product->get_stock_status()) {
		case 'instock':
			$data = array('availability' => __('In stock', 'woocommerce'), 'class' => 'in-stock');
			break;
		case 'outofstock':
			$data = array('availability' => __('Out of stock', 'woocommerce'), 'class' => 'out-of-stock');
			break;
		case 'onbackorder':
			$data = array('availability' => __('On backorder', 'woocommerce'), 'class' => 'available-on-backorder');
			break;
		case 'atsupplier':
			$data = array('availability' => __('Skladem u dodavatele', 'PD_ADMIN_DOMAIN'), 'class' => 'at-supplier');
			break;
	}
	return $data;
}

add_action('woocommerce_get_availability', 'woocommerce_get_custom_availability', 10, 2);

// Set correct stoct status for variable products
add_action('save_post', 'kt_rlg_set_variable_product_stoct_status_callback', 10, 2);

function kt_rlg_set_variable_product_stoct_status_callback($postId, $post)
{
	if ($post->post_type === Product::KEY) {
		$product = wc_get_product($postId);

		if ($product->get_type() === \Components\Product\ProductModel::PRODUCT_TYPE_VARIABLE) {
			$status = \Components\Product\ProductModel::getVariableProductStockStatus($product);
			update_post_meta($postId, \Components\Product\ProductModel::PRODUCT_META_STOCK_STATUS_KEY, $status);
		}
	}
}
