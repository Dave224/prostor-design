<?php

namespace Components\Block\Type\TechnologySlider;

use Components\Block\BlockConfig;
use Utils\Util;

/**
 * Class TechnologySliderModel
 * @package Components\Block\Type\TechnologySlider
 */
class TechnologySliderModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(TechnologySliderConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(TechnologySliderConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(TechnologySliderConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(TechnologySliderConfig::PARAMS_TITLE);
    }

    public function getParamsLinkText(): ?string
    {
        return $this->getMetaValue(TechnologySliderConfig::PARAMS_LINK_TEXT);
    }

    public function getParamsLinkUrl(): ?string
    {
        return $this->getMetaValue(TechnologySliderConfig::PARAMS_LINK_URL);
    }

    public function getParamsRobots(): ?array
    {
        return $this->getMetaValue(TechnologySliderConfig::PARAMS_ROBOTS);
    }


    //? --- Issety -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsLinkText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsLinkText());
    }

    public function isParamsLinkUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsLinkUrl());
    }

    public function isParamsRobots(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsRobots());
    }
}
