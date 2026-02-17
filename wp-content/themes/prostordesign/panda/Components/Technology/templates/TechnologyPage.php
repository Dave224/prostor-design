<?php

use Utils\Image;
use Components\Technology\TechnologyFactory;
use Components\ThemeSettings\ThemeSettingsFactory;

$Technology = TechnologyFactory::create();
$ThemeSettings = ThemeSettingsFactory::create();
?>

<section class="base-section  robot-section base-section <?php if ($Technology->isParamsImagePosition()) { ?>--img-left<?php } ?>">
    <div class="container ">
        <div class="robot-section__body">
            <div class="robot-section__text">
                <a class="robot-text-content__title" href="<?= $Technology->getPermalink(); ?>">
                    <h2 class="base-heading">
                        <?= $Technology->getTitle(); ?>
                    </h2>
                </a>

                <p class="robot-text-content__text">
                    <?php if ($Technology->hasExcerpt()) { ?>
                        <?= get_the_excerpt(); ?>
                    <?php } else { ?>
                        <?= $Technology->getExcerpt(true, 30); ?>
                    <?php } ?>
                </p>

                <ul class="robot-text-content__list">

                    <?php if ($Technology->isTechnickalParamsYear()) { ?>
                        <li class="robot-list-item">
                            <h3 class="robot-list-item__title base-text">
                                <?php _e("Rok výroby:", "PD_ADMIN_DOMAIN"); ?>
                            </h3>
                            <div class="robot-list-item__values">
                                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/gear.svg"); ?>" alt="ikona technologie" aria-hidden="true" draggable="false">
                                <p class="robot-list-item__value">
                                    <?= $Technology->getTechnickalParamsYear(); ?>
                                </p>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($Technology->isTechnickalParamsAccuracy()) { ?>
                        <li class="robot-list-item">
                            <h3 class="robot-list-item__title base-text">
                                <?php _e("Přesnost:", "PD_ADMIN_DOMAIN"); ?>
                            </h3>
                            <div class="robot-list-item__values">
                                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/aim.svg"); ?>" alt="ikona technologie" aria-hidden="true" draggable="false">
                                <p class="robot-list-item__value">
                                    <?= $Technology->getTechnickalParamsAccuracy(); ?>
                                </p>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($Technology->isTechnickalParamsTechnology()) { ?>
                        <li class="robot-list-item">
                            <h3 class="robot-list-item__title base-text">
                                <?php _e("Technologie:", "PD_ADMIN_DOMAIN"); ?>
                            </h3>
                            <div class="robot-list-item__values">
                                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/technology.svg"); ?>" alt="ikona technologie" aria-hidden="true" draggable="false">
                                <p class="robot-list-item__value">
                                    <?= $Technology->getTechnickalParamsTechnology(); ?>
                                </p>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($Technology->isTechnickalParamsWeight()) { ?>
                        <li class="robot-list-item">
                            <h3 class="robot-list-item__title base-text">
                                <?php _e("Váha:", "PD_ADMIN_DOMAIN"); ?>
                            </h3>
                            <div class="robot-list-item__values">
                                <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/weight.svg"); ?>" alt="ikona technologie" aria-hidden="true" draggable="false">
                                <p class="robot-list-item__value">
                                    <?= $Technology->getTechnickalParamsWeight(); ?>
                                </p>
                            </div>
                        </li>
                    <?php } ?>

                </ul>

                <?php if ($ThemeSettings->isLinkType()) { ?>
                    <a class="btn  --primary robot-text-content__link" href="<?= $Technology->getPermalink(); ?>">
                        <span>
                            <?= __("Detail robota", "PD_ADMIN_DOMAIN"); ?>
                        </span>
                        <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                    </a>
                <?php } else { ?>
                    <a href="<?= $Technology->getPermalink(); ?>" class="link" type="button">
                        <span>
                            <?= __("Detail robota", "PD_ADMIN_DOMAIN"); ?>
                        </span>

                        <img class="link__img--dotts" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-dotts.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <img class="link__img--arrow" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                    </a>
                <?php } ?>


            </div>

            <?php if ($Technology->isParamsPageImage()) { ?>
                <div class="robot-section__picture">
                    <div class="robot-section__placeholder">
                        <?= $Technology->renderParamsPageImage(); ?>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>
</section>
