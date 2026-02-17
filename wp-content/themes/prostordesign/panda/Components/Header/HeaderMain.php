<?php

use Utils\Svg;
use Utils\Image;
use Components\FooterHeaderSettings\FooterHeaderSettingsFactory;

$Header = FooterHeaderSettingsFactory::create();
$MenuWalker = new MenuWalker();
?>

<header class="header-main">

    <div class="container">

        <div class="header-main__top">

            <a class="header-main__brand" href="<?= home_url(); ?>">
                <img src="<?= Image::imageGetUrlFromTheme("svg/logo.svg") ?>" alt="<?= get_bloginfo('name'); ?>" draggable="false" loading="lazy">
            </a>

            <?php if ($Header->isMainContactHeaderPhone() || $Header->isMainContactHeaderEmail()) { ?>
                <ul class="contacts">

                    <?php if ($Header->isMainContactHeaderPhone()) { ?>
                        <li class="contacts__contact">
                            <span><?php _e("Zavolejte nám:", "PD_DOMAIN"); ?></span>
                            <a class="contacts__link" href="tel:<?= $Header->getMainContactHeaderPhoneClean(); ?>">
                                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg") ?>" alt="" aria-hidden="true" draggable="false">
                                <?= $Header->getMainContactHeaderPhone(); ?>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($Header->isMainContactHeaderEmail()) { ?>
                        <li class=" contacts__contact">
                            <span><?php _e("Napište nám:", "PD_DOMAIN"); ?></span>
                            <a class="contacts__link" href="mailto:<?= $Header->getMainContactHeaderEmail(); ?>">
                                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg") ?>" alt="" aria-hidden="true" draggable="false">
                                <?= $Header->getMainContactHeaderEmail(); ?>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            <?php } ?>

            <a class="header-main__map">
                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/header-map.svg"); ?>" alt="" aria-hidden="true" draggable="false">
            </a>

        </div>
        <div class="header-main__bottom">

            <nav class="nav-main">
                <ul>
                    <?php KT::theWpNavMenu(NAVIGATION_MAIN_MENU, 2, $MenuWalker); ?>
                </ul>
            </nav>

            <?php
            if (function_exists("icl_get_languages")) {
                $languages = icl_get_languages("skip_missing=0");
                get_template_part(COMPONENTS_PATH . "Header/HeaderLanguageSwitcher");
            } ?>


            <div class="header-search">
                <?php get_template_part(COMPONENTS_PATH . "Header/HeaderSearchForm"); ?>
            </div>

            <div class="header-main__nav-button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>

    <div class="header-mask"></div>
</header>
