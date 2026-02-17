<?php

use Utils\Image;
use Layouts\Block\BlockModel;
use Components\Block\Type\ProductCategorySlider\ProductCategorySliderFactory;
use Components\Product\Term\ProductCategoryFactory;

$ProductCategorySliderBlock = ProductCategorySliderFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>
<section class="base-section products-section --animated <?= $ProductCategorySliderBlock->renderSectionSettingsClass(); ?>">
    <div class="container">

        <?php if ($ProductCategorySliderBlock->isParamsTitle() || $ProductCategorySliderBlock->isParamsDescription()) { ?>
            <header class="base-header -mb-base">
                <?= $PageBlock->renderHeadline($ProductCategorySliderBlock->getPostId(), $ProductCategorySliderBlock->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php if ($ProductCategorySliderBlock->isParamsDescription()) { ?>
                    <p class="base-header__perex ">
                        <?= $ProductCategorySliderBlock->getParamsDescription(); ?>
                    </p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($ProductCategorySliderBlock->isParamsProductCategories()) { ?>
            <div class="splide products-section__row">
                <div class="splide__track">
                    <ul class="splide__list">
                       <?php foreach ($ProductCategorySliderBlock->getParamsProductCategories() as $Category) {
                           $ProductCategory = ProductCategoryFactory::createById($Category)?>
                            <li class="splide__slide ">
                                <a href="<?= $ProductCategory->getPermalink(); ?>" class="product-item">
                                    <?php if ($ProductCategory->isImageForBlockId()) { ?>
                                        <div class="product-item__img">
                                            <?= $ProductCategory->renderImageForBlock(); ?>
                                        </div>
                                    <?php } ?>

                                    <div class="product-item__text">
                                        <h3 class="article-heading">
                                            <?= $ProductCategory->getTitle(); ?>
                                        </h3>

                                        <div class="btn  --primary --arrow-small">
                                            <span><?php _e("Prohlédnout", "PD_DOMAIN"); ?></span>
                                            <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-small-white.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <?php if ($ProductCategorySliderBlock->isParamsButton()) { ?>
            <a class="btn  --primary --eshop products-section__btn" href="<?= $ProductCategorySliderBlock->getParamsButtonUrl(); ?>">
                <span><?= $ProductCategorySliderBlock->getParamsButtonText(); ?></span>
                <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/shopping-cart.svg"); ?>" alt="" aria-hidden="true" draggable="false">
            </a>
        <?php } ?>
    </div>
</section>
