<?php

namespace Components\Block\Type\ProductCategories;

use Components\Block\BlockConfig;
use Components\Product\Term\ProductCategory;
use Components\Product\Term\ProductCategoryConfig;
use Components\Product\Term\ProductCategoryFactory;
use Utils\Util;

/**
 * Class ProductCategoriesModel
 * @package Components\Block\Type\ProductCategories
 */
class ProductCategoriesModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    //? --- Gettery -------------------------------------------------------------

    //* --- Nastavení bloku
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(ProductCategoriesConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(ProductCategoriesConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(ProductCategoriesConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsProductCategories(): ?array
    {
        return $this->getMetaValue(ProductCategoriesConfig::PARAMS_CATEGORIES);
    }

    public function getProductCategories(): ?array
    {
        $PrepareCategories = [];
        if ($this->isParamsProductCategories()) {
            $ProductCategories = $this->getParamsProductCategories();
            foreach ($ProductCategories as $ProductCategory) {
                $CategoryModel = ProductCategoryFactory::createById($ProductCategory);
                array_push($PrepareCategories, $CategoryModel);
            }
            return $PrepareCategories;
        }

        $ProductCategories = get_terms([
            "taxonomy" => ProductCategory::KEY,
        ]);
        foreach ($ProductCategories as $ProductCategory) {
            $CategoryModel = ProductCategoryFactory::createById($ProductCategory->term_id);
            array_push($PrepareCategories, $CategoryModel);
        }
        return $PrepareCategories;
    }

    //? --- Issety -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsProductCategories(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getParamsProductCategories());
    }
}
