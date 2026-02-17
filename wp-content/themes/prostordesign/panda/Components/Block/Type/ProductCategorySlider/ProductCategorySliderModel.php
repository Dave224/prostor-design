<?php

namespace Components\Block\Type\ProductCategorySlider;

use Components\Block\BlockConfig;
use Utils\Util;

/**
 * Class ProductCategorySliderModel
 * @package Components\Block\Type\ProductCategorySlider
 */
class ProductCategorySliderModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(ProductCategorySliderConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(ProductCategorySliderConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(ProductCategorySliderConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(ProductCategorySliderConfig::PARAMS_TITLE);
    }

    public function getParamsDescription(): ?string
    {
        return $this->getMetaValue(ProductCategorySliderConfig::PARAMS_DESCRIPTION);
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(ProductCategorySliderConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(ProductCategorySliderConfig::PARAMS_BUTTON_URL);
    }

    public function getParamsProductCategories(): ?array
    {
        return $this->getMetaValue(ProductCategorySliderConfig::PARAMS_CATEGORIES);
    }


    //? --- Issety -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsDescription(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsDescription());
    }

    public function isParamsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonText());
    }

    public function isParamsButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonUrl());
    }

    public function isParamsButton(): bool
    {
        return $this->isParamsButtonUrl() && $this->isParamsButtonText();
    }

    public function isParamsProductCategories(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getParamsProductCategories());
    }
}
