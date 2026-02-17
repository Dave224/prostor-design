<?php

use Components\Services\ServicesFactory;
use Components\ThemeSettings\ThemeSettingsFactory;
use Utils\Image;

$Service = ServicesFactory::create();
$Theme = ThemeSettingsFactory::create();
?>

<section class="base-section  intro-section --p-top-0 --p-bottom-0 --gray-intro-bg">
    <div class="container ">
        <div class="intro-section__content">
            <header class="base-header intro-section__header">
                <h1 class="base-header__heading base-heading">
                    <?= $Service->getTitle(); ?>
                </h1>

                <p class="base-header__perex ">
                    <?= $Service->getExcerpt(); ?>
                </p>

                <?php if ($Service->isParamsButtonText()) { ?>
                    <button class="btn  --primary intro-section__btn --requestPopup" type="button">
                        <span>
                            <?= $Service->getParamsButtonText(); ?>
                        </span>
                        <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" aria-hidden="true" draggable="false" />
                    </button>
                <?php } ?>

            </header>

            <?php if ($Service->hasThumbnail()) { ?>
                <div class="intro-section__placeholder">
                    <?= $Service->renderThumbnail(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
