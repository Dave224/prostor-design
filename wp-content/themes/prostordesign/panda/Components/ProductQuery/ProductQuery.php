<?php

namespace Components\ProductQuery;

use Components\Product\Product;
use Components\Product\Term\ProductCategory;
use Utils\Util;
use Presenters\QueryBase;

/**
 * Class ProductQuery
 * @package Components\ProductQuery
 */
class ProductQuery extends QueryBase
{
    private $CategoryIds;
    private $PostIn;

    public function __construct($maxCount = self::DEFAULT_COUNT, $PostIn = [], $CategoryIds = [])
    {
        parent::__construct($maxCount = self::DEFAULT_COUNT);
        $this->setMaxCount($maxCount) ?: self::DEFAULT_COUNT;
        $this->setPostIn($PostIn);
        $this->setCategoryIds($CategoryIds);
        $this->setPostType(Product::KEY);
        $this->setComponent(Product::class);
        $this->setTemplate(Product::TEMPLATE);
        $this->initArgs();
    }


    // Custom Args for Query
    public function initArgs()
    {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $Args = [
            "post_type" => $this->getPostType(),
            "paged" => $paged,
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "post_date",
            "order" => \KT_Repository::ORDER_DESC,
        ];

        // except himself
        if (is_single()) {
            $Args["post__not_in"] = [get_the_ID()];
        }

        if ($this->isPostIn()) {
            $Args["post__in"] = $this->getPostIn();
        }

        // category

        $taxQuery = ["relation" => "AND"];
        if (is_tax(ProductCategory::KEY)) {
            array_push($taxQuery, [
                "taxonomy" => ProductCategory::KEY,
                "field" => "term_id",
                "terms" => [get_queried_object_id()],
            ]);
        }

        if ($this->isCategoryIds()) {
            array_push($taxQuery, [
                "taxonomy" => ProductCategory::KEY,
                "field" => "term_id",
                "terms" => $this->getCategoryIds(),
            ]);
        }

        $Args["tax_query"] = $taxQuery;

        return $this->setArgs($Args);
    }

    public function getCategoryIds()
    {
        return $this->CategoryIds;
    }

    public function setCategoryIds(array $CategoryIds)
    {
        $this->CategoryIds = $CategoryIds;
    }

    public function isCategoryIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getCategoryIds());
    }

    public function getPostIn()
    {
        return $this->PostIn;
    }

    public function setPostIn($PostIn)
    {
        return $this->PostIn = $PostIn;
    }

    public function isPostIn()
    {
        return Util::arrayIssetAndNotEmpty($this->getPostIn());
    }

}
