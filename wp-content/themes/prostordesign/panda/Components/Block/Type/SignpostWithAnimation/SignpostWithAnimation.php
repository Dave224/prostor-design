<?php

use Utils\Util;
use Utils\Image;
use Layouts\Block\BlockModel;
use Components\Block\Type\SignpostWithAnimation\SignpostWithAnimationFactory;

$SignpostWithAnimation = SignpostWithAnimationFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section  signpost-section  --animated <?= $SignpostWithAnimation->renderSectionSettingsClass(); ?>">
    <div class="container ">

        <?php if ($SignpostWithAnimation->isParamsTitle() || $SignpostWithAnimation->isParamsContent()) { ?>
            <header class="base-header -mb-base">

                <?php if ($SignpostWithAnimation->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($SignpostWithAnimation->getPostId(), $SignpostWithAnimation->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>

                <?php if ($SignpostWithAnimation->isParamsContent()) { ?>
                    <p class="base-header__perex "><?= $SignpostWithAnimation->getParamsContent(); ?></p>
                <?php } ?>

            </header>
        <?php } ?>

        <?php if ($SignpostWithAnimation->isDynamicItemsField()) { ?>
            <ul class="signpost-section__row">

                <?php foreach ($SignpostWithAnimation->getItems() as $Item) { ?>
                    <?php if (Util::issetAndNotEmpty($Item[0])) { ?>
                        <li class="signpost-item">
                            <a href="<?= $Item[4]; ?>" class="signpost-item__link">
                                <div class="signpost-item__block">
                                    <div class="signpost-item__img">
                                        <?= $Item[0]; ?>
                                    </div>
                                    <div class="signpost-item__content">
                                        <?php if (Util::issetAndNotEmpty($Item[1])) { ?>
                                            <h3 class="base-subheading signpost-item__title">
                                                <?= $Item[1]; ?>
                                            </h3>
                                        <?php } ?>
                                        <?= $Item[2]; ?>
                                    </div>
                                </div>
                                <?php if (Util::issetAndNotEmpty($Item[3])) { ?>
                                    <div class="signpost-item__more-info">
                                        <div class="link">
                                            <span>
                                                <?= $Item[3]; ?>
                                            </span>
                                            <img class="link__img--custom" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-white.svg"); ?>" draggable="false" alt="" aria-hidden="true">
                                        </div>
                                    </div>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>

            </ul>
        <?php } ?>

        <?php if ($SignpostWithAnimation->isParamsButtonText() && $SignpostWithAnimation->isParamsButtonUrl()) { ?>
            <a class="btn  --primary signpost-section__btn" href="<?= $SignpostWithAnimation->getParamsButtonUrl(); ?>">
                <span>
                    <?= $SignpostWithAnimation->getParamsButtonText(); ?>
                </span>
            </a>
        <?php } ?>

    </div>
</section>
