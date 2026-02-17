<?php
use Components\Product\Product;

add_action("init", "register_product_post_type");

function register_product_post_type() {
	// --- post type ------------------------

	$labels = [
		"name" => __("Produkty", "PD_ADMIN_DOMAIN"),
		"singular_name" => __("Produkt", "PD_ADMIN_DOMAIN"),
		"add_new" => __("Přidat produkt", "PD_ADMIN_DOMAIN"),
		"add_new_item" => __("Přidat nový produkt", "PD_ADMIN_DOMAIN"),
		"edit_item" => __("Změnit produkt", "PD_ADMIN_DOMAIN"),
		"new_item" => __("Nový produkt", "PD_ADMIN_DOMAIN"),
		"view_item" => __("Zobrazit produkt", "PD_ADMIN_DOMAIN"),
		"all_items" => __("Všechny produkty", "PD_ADMIN_DOMAIN"),
		"search_items" => __("Hledat produkty", "PD_ADMIN_DOMAIN"),
		"not_found" => __("Žádné produkty nenalezeny", "PD_ADMIN_DOMAIN"),
		"not_found_in_trash" => __("Žádné produkty v koši", "PD_ADMIN_DOMAIN"),
		"menu_name" => __("Produkty", "PD_ADMIN_DOMAIN"),
	];

	$args = [
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"capability_type" => KT_WP_POST_KEY,
		"query_var" => true,
		"rewrite" => ["slug" => Product::SLUG, "with_front" => false],
		"has_archive" => false,
		"hierarchical" => false,
		"menu_position" => 4,
		"menu_icon" => "dashicons-cart",
		"supports" => [
			KT_WP_POST_TYPE_SUPPORT_TITLE_KEY,
			KT_WP_POST_TYPE_SUPPORT_EDITOR_KEY,
			KT_WP_POST_TYPE_SUPPORT_THUMBNAIL_KEY,
			KT_WP_POST_TYPE_SUPPORT_PAGE_ATTRIBUTES_KEY,
			KT_WP_POST_TYPE_SUPPORT_EXCERPT_KEY,
		],
	];

	register_post_type(Product::KEY, $args);
}
