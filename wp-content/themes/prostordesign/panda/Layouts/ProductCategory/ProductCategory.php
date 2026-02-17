<?php

use Components\BlocksStaticLayouts\BlocksStaticLayoutsFactory;
use Components\BlocksStaticLayouts\BlocksStaticLayoutsConfig;

$Blocks = BlocksStaticLayoutsFactory::create();

get_template_part(COMPONENTS_PATH . "Header/Header");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs");

get_template_part(LAYOUTS_PATH . "ProductCategory/partials/ProductCategoryIntro");
get_template_part(LAYOUTS_PATH . "ProductCategory/partials/ProductCategoryProducts");

if ($Blocks->isBlocks(BlocksStaticLayoutsConfig::PRODUCT_CATEGORIES_BLOCK_INPUT)) {
    $Blocks->loopBlocks(null, BlocksStaticLayoutsConfig::PRODUCT_CATEGORIES_BLOCK_INPUT);
}

get_template_part(COMPONENTS_PATH . "Footer/Footer");
