<?php

use Layouts\Block\BlockModel;
use Components\ThemeSettings\ThemeSettingsFactory;
use Utils\Image;

$Theme = ThemeSettingsFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<ul class="contacts">

    <?php if ($Theme->isContactPhone()) { ?>
        <li class="contacts__contact">
            <span>
                <?php _e("Zavolejte nám:", "PD_ADMIN_DOMAIN"); ?>
            </span>
            <a class="contacts__link" href="tel:<?= $Theme->getContactPhoneClean(); ?>">
                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                <?= $Theme->getContactPhoneFancy(); ?>
            </a>
        </li>
    <?php } ?>

    <?php if ($Theme->isContactEmail()) { ?>
        <li class="contacts__contact">
            <span>
                <?php _e("Napište nám:", "PD_ADMIN_DOMAIN"); ?>
            </span>

            <a class="contacts__link" href="mailto:<?= $Theme->getContactEmail(); ?>">
                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                <?= $Theme->getContactEmailFancy(); ?>
            </a>
        </li>
    <?php } ?>

</ul>

<div class="entry-content">
    <?php if ($Theme->isContactStreet()) { ?>
        <p>
            <?= $Theme->getContactStreet(); ?>
            <br>
            <?= $Theme->getContactZip(); ?> <?= $Theme->getContactCity(); ?>
        </p>
    <?php } ?>

    <?php if ($Theme->isContactIco() || $Theme->isContactDic()) { ?>
        <p>
            <?php if ($Theme->isContactIco()) { ?>
                <strong>
                    <?php _e("IČO:", "PD_ADMIN_DOMAIN"); ?>
                </strong>
                <?= $Theme->getContactIco(); ?>
            <?php } ?>

            <?php if ($Theme->isContactDic()) { ?>
                <br>
                <strong>
                    <?php _e("DIČ:", "PD_ADMIN_DOMAIN"); ?>
                </strong>
                <?= $Theme->getContactDic(); ?>
            <?php } ?>

        </p>
    <?php } ?>

    <?php if ($Theme->isContactDescription()) { ?>
        <p>
            <?= $Theme->getContactDescription(); ?>
        </p>
    <?php } ?>

</div>
