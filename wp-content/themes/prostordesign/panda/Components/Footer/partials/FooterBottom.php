<?php

use Utils\Svg;
use Utils\Image;
use Components\ThemeSettings\ThemeSettingsFactory;

$Theme = ThemeSettingsFactory::create();
$MenuCategoryId = KT::getCustomMenuIdByLocation(FOOTER_CATEOGRIES_MENU);
$MenuCategoryObject = wp_get_nav_menu_object($MenuCategoryId);
$MenuCategoryName = $MenuCategoryObject ? $MenuCategoryObject->name : null;

$MenuServicesId = KT::getCustomMenuIdByLocation(FOOTER_SERVICES_MENU);
$MenuServicesObject = wp_get_nav_menu_object($MenuServicesId);
$MenuServicesName = $MenuServicesObject ? $MenuServicesObject->name : null;
?>

<div class="footer-bottom row">
    <div class="footer-bottom-top row">
        <?php if (ICL_LANGUAGE_CODE == 'cs') { ?>
            <div class="col-lg-12">
                <div class="footer-menu-box">
                    <h4 class="footer-top__block-title article-heading"><?= $MenuCategoryName; ?></h4>
                    <ul class="footer-menu-list">
                        <?php KT::theWpNavMenu(FOOTER_CATEOGRIES_MENU, 1); ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <div class="col-lg-12">
            <div class="footer-menu-box">
                <h4 class="footer-top__block-title article-heading"><?= $MenuServicesName; ?></h4>
                <ul class="footer-menu-list">
                    <?php KT::theWpNavMenu(FOOTER_SERVICES_MENU, 1); ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom-row row align-items-center">
        <div class="col-lg-7">
            <span class="footer-copy">
                &copy; <?= date("Y"); ?> <?= get_bloginfo('name'); ?>— <?php _e("All rights reserved.", "PD_DOMAIN"); ?></span>
        </div>
        <div class="col-lg-5">
            <?php if ($Theme->isSocials()) { ?>
                <div class="footer-social">
                    <?php if ($Theme->isSocialFacebook()) { ?>
                        <a href="<?= $Theme->getSocialFacebook() ?>" target="_blank" rel="nofollow">
                            <?= Svg::renderSvg("facebook"); ?>
                        </a>
                    <?php } ?>
                    <?php if ($Theme->isSocialInstagram()) { ?>
                        <a href="<?= $Theme->getSocialInstagram() ?>" target="_blank" rel="nofollow">
                            <?= Svg::renderSvg("instagram"); ?>
                        </a>
                    <?php } ?>
                    <?php if ($Theme->isSocialLinkedin()) { ?>
                        <a href="<?= $Theme->getSocialLinkedin() ?>" target="_blank" rel="nofollow">
                            <?= Svg::renderSvg("linkedin"); ?>
                        </a>
                    <?php } ?>
                    <?php if ($Theme->isSocialWhatsapp()) { ?>
                        <a href="<?= $Theme->getSocialWhatsapp() ?>" target="_blank" rel="nofollow">
                            <?= Svg::renderSvg("whatsapp"); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
