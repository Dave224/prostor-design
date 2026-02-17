<?php
use Utils\Image;
use Components\Product\ProductFactory;

$Product = ProductFactory::create();
$Currency = get_woocommerce_currency();
?>
<div class="shop-popup" data-currency="<?= $Currency; ?>">
    <div class="shop-popup__block">
        <div class="shop-popup__form">
            <h2 class="base-subheading shop-popup__main-heading"><?php _e("ZBOŽÍ BYLO PŘIDÁNO DO KOŠÍKU", "PD_DOMAIN"); ?></h2>
            <div class="shop-popup__content">
                <?php if ($Product->hasThumbnail()) { ?>
                    <div class="shop-popup__img">
                        <?= $Product->renderThumbnailPopUp(); ?>
                    </div>
                <?php } ?>
                <div>
                    <h3 class="article-heading shop-popup__heading"><?= $Product->getTitle(); ?></h3>
                    <ul class="shop-popup__parameter-list">
                        <li class="shop-popup__parameter">
                            <h4 class="base-text shop-popup__parameter--name"><?php _e("Množství", "PD_DOMAIN"); ?>:</h4>
                            <span class="shop-popup__parameter--value --number"></span>
                        </li>
                        <?php if ($Product->isVariationsProduct() && $Product->isProductVariants() && $Product->isProductAttributesTerms()) {
                            foreach ($Product->getProductAttributesTerms() as $key => $Attribute) { ?>
                                <li class="shop-popup__parameter">
                                    <h4 class="base-text shop-popup__parameter--name"><?= $key; ?>:</h4>
                                    <span class="shop-popup__parameter--value --<?= $key; ?>"></span>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                    <div class="shop-popup__price-block">
                        <h4 class="base-text shop-popup__parameter--name"><?php _e("Cena", "PD_DOMAIN"); ?></h4>
                        <div>
                            <div class="shop-popup__price">
                                <span class="shop-popup__price-value"><?= $Product->getPriceBasicPriceFancy(); ?></span>
                            </div>
                            <div class="shop-popup__price--no-dph">
                                <span class="shop-popup__price-value"><?= $Product->getPriceWithoutTaxPriceFancy(); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-popup__buttons">
                <button class="btn --secondary --ico-first --close-form-btn">
                    <span>
                        <?php _e("zpět do obchodu", "PD_DOMAIN"); ?>
                    </span>
                    <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right-blue.svg"); ?>" aria-hidden="true" draggable="false"/>
                </button>

                <a class="btn --primary cart-button" href="<?= wc_get_cart_url(); ?>">
                    <span>
                        <?php _e("objednat", "PD_DOMAIN"); ?>
                    </span>
                    <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" aria-hidden="true" draggable="false"/>
                </a>
            </div>
        </div>
        <span class="shop-popup__cross"></span>
    </div>
</div>
