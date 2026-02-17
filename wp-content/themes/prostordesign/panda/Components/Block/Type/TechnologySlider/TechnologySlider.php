<?php

use Utils\Image;
use Layouts\Block\BlockModel;
use Components\Block\Type\TechnologySlider\TechnologySliderFactory;
use Components\TechnologyQuery\TechnologyQueryFactory;

$TechnologySlider = TechnologySliderFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);

$TechnologyQuery = TechnologyQueryFactory::create($TechnologySlider->getParamsRobots());
?>
<section class="base-section  technology-section <?= $TechnologySlider->renderSectionSettingsClass(); ?>">
    <div class="container ">

        <?php if ($TechnologySlider->isParamsTitle()) { ?>
            <header class="base-header -mb-base technology-section__header">
                <?= $PageBlock->renderHeadline($TechnologySlider->getPostId(), $TechnologySlider->getParamsTitle(), "base-header__heading base-heading technology-section__heading"); ?>
            </header>
        <?php } ?>

        <div class="technology-section__technology">

            <?php if ($TechnologySlider->isParamsLinkText() && $TechnologySlider->isParamsLinkUrl()) { ?>
                <div class="technology-section__other-technology">
                    <a class="link" href="<?= $TechnologySlider->getParamsLinkUrl(); ?>">
                        <span>
                            <?= $TechnologySlider->getParamsLinkText(); ?>
                        </span>

                        <img class="link__img--dotts" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-dotts.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                        <img class="link__img--arrow" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow.svg"); ?>" alt="" draggable="false" aria-hidden="true">

                    </a>
                </div>
            <?php } ?>

            <?php if ($TechnologyQuery->hasPosts()) { ?>
                <div class="splide technology-section__row">
                    <div class="splide__track">
                        <ul class="splide__list">

                            <?= $TechnologyQuery->thePosts(); ?>

                        </ul>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>
</section>
