<?php

use Components\ThemeSettings\ThemeSettingsFactory;
use Components\FooterHeaderSettings\FooterHeaderSettingsFactory;
use Utils\Image;

$Theme = ThemeSettingsFactory::create();
$Footer = FooterHeaderSettingsFactory::create();

$MenuId = KT::getCustomMenuIdByLocation(NAVIGATION_FOOTER_MENU);
$MenuObject = wp_get_nav_menu_object($MenuId);
$MenuName = $MenuObject ? $MenuObject->name : null;
?>


<div class="footer-main--left">
    <div class="footer-top row">

        <a class="col-sm-12 col-md-12 col-lg-4 footer-top__block footer-top__brand" href="<?= home_url(); ?>" target="_blank" rel="nofollow">
            <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/logo.svg"); ?>" alt="" aria-hidden="true" draggable="false" aria-hidden="true">
        </a>

        <div class="footer-top__block col-sm-5 col-md-5 col-lg-3">
            <h2 class="footer-top__block-title article-heading">
                <?= $MenuName; ?>
            </h2>
            <nav class="footer-top__nav large-text">
                <ul>
                    <?php KT::theWpNavMenu(NAVIGATION_FOOTER_MENU, 1); ?>
                </ul>
            </nav>
        </div>

        <div class="footer-top__block col-sm-7 col-md-7 col-lg-5">

            <?php if ($Footer->isFooterCareerTitle() || $Footer->isFooterCareerDesc() || $Footer->isFooterCareerLinkText() && $Footer->isFooterCareerLinkUrl()) { ?>
                <div class="footer-top__career">
                    <?php if ($Footer->isFooterCareerTitle()) { ?>
                        <h2 class="footer-top__block-title article-heading">
                            <?= $Footer->getFooterCareerTitle(); ?>
                        </h2>
                    <?php } ?>

                    <?php if ($Footer->isFooterCareerDesc()) { ?>
                        <?= $Footer->getFooterCareerDesc(); ?>
                    <?php } ?>

                    <?php if ($Footer->isFooterCareerLinkText() && $Footer->isFooterCareerLinkUrl()) { ?>
                        <a href="<?= $Footer->getFooterCareerLinkUrl(); ?>" class="link" <?= $Footer->getFooterCareerTarget(); ?>>
                            <span>
                                <?= $Footer->getFooterCareerLinkText(); ?>
                            </span>
                            <img class="link__img--dotts" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-dotts.svg"); ?>" draggable="false" alt="" aria-hidden="true">
                            <img class="link__img--arrow" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow.svg"); ?>" draggable="false" alt="" aria-hidden="true">

                        </a>
                    <?php } ?>

                </div>
            <?php } ?>

            <div class="footer-top__adress">
                <?php if ($Theme->isContactCompanyName()) { ?>
                    <h2 class="footer-top__block-title article-heading">
                        <?= $Theme->getContactCompanyName(); ?>
                    </h2>
                <?php } ?>
                <?php if ($Theme->isContactStreet() || $Theme->isContactCity()) { ?>
                    <p>
                        <?= $Theme->getContactStreet(); ?>
                        <br>
                        <?= $Theme->getContactZip(); ?>
                        <?= $Theme->getContactCity(); ?>
                    </p>
                <?php } ?>
                <?php if ($Theme->isContactDic() || $Theme->isContactIco()) { ?>
                    <p>
                        <?php if ($Theme->isContactIco()) { ?>
                            <strong>
                                <?php _e("IČO:", "PD_DOMAIN"); ?>
                            </strong>
                            <?= $Theme->getContactIco(); ?>
                            <br>
                        <?php } ?>
                        <?php if ($Theme->isContactDic()) { ?>
                            <strong>
                                <?php _e("DIČ:", "PD_DOMAIN"); ?>
                            </strong>
                            <?= $Theme->getContactDic(); ?>
                            <br>
                        <?php } ?>
                    </p>
                <?php } ?>
            </div>
        </div>

    </div>

    <?php get_template_part(COMPONENTS_PATH . "Footer/partials/FooterBottom"); ?>

</div>
