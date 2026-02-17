<?php
use Utils\Image;
use Components\Product\ProductFactory;

$Product = ProductFactory::create();
?>

<li class="splide__slide">
    <article class="product-detail-item">
        <a class="product-detail-item__link" href="<?= $Product->getPermalink(); ?>">
            <?php if ($Product->hasThumbnail()) { ?>
                <div class="product-detail-item__img-placeholder">
                    <?= $Product->renderThumbnailSlider(); ?>
                </div>
            <?php } ?>

            <div class="product-detail-item__content">
                <h2 class="product-detail-item__title article-heading"><?= $Product->getTitle(); ?></h2>
                <p class="product-detail-item__perex">
                    <?= $Product->getExcerptClean(); ?>
                </p>

                <div class="product-detail-item__more-info">
                    <div>
                        <?php if ($Product->isPriceDiscountPrice()) { ?>
                            <div class="product-detail-item__price --sale">
                                <div class="product-detail-item__price-full">
                                    <span class="product-detail-item__"><?= $Product->getPriceBasicPriceFancy(); ?></span>
                                </div>

                                <div class="product-detail-item__price-without-vat">
                                    <span><?= $Product->getPriceWithoutTaxPriceFancy(); ?></span>
                                </div>
                            </div>
                            <div class="product-detail-item__price">
                                <div class="product-detail-item__price-full">
                                    <span class="product-detail-item__"><?= $Product->getPriceDiscountPriceFancy(); ?></span>
                                </div>
                                <div class="product-detail-item__price-without-vat">
                                    <span><?= $Product->getPriceWithoutTaxPriceDiscountFancy(); ?></span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="product-detail-item__price">
                                <div class="product-detail-item__price-full">
                                    <span class="product-detail-item__"><?= $Product->getPriceBasicPriceFancy(); ?></span>
                                </div>
                                <div class="product-detail-item__price-without-vat">
                                    <span><?= $Product->getPriceWithoutTaxPriceFancy(); ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="btn --primary product-detail-item__btn">
                        <span><?php _e("detail", "PD_DOMAIN"); ?></span>
                        <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                    </div>
                </div>
            </div>
            <?php if ($Product->isPriceDiscountPrice()) { ?>
                <div class="product-detail-item__sale">
                    <span><?php _e("Akce", "PD_DOMAIN"); ?></span>
                </div>
            <?php } ?>
        </a>
    </article>
</li>