<?php

use Utils\Image;
use Components\Block\Type\ProductCategories\ProductCategoriesFactory;

$ProductCategoriesBlock = ProductCategoriesFactory::create();
$ProductCategories = $ProductCategoriesBlock->getProductCategories();
?>
<section class="base-section product-signpost-section <?= $ProductCategoriesBlock->renderSectionSettingsClass(); ?>">
    <div class="container">
        <ul class="row g-1 product-signpost-section__list">
            <?php foreach ($ProductCategories as $ProductCategory) { ?>
                <li class="col-sm-12 col-lg-6 col-xxl-4">
                    <article class="product-signpost-item">
                        <a class="product-signpost-item__link" href="<?= $ProductCategory->getPermalink(); ?>">

                            <h2 class="product-signpost-item__title article-heading">
                                <?= $ProductCategory->getTitle(); ?>
                            </h2>

                            <div class="link">
                                <span><?php _e("Prohlédnout", "PD_DOMAIN"); ?></span>
                                <img class="link__img--dotts" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-dotts.svg"); ?>" draggable="false" alt="" aria-hidden="true">
                                <img class="link__img--arrow" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow.svg"); ?>" draggable="false" alt="" aria-hidden="true">
                            </div>

                            <?php if ($ProductCategory->isImageForBlockId()) { ?>
                                <div class="product-signpost-item__img-width">
                                    <div class="product-signpost-item__picture">
                                        <div class="product-signpost-item__img-placeholder">
                                            <?= $ProductCategory->renderImageForBlockSmaller(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </a>
                    </article>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>
