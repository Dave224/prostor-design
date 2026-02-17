<?php

// Change shipping price to string
add_filter('woocommerce_cart_shipping_method_full_label', 'kt_pp_woocommerce_change_shipping_price', 100, 2);

function kt_pp_woocommerce_change_shipping_price($label, $method)
{
	if ($method->cost === 0) {
		$label = $method->label . ': <span class="woocommerce-Price-amount amount">' . __('Zdarma', 'PD_ADMIN_DOMAIN') . '</span>';
	}

	return $label;
}
