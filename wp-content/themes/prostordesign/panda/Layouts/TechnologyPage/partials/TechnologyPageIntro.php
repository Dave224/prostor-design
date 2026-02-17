<?php

use Layouts\TechnologyPage\TechnologyPageFactory;

$TechnologyPage = TechnologyPageFactory::create();
?>

<section class="base-section  intro-section   <?= $TechnologyPage->renderSectionSettingsClass(); ?> --gray-intro-bg">
    <div class="container ">
        <div class="intro-section__content">
            <?php if ($TechnologyPage->isParamsTitle() || $TechnologyPage->isParamsDescription() || $TechnologyPage->isParamsButtonUrl()) { ?>
                <header class="base-header intro-section__header">

                    <?php if ($TechnologyPage->isParamsTitle()) { ?>
                        <h1 class="base-header__heading base-heading">
                            <?= $TechnologyPage->getParamsTitle(); ?>
                        </h1>
                    <?php } ?>

                    <?php if ($TechnologyPage->isParamsDescription()) { ?>
                        <p class="base-header__perex ">
                            <?= $TechnologyPage->getParamsDescription(); ?>
                        </p>
                    <?php } ?>

                    <?php if ($TechnologyPage->isParamsButtonText() && $TechnologyPage->isParamsButtonUrl()) { ?>
                        <a class="btn  --primary intro-section__btn" href="<?= $TechnologyPage->getParamsButtonUrl(); ?>" <?= $TechnologyPage->getButtonTarget(); ?>>
                            <span>
                                <?= $TechnologyPage->getParamsButtonText(); ?>
                            </span>
                        </a>
                    <?php } elseif ($TechnologyPage->isParamsButtonText()) { ?>
                        <button class="btn  --primary intro-section__btn --requestPopup" type="button">
                            <span>
                                <?= $TechnologyPage->getParamsButtonText(); ?>
                            </span>
                        </button>
                    <?php } ?>

                </header>
            <?php } ?>

            <?php if ($TechnologyPage->isParamsImage()) { ?>
                <div class="intro-section__placeholder">
                    <?= $TechnologyPage->renderImage(); ?>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
