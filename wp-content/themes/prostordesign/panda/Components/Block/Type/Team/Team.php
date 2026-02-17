<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\Team\TeamFactory;
use Components\PersonQuery\PersonQueryFactory;

$Team = TeamFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
if ($Team->getSettingsSlider()) {
    $PersonQuery = PersonQueryFactory::createSlider($Team->getParamsPersons());
} else {
    $PersonQuery = PersonQueryFactory::createWithoutSlider($Team->getParamsPersons());
}
?>

<section class="base-section <?php if ($Team->getSettingsSlider()) { ?>team-slider-section<?php } else { ?>team-section<?php } ?> <?= $Team->renderSectionSettingsClass(); ?>">
    <div class="container ">

        <?php if ($Team->isParamsTitle() || $Team->isParamsContent()) { ?>
            <header class="base-header -mb-base">
                <?php if ($Team->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Team->getPostId(), $Team->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>
                <?php if ($Team->isParamsContent()) { ?>
                    <p class="base-header__perex "><?= $Team->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($PersonQuery->hasPosts() && $Team->getSettingsSlider()) { ?>
            <div class="splide team-slider-section__row">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php $PersonQuery->thePosts(); ?>
                    </ul>
                </div>
            </div>
        <?php } else { ?>
            <ul class="team-section__list row">
                <?php $PersonQuery->thePosts(); ?>
            </ul>
        <?php } ?>
    </div>
</section>