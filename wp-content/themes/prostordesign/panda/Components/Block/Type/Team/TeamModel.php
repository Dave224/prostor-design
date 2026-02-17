<?php

namespace Components\Block\Type\Team;

use Components\Block\BlockConfig;
use Utils\Util;

/**
 * Class TeamModel
 * @package Components\Block\Type\Team
 */
class TeamModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(TeamConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(TeamConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(TeamConfig::SETTINGS_DIVIDER);
    }

    public function getSettingsSlider(): ?bool
    {
        return $this->getMetaValue(TeamConfig::SETTINGS_SLIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(TeamConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(TeamConfig::PARAMS_CONTENT);
    }

    public function getParamsPersons(): ?array
    {
        return $this->getMetaValue(TeamConfig::PARAMS_PERSON);
    }


    //? --- Issety -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function isParamsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsContent());
    }

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsPersons(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getParamsPersons());
    }
}
