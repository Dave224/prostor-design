<?php

use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\SignpostServices\SignpostServicesFactory;

$SignpostServices = SignpostServicesFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
$Variant = $SignpostServices->getParamsVariant();
$VariantPath = COMPONENTS_PATH . "Block/Type/SignpostServices/variants/" . $Variant; ?>


<section class="posts-section base-section <?= $SignpostServices->renderSectionSettingsClass(); ?> <?php if ($SignpostServices->getParamsVariant() === "two") { ?>--decoration<?php } ?>">
    <div class="container">
        <div class="posts-section__body">

            <?php if ($SignpostServices->isParamsTitle()) { ?>
                <?= $PageBlock->renderHeadline($SignpostServices->getPostId(), $SignpostServices->getParamsTitle(), "posts-section__title base-heading"); ?>
            <?php } ?>
            <?php if ($SignpostServices->isParamsContent()) { ?>
                <p class="posts-section__perex large-text "><?= $SignpostServices->getParamsContent(); ?></p>
            <?php } ?>

            <?php get_template_part($VariantPath); ?>
        </div>
    </div>
</section>
