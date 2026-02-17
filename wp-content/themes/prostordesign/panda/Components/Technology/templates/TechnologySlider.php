<?php

use Utils\Image;
use Components\Technology\TechnologyFactory;
use Components\ThemeSettings\ThemeSettingsFactory;

$Technology = TechnologyFactory::create();
$ThemeSettings = ThemeSettingsFactory::create();
?>

<li class="splide__slide ">
    <div class="technology-item">
        <div class="technology-item__images-block">

            <?php if ($Technology->isParamsPageImage()) { ?>
                <div class="technology-item__base-img">
                    <?= $Technology->renderParamsPageImage(); ?>
                </div>
            <?php } ?>

        </div>
        <div class="technology-item__content">
            <a href="<?= $Technology->getPermalink(); ?>">
                <h3 class="base-subheading">
                    <?= $Technology->getTitle(); ?>
                </h3>
            </a>
            <p>
                <?= $Technology->getExcerpt(); ?>
            </p>

            <?php if ($ThemeSettings->isLinkType()) { ?>
                <a class="btn  --primary" href="<?= $Technology->getPermalink(); ?>">
                    <span>
                        <?= __("Detail robota", "PD_ADMIN_DOMAIN"); ?>
                    </span>
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
    </div>

</li>
