<?php

use Components\SchemaGenerator\SchemaGenerator;
use Components\Product\ProductFactory;
use Components\BlocksStaticLayouts\BlocksStaticLayoutsFactory;
use Components\BlocksStaticLayouts\BlocksStaticLayoutsConfig;

$Blocks = BlocksStaticLayoutsFactory::create();
$Product = ProductFactory::create();
SchemaGenerator::addProduct($Product);

get_template_part(COMPONENTS_PATH . "HeaderEshop/HeaderEshop");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/BreadcrumbsWithoutIntro");

get_template_part(LAYOUTS_PATH . "ProductDetail/partials/ProductDetailIntro");
get_template_part(LAYOUTS_PATH . "ProductDetail/partials/ProductDetailContent");
get_template_part(LAYOUTS_PATH . "ProductDetail/partials/ProductDetailSimilarProducts");
get_template_part(LAYOUTS_PATH . "ProductDetail/partials/ProductDetailPopUp");

if ($Product->isBlocksIds()) {
    $Product->loopBlocks();
} else {
    $Blocks->loopBlocks(null, BlocksStaticLayoutsConfig::PRODUCT_DETAIL_BLOCK_INPUT);
}

get_template_part(COMPONENTS_PATH . "Footer/Footer");
