<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\IntroServices\IntroServicesFactory;

$IntroServices = IntroServicesFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<?php get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs"); ?>

<section class="base-section  intro-section <?= $IntroServices->renderSectionSettingsClass(); ?>">
    <div class="container ">
        <div class="intro-section__content">

            <?php if ($IntroServices->isParamsTitle() || $IntroServices->isParamsContent() || $IntroServices->isParamsButtonText()) { ?>
                <header class="base-header intro-section__header">

                    <?php if ($IntroServices->isParamsTitle()) { ?>
                        <?= $PageBlock->renderHeadline($IntroServices->getPostId(), $IntroServices->getParamsTitle(), "base-header__heading base-heading"); ?>
                    <?php } ?>

                    <?php if ($IntroServices->isParamsContent()) { ?>
                        <p class="base-header__perex ">
                            <?= $IntroServices->getParamsContent(); ?>
                        </p>
                    <?php } ?>


                    <?php if ($IntroServices->isParamsButton()) { ?>
                        <a class="btn  --primary intro-section__btn" href="<?= $IntroServices->getParamsButtonUrl(); ?>" <?= $IntroServices->getButtonTarget(); ?>>
                            <span>
                                <?= $IntroServices->getParamsButtonText(); ?>
                            </span>
                        </a>
                    <?php } elseif ($IntroServices->isParamsButtonPopUp()) { ?>
                        <button class="btn  --primary intro-section__btn --requestPopup" type="button">
                            <span>
                                <?= $IntroServices->getParamsButtonText(); ?>
                            </span>
                        </button>
                    <?php } ?>

                </header>
            <?php } ?>

            <?php if ($IntroServices->isParamsImage()) { ?>
                <div class="intro-section__placeholder">
                    <?= $IntroServices->renderImage(); ?>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<?php if ($IntroServices->isParamsButtonPopUp()) {
    get_template_part(COMPONENTS_PATH . "Block/Type/IntroServices/partials/IntroServicesContactForm");
} ?>