<?php

use Utils\Image;
use Components\Block\Type\ImageWithText\ImageWithTextFactory;
use Layouts\Block\BlockModel;

$ImageWithText = ImageWithTextFactory::create();
if (is_page()) {
    $PageId = get_queried_object_id();
    $PagePost = get_post($PageId);
    $PageBlock = new BlockModel($PagePost);
}
?>

<?php if ($PageBlock->isBlockFirst($ImageWithText->getPostId())) { ?>
    <?= get_template_part(COMPONENTS_PATH . "Breadcrumbs/BreadcrumbsLeft"); ?>
<?php } ?>

<section class="base-section text-and-picture-section <?= $ImageWithText->renderSectionSettingsClass(); ?> <?= $ImageWithText->renderAdditionalSettingsClass(); ?>">
    <div class="container">

        <?php if (is_page() && $ImageWithText->isParamsTitle() && $ImageWithText->getAdditionalSettingsTextPosition() != "--centered-img") { ?>
            <header class="base-header text-and-picture-section__heading">
                <?= $PageBlock->renderHeadline($ImageWithText->getPostId(), $ImageWithText->getParamsTitle(), "base-header__heading base-heading"); ?>
            </header>
        <?php } ?>

        <div class="text-and-picture-section__content">

            <?php if ($ImageWithText->isParamsContent()) { ?>
                <div class="text-and-picture-section__text">
                    <div class="entry-content">
                        <?php if ($ImageWithText->isParamsTitle() && $ImageWithText->getAdditionalSettingsTextPosition() == "--centered-img") { ?>
                            <?= $PageBlock->renderHeadline($ImageWithText->getPostId(), $ImageWithText->getParamsTitle()); ?>
                        <?php } ?>
                        <?= $ImageWithText->getParamsContent(); ?>
                    </div>

                    <?php if ($ImageWithText->isParamsButton()) { ?>
                        <a href="<?= $ImageWithText->getParamsButtonUrl(); ?>" class="btn --primary text-and-picture-section__btn">
                            <span><?= $ImageWithText->getParamsButtonText(); ?></span>
                            <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" aria-hidden="true" draggable="false" />
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if ($ImageWithText->isParamsImageId()) { ?>
                <div class="text-and-picture-section__picture">
                    <div class="text-and-picture-section__width">
                        <div class="text-and-picture-section__placeholder">
                            <?= $ImageWithText->renderParamsImage(); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
