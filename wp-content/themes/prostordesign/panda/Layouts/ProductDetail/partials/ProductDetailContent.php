<?php

use Utils\Image;
use Components\Product\ProductFactory;
use Components\Product\ProductConfig;
use Components\ThemeSettings\ThemeSettingsFactory;

$Product = ProductFactory::create();
$Theme = ThemeSettingsFactory::create();
?>


<section class="base-section  detail-section">
    <div class="container ">
        <div class="row <?php if ($Product->isParamsAside()) { ?>content-w-aside<?php } ?>">
            <div class="col-lg-<?php if ($Product->isParamsAside()) { ?>7<?php } else { ?>12<?php } ?>">
                <?php if ($Product->isParamsTitle()) { ?>
                    <header class="base-header -mb-base">
                        <h2 class="base-header__heading base-heading">
                            <?= $Product->getParamsTitle(); ?>
                        </h2>
                    </header>
                <?php } ?>

                <?php if ($Product->isParamsDescription()) { ?>
                    <div class="entry-content detail-section-entry-content">
                        <?= $Product->getParamsDescription(); ?>
                    </div>
                <?php } ?>

                <div class="detail-specification">
                    <?php if ($Product->isSpecificationFieldFirstItem()) {
                        $Specifications = $Product->getSpecificationDynamicField(); ?>
                        <div class="detail-specification__column">
                            <h3 class="article-heading"><?php _e("SPECIFIKACE", "PD_DOMAIN"); ?>:</h3>
                            <ul class="detail-specification__list">
                                <?php foreach ($Specifications as $Specification) { ?>
                                    <li>
                                        <?= $Specification[ProductConfig::SPECIFICATION_ITEM]; ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php if ($Product->isColorsFieldFirstItem()) {
                        $Colors = $Product->getColorsDynamicField(); ?>
                        <div class="detail-specification__column">
                            <h3 class="article-heading"><?php _e("BARVY", "PD_DOMAIN"); ?>:</h3>
                            <ul class="detail-specification__list">
                                <?php foreach ($Colors as $Color) { ?>
                                    <li>
                                        <span><?= $Color[ProductConfig::COLORS_TITLE]; ?></span>
                                        <span class="detail-specification__color" style="background-color: rgb(<?= $Color[ProductConfig::COLORS_COLOR]; ?>);"></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <?php if ($Product->isParamsAside()) { ?>
                <div class="col-lg-4">

                    <div class="widget contact-widget">
                        <?php if ($Theme->isEshopContactTitle()) { ?>
                            <h2 class="widgettitle contact-widget__heading"><?= $Theme->getEshopContactTitle(); ?></h2>
                        <?php } ?>
                        <?php if ($Theme->isEshopContactDescription()) { ?>
                            <p class="contact-widget__perex large-text"><?= $Theme->getEshopContactDescription(); ?></p>
                        <?php } ?>

                        <?php if ($Theme->isEshopContactPerson()) {
                            $Person = $Theme->getEshopContactPersonFactory(); ?>
                            <div class="contact-widget__contact-block">
                                <?php if ($Person->hasThumbnail()) { ?>
                                    <div class="contact-widget__img">
                                        <?= $Person->renderThumbnail(); ?>
                                    </div>
                                <?php } ?>

                                <div class="contact">
                                    <h3 class="base-text contact-widget__person"><?= $Person->getTitle(); ?></h3>
                                    <?php if ($Person->isParamsPosition()) { ?>
                                        <p class="contact-widget__person-post"><?= $Person->getParamsPosition(); ?></p>
                                    <?php } ?>
                                    <?php if ($Person->isParamsFirstPhone()) { ?>
                                        <a class="contacts__link" href="tel:<?= $Person->getParamsFirstPhoneClear(); ?>">
                                            <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                            <?= $Person->getParamsFirstPhoneFancy(); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if ($Person->isParamsEmail()) { ?>
                                        <a class="contacts__link" href="mailto:<?= $Person->getParamsEmail(); ?>">
                                            <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                            <?= $Person->getParamsEmail(); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($Theme->isEshopContactCallTitle()) { ?>
                            <h2 class="widgettitle contact-widget__heading"><?= $Theme->getEshopContactCallTitle(); ?></h2>
                        <?php } ?>
                        <?php if ($Theme->isEshopContactCallDescription()) { ?>
                            <p class="contact-widget__perex large-text"><?= $Theme->getEshopContactCallDescription(); ?></p>
                        <?php } ?>

                        <button class="btn  --primary --ico-first" type="button">
                            <span><?php _e("Zavolejte mi", "PD_DOMAIN"); ?></span>
                            <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone-line.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        </button>

                        <div class="fast-contact-form popup-form">
                            <div class="popup-form__block">

                                <div class="contact-form__block">
                                    <h3 class="base-subheading">
                                        <?php _e("Zavolejte mi", "PD_ADMIN_DOMAIN"); ?>
                                    </h3>
                                    <p class="contact-form__perex">
                                        <?php _e("Zavoláme Vám a nic nemusíte řešit...", "PD_ADMIN_DOMAIN"); ?>
                                    </p>
                                    <?php get_template_part(COMPONENTS_PATH . "FastContactForm/FastContactForm"); ?>
                                    <span class="popup-form__cross"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
