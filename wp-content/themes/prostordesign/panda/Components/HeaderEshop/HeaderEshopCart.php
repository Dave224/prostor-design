<?php
use Utils\Svg;
?>

<a href="<?= wc_get_cart_url(); ?>" class="header-main__cart js-header-basket">
    <?= Svg::renderSvg("shopping-cart-gray"); ?>
    <?php if (count(WC()->cart->get_cart_contents()) > 0) { ?>
    <span class="header-main__items-sum"><?= count(WC()->cart->get_cart_contents()); ?></span>
            <span class="header-main__price"><?= WC()->cart->get_cart_total(); ?></span>
    <?php } else { ?>
        <span class="header-main__price"><?php _e("Prázdný košík", "PD_DOMAIN"); ?></span>
    <?php } ?>
</a>