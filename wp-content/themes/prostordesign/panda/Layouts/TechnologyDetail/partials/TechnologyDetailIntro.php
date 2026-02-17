<?php

use Components\Technology\TechnologyFactory;
use Utils\Image;

$Technology = TechnologyFactory::create();
?>

<section class="base-section  intro-section --p-top-0 --p-bottom-0 --gray-intro-bg">
    <div class="container ">
        <div class="intro-section__content">
            <header class="base-header intro-section__header">
                <h1 class="base-header__heading base-heading">
                    <?= $Technology->getTitle(); ?>
                </h1>

                <p class="base-header__perex ">
                    <?= $Technology->getExcerpt(); ?>
                </p>

                <?php if ($Technology->isParamsButtonText()) { ?>
                    <button class="btn  --primary intro-section__btn --requestPopup" type="button">
                        <span>
                            <?= $Technology->getParamsButtonText(); ?>
                        </span>
                        <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" aria-hidden="true" draggable="false" />
                    </button>
                <?php } ?>

            </header>

            <?php if ($Technology->hasThumbnail()) { ?>
                <div class="intro-section__placeholder">
                    <?= $Technology->renderThumbnail(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
