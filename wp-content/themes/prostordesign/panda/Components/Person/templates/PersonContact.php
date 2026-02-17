<?php

use Utils\Image;
use Components\Person\PersonFactory;

$Person = PersonFactory::create();
?>


<li>
    <div class="contact-person ">
        <div class="contact-person__left">

            <?php if ($Person->hasThumbnail()) { ?>
                <div class="contact-person__img">
                    <?= $Person->renderThumbnail(); ?>
                </div>
            <?php } ?>

            <div class="contact-person__name ">
                <h3 class="large-text">
                    <?= $Person->getTitle(); ?>
                </h3>
                <?php if ($Person->isParamsPosition()) { ?>
                    <p class="contact-person__position">
                        <?= $Person->getParamsPosition(); ?>
                    </p>
                <?php } ?>
            </div>
        </div>

        <ul class="contact-person__list">
            <?php if ($Person->isParamsEmail()) { ?>
                <li>
                    <a class="contact-person__link" href="mailto:<?= $Person->getParamsEmail(); ?>">
                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <?= $Person->getParamsEmail(); ?>
                    </a>
                </li>
            <?php } ?>

            <?php if ($Person->isParamsFirstPhone()) { ?>
                <li>
                    <a class="contact-person__link" href="tel:<?= $Person->getParamsFirstPhoneClear(); ?>">
                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <?= $Person->getParamsFirstPhoneFancy(); ?>
                    </a>
                </li>
            <?php } ?>

            <?php if ($Person->isParamsSecondPhone()) { ?>
                <li>
                    <a class="contact-person__link" href="tel:<?= $Person->getParamsSecondPhoneClear(); ?>">
                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone-landline.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <?= $Person->getParamsSecondPhoneFancy(); ?>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </div>
</li>
