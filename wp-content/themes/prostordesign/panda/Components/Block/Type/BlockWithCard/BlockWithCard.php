<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\BlockWithCard\BlockWithCardFactory;
use Utils\Image;

$BlockWithCard = BlockWithCardFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>



<section class="base-section  detail-section <?= $BlockWithCard->renderSectionSettingsClass(); ?>">
    <div class="container ">
        <div class="row content-w-aside ">
            <div class="col-lg-7">

                <?php if ($BlockWithCard->isParamsTitle()) { ?>
                    <header class="base-header -mb-base">
                        <?= $PageBlock->renderHeadline($BlockWithCard->getPostId(), $BlockWithCard->getParamsTitle(), "base-header__heading base-heading"); ?>
                    </header>
                <?php } ?>

                <?php if ($BlockWithCard->isParamsContent()) { ?>
                    <div class="entry-content detail-section-entry-content">
                        <?= $BlockWithCard->getParamsContent(); ?>
                    </div>
                <?php } ?>

            </div>

            <?php if ($BlockWithCard->isFirstCard() || $BlockWithCard->isSecondCard()) { ?>
                <div class="row col-lg-4">

                    <?php if ($BlockWithCard->isFirstCard()) { ?>
                        <div class="widget img-and-button-widget col-md-6 col-lg-12">
                            <?php if ($BlockWithCard->isFirstCardTitle()) { ?>
                                <h2 class="widgettitle img-and-button-widget__heading">
                                    <?= $BlockWithCard->getFirstCardTitle(); ?>
                                </h2>
                            <?php } ?>

                            <?php if ($BlockWithCard->isFirstCardDesc()) { ?>
                                <p class="img-and-button-widget__perex large-text">
                                    <?= $BlockWithCard->getFirstCardDesc(); ?>
                                </p>
                            <?php } ?>

                            <?php if ($BlockWithCard->isFirstCardImage()) { ?>
                                <div class="img-and-button-widget__img">
                                    <?= $BlockWithCard->renderFirstImage(); ?>
                                </div>
                            <?php } ?>

                            <?php if ($BlockWithCard->isFirstCardButtonUrl() && $BlockWithCard->isFirstCardButtonText()) { ?>
                                <a class="btn  --primary --arrow-small" href=" <?= $BlockWithCard->getFirstCardButtonUrl(); ?>">
                                    <span>
                                        <?= $BlockWithCard->getFirstCardButtonText(); ?>
                                    </span>
                                    <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-small-white.svg") ?>" alt="prohlédnout" draggable="false" aria-hidden="true" />
                                </a>
                            <?php } ?>

                        </div>
                    <?php } ?>

                    <?php if ($BlockWithCard->isSecondCard()) { ?>
                        <div class="widget img-and-button-widget col-md-6 col-lg-12">
                            <?php if ($BlockWithCard->isSecondCardTitle()) { ?>
                                <h2 class="widgettitle img-and-button-widget__heading">
                                    <?= $BlockWithCard->getSecondCardTitle(); ?>
                                </h2>
                            <?php } ?>

                            <?php if ($BlockWithCard->isSecondCardDesc()) { ?>
                                <p class="img-and-button-widget__perex large-text">
                                    <?= $BlockWithCard->getSecondCardDesc(); ?>
                                </p>
                            <?php } ?>

                            <?php if ($BlockWithCard->isSecondCardImage()) { ?>
                                <div class="img-and-button-widget__img">
                                    <?= $BlockWithCard->renderSecondImage(); ?>
                                </div>
                            <?php } ?>

                            <?php if ($BlockWithCard->isSecondCardButtonUrl() && $BlockWithCard->isSecondCardButtonText()) { ?>
                                <a class="<?= $BlockWithCard->getSecondCardButtonClass(); ?>" href=" <?= $BlockWithCard->getSecondCardButtonUrl(); ?>">
                                    <span>
                                        <?= $BlockWithCard->getSecondCardButtonText(); ?>
                                    </span>
                                    <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme($BlockWithCard->getSecondCardButtonImage()) ?>" alt="prohlédnout" draggable="false" aria-hidden="true" />
                                </a>
                            <?php } ?>

                        </div>
                    <?php } ?>

                </div>
            <?php } ?>

        </div>
    </div>
</section>
