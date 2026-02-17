<?php

$isProductCategory = is_tax('product_cat');

// Kinda hacky way, but cant make work template taxonomy-product_cat.php
if ($isProductCategory) {
    get_template_part(LAYOUTS_PATH . "ProductCategory/ProductCategory");
} else {
    get_template_part(LAYOUTS_PATH . "PostArchive/PostArchive");
}
