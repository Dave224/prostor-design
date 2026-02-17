<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.4.0
 */
if (!defined('ABSPATH')) {
	exit;
}
?>

<?php
// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

$order_button_text = __('Objednat', 'PD_ADMIN_DOMAIN');
?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

	<section class="checkout-section-wrapper">
		<section class="checkout-section js-checkout-section">
			<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

				<?php do_action('woocommerce_review_order_before_shipping'); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action('woocommerce_review_order_after_shipping'); ?>

			<?php endif; ?>

			<?php woocommerce_checkout_payment(); ?>
			<div class="eshop-cart-buttons">
				<a class="button-back previous-step" href="<?= wc_get_cart_url(); ?>"><strong><?php _e('Zpět do košíku', 'PD_ADMIN_DOMAIN'); ?></strong></a>
				<button type="button" class="js-change-checkout-section next-step" data-index="2"><?php _e('Zadat údaje', 'PD_ADMIN_DOMAIN'); ?></button>
			</div>
		</section>
		<section class="checkout-section js-checkout-section">
			<?php /* Fields */ ?>
			<?php if ($checkout->get_checkout_fields()) : ?>

				<?php do_action('woocommerce_checkout_before_customer_details'); ?>

				<div class="col2-set" id="customer_details">
					<div class="col-1">
						<?php do_action('woocommerce_checkout_billing'); ?>
					</div>

					<div class="col-2">
						<?php do_action('woocommerce_checkout_shipping'); ?>
					</div>
				</div>

				<?php do_action('woocommerce_checkout_after_customer_details'); ?>

				<?php /* Terms + button */ ?>
				<div class="form-row place-order">
					<noscript>
						<?php
						/* translators: $1 and $2 opening and closing emphasis tags respectively */
						printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
						?>
						<br /><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
					</noscript>

					<?php wc_get_template('checkout/terms.php'); ?>

					<?php do_action('woocommerce_review_order_before_submit'); ?>

					<div class="eshop-cart-buttons">
						<button type="button" class="js-change-checkout-section previous-step" data-index="1"><?php _e('Zpět na platbu a dopravu', 'PD_ADMIN_DOMAIN'); ?></button>
						<?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="button alt next-step" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); // @codingStandardsIgnoreLine
						?>
					</div>

					<?php do_action('woocommerce_review_order_after_submit'); ?>

					<?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
				<?php endif; ?>
		</section>
	</section>
</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

<style>
	.checkout-section-wrapper .checkout-section {
		display: none;
	}

	.show-login-option {
		display: none;
	}

	.checkout-section-wrapper .checkout-section:first-child {
		display: block
	}
</style>
