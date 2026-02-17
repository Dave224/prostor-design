<ul class="eshop-cart-nav">
    <li>
        <a class="eshop-cart-nav-item <?php if (is_cart()) { ?>active<?php } ?>" href="<?= wc_get_cart_url(); ?>">
            <span class="eshop-cart-nav-num">1</span> <?php _e('Košík', 'PD_ADMIN_DOMAIN'); ?>
        </a>
    </li>
    <li>
        <a class="cart-nav-transport eshop-cart-nav-item <?php if (is_checkout()) { ?>js-change-checkout-section-nav<?php } ?> <?php if (is_checkout()) { ?>active<?php } ?>" <?php if (is_checkout()) { ?>data-index="1" <?php } ?> <?php if (is_cart()) { ?>href="<?= wc_get_checkout_url(); ?>" <?php } else { ?>href="" <?php } ?>>
            <span class="eshop-cart-nav-num">2</span> <?php _e('Doprava a platba', 'PD_ADMIN_DOMAIN'); ?>
        </a>
    </li>
    <li>
        <a class="cart-nav-data eshop-cart-nav-item js-change-checkout-section-nav" <?php if (is_cart()) { ?>style="pointer-events: none" <?php } ?> data-index="2" href="">
            <span class="eshop-cart-nav-num">3</span> <?php _e('Dodací údaje', 'PD_ADMIN_DOMAIN'); ?>
        </a>
    </li>

</ul>
