<?php

use Layouts\FrontPage\FrontPageFactory;
use Components\SchemaGenerator\SchemaGenerator;

$FrontPage = FrontPageFactory::create();

get_template_part(COMPONENTS_PATH . "Header/Header");
?>

<section class="base-section  main-intro-section --p-top-0 --p-bottom-0">
    <div class="container ">
        <div class="main-intro-section__content">
            <?php if ($FrontPage->isParamsTitle() || $FrontPage->isParamsDescription()) { ?>
                <header class="base-header  main-intro-section__header">

                    <?php if ($FrontPage->isParamsTitle()) { ?>
                        <h1 class="base-header__heading base-heading">
                            <?= $FrontPage->getParamsTitle(); ?>
                        </h1>
                    <?php } ?>

                    <?php if ($FrontPage->isParamsDescription()) { ?>
                        <p class="base-header__perex ">
                            <?= $FrontPage->getParamsDescription(); ?>
                        </p>
                    <?php } ?>

                    <?php if ($FrontPage->isParamsButtonText() || $FrontPage->isParamsButtonUrl()) { ?>
                        <a class="btn  --primary main-intro-section__btn" href="<?= $FrontPage->getParamsButtonUrl(); ?>" <?= $FrontPage->getButtonTarget(); ?>>
                            <span>
                                <?= $FrontPage->getParamsButtonText(); ?>
                            </span>
                        </a>
                    <?php } ?>

                </header>
            <?php } ?>
        </div>

        <?php if ($FrontPage->isDynamicSliderCollection()) { ?>
            <div class="swiper main-intro-section__row">
                <div class="swiper-wrapper">
                    <?php foreach ($FrontPage->getSliderCollection() as $Key => $SliderItem) { ?>
                        <div class=" swiper-slide main-intro-section__placeholder <?php if ($Key != 0) { ?>d-none d-md-block <?php } ?>">
                            <?= $SliderItem; ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>

    </div>
</section>
<?php $FrontPage->loopBlocks(); ?>
<?php
SchemaGenerator::addOrganization();

get_template_part(COMPONENTS_PATH . "Footer/Footer");
