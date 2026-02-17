<?php

use Utils\Image;
use Layouts\Block\BlockModel;
use Components\Block\Type\Contact\ContactFactory;

$Contact = ContactFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>
<ul class="contacts">

    <?php if ($Contact->isContactPhone()) { ?>
        <li class="contacts__contact">
            <span>
                <?php _e("Zavolejte nám:", "PD_ADMIN_DOMAIN"); ?>
            </span>
            <a class="contacts__link" href="tel:<?= $Contact->getContactPhoneClean(); ?>">
                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                <?= $Contact->getContactPhoneFancy(); ?>
            </a>
        </li>
    <?php } ?>

    <?php if ($Contact->isContactEmail()) { ?>
        <li class="contacts__contact">
            <span>
                <?php _e("Napište nám:", "PD_ADMIN_DOMAIN"); ?>
            </span>

            <a class="contacts__link" href="mailto:<?= $Contact->getContactEmail(); ?>">
                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                <?= $Contact->getContactEmail(); ?>
            </a>
        </li>
    <?php } ?>

</ul>

<div class="entry-content">
    <?php if ($Contact->isContactStreet() || $Contact->isContactCity()) { ?>
        <p>
            <?php if ($Contact->isContactStreet()) { ?>
                <?= $Contact->getContactStreet(); ?>
            <?php } ?>

            <?php if ($Contact->isContactCity()) { ?>
                <br>
                <?= $Contact->getContactPsc(); ?> <?= $Contact->getContactCity(); ?>
            <?php } ?>
        </p>
    <?php } ?>

    <?php if ($Contact->isContactIco() || $Contact->isContactDic()) { ?>
        <p>
            <?php if ($Contact->isContactIco()) { ?>
                <strong>
                    <?php _e("IČO:", "PD_ADMIN_DOMAIN"); ?>
                </strong>
                <?= $Contact->getContactIco(); ?>
            <?php } ?>

            <?php if ($Contact->isContactDic()) { ?>
                <br>
                <strong>
                    <?php _e("DIČ:", "PD_ADMIN_DOMAIN"); ?>
                </strong>
                <?= $Contact->getContactDic(); ?>
            <?php } ?>

        </p>
    <?php } ?>

    <?php if ($Contact->isContactSign()) { ?>
        <p>
            <?= $Contact->getContactSign(); ?>
        </p>
    <?php } ?>

</div>
