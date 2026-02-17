<?php
use Components\Product\Product;
use Components\Product\ProductFactory;
use Components\ProductQuery\ProductQueryFactory;

$Product = ProductFactory::create();
$ProductQuery = ProductQueryFactory::create(-1, $Product->getSimilarProductsIds());
$ProductQuery->setTemplate(Product::TEMPLATE_SLIDER);
?>

<?php if ($ProductQuery->hasPosts()) { ?>
    <section class="base-section product-slider-section --p-top-0">
        <div class="container ">
            <header class="base-header -mb-base">
                <h2 class="base-header__heading base-heading">
                    <?php _e("Další produkty", "PD_DOMAIN"); ?>
                </h2>
            </header>

            <div class="splide product-slider-section__row">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php $ProductQuery->thePosts(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php } ?>