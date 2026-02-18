<?php

namespace Components\ProductQuery;

use Components\Product\Product;
use Components\Product\ProductConfig;
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
    private $Filters;

    public function __construct($maxCount = self::DEFAULT_COUNT, $PostIn = [], $CategoryIds = [], $Filters = [])
    {
        parent::__construct($maxCount = self::DEFAULT_COUNT);
        $this->setMaxCount($maxCount) ?: self::DEFAULT_COUNT;
        $this->setPostIn($PostIn);
        $this->setCategoryIds($CategoryIds);
        $this->setFilters($Filters);
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

        $metaQuery = ["relation" => "AND"];
        if ($this->isFilters()) {
            $filters = $this->getFilters();
            foreach ($filters as $key => $filter) {
                $value = '"' . $key . '";s:27:"' . ProductConfig::FILTRATION_VALUE . '";s:' . strlen($filter) . ':"' . $filter . '";';
                array_push($metaQuery, [
                    'key' => ProductConfig::DYNAMIC_FILTRATION_FIELD,
                    'value' => $value,
                    'compare' => 'LIKE',
                ]);
            }
        }
        $Args["meta_query"] = $metaQuery;

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

    public function getFilters()
    {
        return $this->Filters;
    }

    public function setFilters(array $Filters)
    {
        $this->Filters = $Filters;
    }

    public function isFilters(): ?bool
    {
        return Util::arrayIssetAndNotEmpty($this->getFilters());
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
