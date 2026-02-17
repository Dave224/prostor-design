<?php

namespace Components\Block\Type\Steps;

use Utils\Util;
use Components\Block\BlockConfig;

/**
 * Class StepsModel
 * @package Components\Block\Type\Steps
 */
class StepsModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(StepsConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(StepsConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(StepsConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(StepsConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(StepsConfig::PARAMS_CONTENT);
    }

    public function getParamsBackground(): ?string
    {
        return $this->getMetaValue(StepsConfig::PARAMS_BACKGROUND);
    }

    public function getBackground(): ?string
    {
        if ($this->isParamsBackground()) {
            return "dark";
        } else {
            return "light";
        }
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(StepsConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(StepsConfig::PARAMS_BUTTON_URL);
    }

    public function getParamsButtonTarget(): ?bool
    {
        return $this->getMetaValue(StepsConfig::PARAMS_BUTTON_TARGET);
    }

    //* --- Položky
    //* --- Prefix: DynamicItems

    public function getDynamicItemsField(): ?array
    {
        return $this->getMetaValue(StepsConfig::ITEMS_DYNAMIC_FIELD);
    }

    public function getItemsCollection(): ?array
    {
        $Benefits = [];
        $Iterator = 0;

        foreach ($this->getDynamicItemsField() as $Field) {
            $Title = $Field[StepsConfig::ITEMS_TITLE];
            $Description = $Field[StepsConfig::ITEMS_DESCRIPTION];

            $Benefits["n-" . $Iterator] = [
                $Title,
                $Description,
            ];

            $Iterator++;
        }


        return $Benefits;
    }

    //? --- Setter -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsContent());
    }

    public function isParamsBackground(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsBackground());
    }

    public function isParamsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonText());
    }

    public function isParamsButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonUrl());
    }

    public function isParamsButtonTarget(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonTarget());
    }

    public function isParamsButton(): bool
    {
        return $this->isParamsButtonText() && $this->isParamsButtonUrl();
    }

    //* --- Položky
    //* --- Prefix: DynamicItems

    public function isDynamicItemsField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicItemsField());
    }
}
