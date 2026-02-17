<?php

use Utils\Image;
use Layouts\Block\BlockModel;
use Components\Block\Type\SmallBannerWithText\SmallBannerWithTextFactory;

$SmallBanner = SmallBannerWithTextFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section  banner-section --p-top-0">
    <div class="container ">
        <div class="banner-section__content">

            <div class="banner-section__text">
                <img class="banner-section__img" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/logo-small.svg"); ?>" draggable="false" alt="" aria-hidden="true">

                <?php if ($SmallBanner->isSettingsContent()) { ?>
                    <div class="entry-content">
                        <?= $SmallBanner->getSettingsContent(); ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($SmallBanner->isSettingsButtonText() && $SmallBanner->isSettingsButtonUrl()) { ?>

                <a class="btn  --primary banner-section__button" href="<?= $SmallBanner->getSettingsButtonUrl(); ?>" <?= $SmallBanner->getTarget(); ?>>
                    <span>
                        <?= $SmallBanner->getSettingsButtonText(); ?>
                    </span>
                </a>

            <?php } ?>
        </div>
    </div>
</section>
