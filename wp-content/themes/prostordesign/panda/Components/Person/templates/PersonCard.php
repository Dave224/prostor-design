<?php

use Utils\Image;
use Components\Person\PersonFactory;
use Components\ThemeSettings\ThemeSettingsFactory;

$Person = PersonFactory::create();
$Theme = ThemeSettingsFactory::create();
?>

<div class="row col-lg-4">
    <div class="widget contact-widget col-md-6 col-lg-12">
        <?php if ($Theme->isServicesContactTitle()) { ?>
            <h2 class="widgettitle contact-widget__heading">
                <?= $Theme->getServicesContactTitle(); ?>
            </h2>
        <?php } ?>

        <?php if ($Theme->isServicesContactDesc()) { ?>
            <p class="contact-widget__perex large-text">
                <?= $Theme->getServicesContactDesc(); ?>
            </p>
        <?php } ?>

        <div class="contact-widget__contact-block">

            <?php if ($Person->hasThumbnail()) { ?>
                <div class="contact-widget__img">
                    <?= $Person->renderThumbnail(); ?>
                </div>
            <?php } ?>

            <div class="contact">
                <h3 class="base-text contact-widget__person">
                    <?= $Person->getTitle(); ?>
                </h3>

                <?php if ($Person->isParamsPosition()) { ?>
                    <p class="ontact-widget__person-post">
                        <?= $Person->getParamsPosition(); ?>
                    </p>
                <?php } ?>

                <?php if ($Person->isParamsFirstPhone()) { ?>
                    <a class="contacts__link" href="tel:<?= $Person->getParamsFirstPhoneClear(); ?>">
                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <?= $Person->getParamsFirstPhoneFancy(); ?>
                    </a>
                <?php } ?>

                <?php if ($Person->isParamsSeCondPhone()) { ?>
                    <a class="contacts__link" href="tel:<?= $Person->getParamsSeCondPhoneClear(); ?>">
                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone-landline.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <?= $Person->getParamsSeCondPhoneFancy(); ?>
                    </a>
                <?php } ?>

                <?php if ($Person->isParamsEmail()) { ?>
                    <a class="contacts__link" href="mailto:<?= $Person->getParamsEmail(); ?>">
                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <?= $Person->getParamsEmail(); ?>
                    </a>
                <?php } ?>

            </div>
        </div>
        <?php if ($Theme->isServicesContactCallTitle()) { ?>
            <h2 class="widgettitle contact-widget__heading">
                <?= $Theme->getServicesContactCallTitle(); ?>
            </h2>
        <?php } ?>

        <?php if ($Theme->isServicesContactCallDesc()) { ?>
            <p class="contact-widget__perex large-text">
                <?= $Theme->getServicesContactCallDesc(); ?>
            </p>
        <?php } ?>

        <button class="btn  --primary --ico-first" type="button">

            <span>
                <?php _e("Zavolejte mi", "PD_ADMIN_DOMAIN"); ?>
            </span>
            <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone-line.svg"); ?>" alt="prohlédnout" draggable="false" />
        </button>
    </div>
</div>
