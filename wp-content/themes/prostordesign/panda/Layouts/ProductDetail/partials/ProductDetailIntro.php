<?php
use Utils\Util;
use Utils\Image;
use Components\Product\ProductFactory;

$Product = ProductFactory::create();
?>
<section class="base-section product-detail-intro-section --gray-intro-bg --p-top-0 --breadcrumbs-padding --p-bottom-0">
    <div class="container ">
        <div class="product-detail-intro-section__body">

            <?php get_template_part(LAYOUTS_PATH . "ProductDetail/partials/ProductDetailGallery") ?>

            <div class="product-detail-intro-section__text">

                <form class="product-detail-intro-section__form" action="">

                    <h1 class="product-detail-intro-section__title base-heading">
                        <?= $Product->getTitle(); ?>
                    </h1>
                    <p class="product-detail-intro-section__perex base-text">
                        <?= $Product->getExcerptClean(); ?>
                    </p>

                    <ul class="product-detail-intro-section__list">
                        <?php if ($Product->isProductDimensions()) { ?>
                            <li>
                                <span class="product-detail-intro-section__heading base-text"><?php _e("Rozměr", "PD_ADMIN_DOMAIN"); ?>:</span>
                                <p><?= $Product->getProductDimensions(); ?></p>
                            </li>
                        <?php } ?>
                        <?php if ($Product->isProductWeight()) { ?>
                            <li>
                                <span class="product-detail-intro-section__heading base-text"><?php _e("Váha", "PD_ADMIN_DOMAIN"); ?>:</span>
                                <p><?= $Product->getProductWeight(); ?> kg</p>
                            </li>
                        <?php } ?>
                        <?php if ($Product->isProductAttributes()) {
                            foreach ($Product->getProductAttributes()[0] as $Attribute) {
                                if (Util::issetAndNotEmpty($Attribute["value"])) { ?>
                                    <li>
                                        <span class="product-detail-intro-section__heading base-text"><?= $Attribute["name"]; ?>:</span>
                                        <p><?= $Attribute["value"]; ?></p>
                                    </li>
                                <?php } ?>
                        <?php }
                        } ?>
                        <?php if ($Product->isVariationsProduct() && $Product->isProductVariants() && $Product->isProductAttributesTerms()) {
                            if (Util::arrayIssetAndNotEmpty($Product->getProductAttributesTerms())) {
                            foreach ($Product->getProductAttributesTerms() as $key => $Attribute) { ?>
                                <li class="product-detail-intro-section__select-item">
                                    <label class="product-detail-intro-section__label" for="<?= $key; ?>">
                                        <span class="product-detail-intro-section__heading base-text"><?= $key; ?>:</span>
                                    </label>
                                    <div class="product-detail-intro-section__select-wrapper">
                                        <select class="product-detail-intro-section__select" name="<?= $key; ?>" id="<?= $key; ?>">
                                            <?= $Product->getProductVariantsForSelect($key); ?>
                                        </select>
                                        <img class="product-detail-intro-section__select-icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-down.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                    </div>
                                </li>
                            <?php } } ?>
                        <?php } ?>
                        <li class="product-detail-intro-section__availability-wrapper <?php if (!$Product->isVariationsProduct()) { ?>--no-margin-left<?php } ?>">
                            <div class="product-detail-intro-section__availability">
                                <span class="product-detail-intro-section__heading base-text"><?php _e("Dostupnost", "PD_DOMAIN"); ?>:</span>
                                <p class="product-detail-intro-section__variants <?= $Product->getStockStatusClass(); ?>"><?= $Product->getStockStatusFancy(); ?></p>
                            </div>
                        </li>
                    </ul>

                    <div class="product-detail-intro-section__ad-to-cart">
                        <div class="product-detail-intro-section__order">
                            <div>
                                <?php if ($Product->isPriceDiscountPrice()) { ?>
                                    <div class="product-detail-intro-section__price --sale">
                                        <div class="product-detail-intro-section__price-full">
                                            <span class="product-detail-item__"><?= $Product->getPriceBasicPriceFancy(); ?></span>
                                        </div>

                                        <div class="product-detail-intro-section__price-without-vat">
                                            <span><?= $Product->getPriceWithoutTaxPriceFancy(); ?></span>
                                        </div>
                                    </div>

                                    <div class="product-detail-intro-section__price">
                                        <div class="product-detail-intro-section__price-full">
                                            <span class="product-detail-intro-section__price-number"><?= $Product->getPriceDiscountPriceFancy(); ?></span>
                                        </div>
                                        <div class="product-detail-intro-section__price-without-vat">
                                            <span class="base-text product-detail-intro-section__price-number"><?= $Product->getPriceWithoutTaxPriceDiscountFancy(); ?></span>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="product-detail-intro-section__price">
                                        <div class="product-detail-intro-section__price-full">
                                            <span class="product-detail-intro-section__price-number"><?= $Product->getPriceBasicPriceFancy(); ?></span>
                                        </div>
                                        <div class="product-detail-intro-section__price-without-vat">
                                            <span class="base-text product-detail-intro-section__price-number"><?= $Product->getPriceWithoutTaxPriceFancy(); ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="product-detail-intro-section__count">
                                <button class="product-detail-intro-section__btn-minus" type="button">-</button>
                                <input class="product-detail-intro-section__input js-product-quantity" type="number" min="1" step="1" value="1">
                                <button class="product-detail-intro-section__btn-plus" type="button">+</button>
                            </div>
                        </div>

                        <button class="btn --primary product-detail-intro-section__btn js-product-button" type="button">
                            <span>
                                <?php _e("do košíku", "PD_DOMAIN"); ?>
                            </span>
                            <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/shopping-cart.svg"); ?>" alt="Do košíku" draggable="false" />
                        </button>
                        <input type="hidden" name="add-to-cart" class="js-product-id" value="<?= $Product->getPostId(); ?>" />
                        <input type="hidden" name="variation_id" class="variation_id js-variation-id" value="0" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
