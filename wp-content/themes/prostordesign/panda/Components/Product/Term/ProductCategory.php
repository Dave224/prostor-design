<?php


namespace Components\Product\Term;

use Components\Product\Product;

/**
 * Class ProductCategory
 * @package Components\Product\Term
 */
class ProductCategory
{
    const KEY    = "product_cat";
    const PREFIX = Product::KEY . "-term-" . self::KEY;
}
