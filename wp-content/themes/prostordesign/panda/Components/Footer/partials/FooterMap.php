<?php

use Components\ThemeSettings\ThemeSettingsFactory;
use Components\FooterHeaderSettings\FooterHeaderSettingsFactory;
use Utils\Image;
use Utils\Svg;

$Theme = ThemeSettingsFactory::create();
$Footer = FooterHeaderSettingsFactory::create();
?>


<div class="footer-main--right">
    <a href="<?= $Footer->getFooterMapUrl(); ?>" class="footer-map">
        <span class="footer-map__text">
            <?php _e("Žernovnická 257", "PD_ADMIN_DOMAIN"); ?>
        </span>
        <img class="footer-map__map-marker" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/footer-map-marker.svg"); ?>" alt="" draggable="false" aria-hidden="true">
        <img class="footer-map__map" src="" data-src="<?= Image::imageGetUrlFromTheme("content/footer-map.png"); ?>" srcset="" data-srcset="
        <?= Image::imageGetUrlFromTheme("content/footer-map.png"); ?>,
        <?= Image::imageGetUrlFromTheme("content/footer-map2x.png"); ?> 2x" alt="<?= __("Mapa", "PROJECT_ADMIN_DOMAIN"); ?>" draggable="false" aria-hidden="true">
    </a>
</div>
