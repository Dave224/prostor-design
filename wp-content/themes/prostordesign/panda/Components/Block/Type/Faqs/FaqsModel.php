<?php

namespace Components\Block\Type\Faqs;

use Utils\Util;
use Components\Block\BlockConfig;

/**
 * Class FaqsModel
 * @package Components\Block\Type\Faqs
 */
class FaqsModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(FaqsConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(FaqsConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(FaqsConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(FaqsConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(FaqsConfig::PARAMS_CONTENT);
    }

    public function getParamsBackground(): ?string
    {
        return $this->getMetaValue(FaqsConfig::PARAMS_BACKGROUND);
    }

    public function getBackground(): ?string
    {
        if ($this->isParamsBackground()) {
            return "dark";
        } else {
            return "light";
        }
    }

    //* --- Výhody
    //* --- Prefix: DynamicFaqs

    public function getDynamicFaqsField(): ?array
    {
        return $this->getMetaValue(FaqsConfig::FAQS_DYNAMIC_FIELD);
    }

    public function getFaqsCollection(): ?array
    {
        $Faqs = [];
        $Iterator = 0;

        foreach ($this->getDynamicFaqsField() as $Field) {
            $Title = $Field[FaqsConfig::FAQS_TITLE];
            $Description = html_entity_decode($Field[FaqsConfig::FAQS_DESCRIPTION]);

            $Faqs["n-" . $Iterator] = [
                $Title,
                $Description,
            ];

            $Iterator++;
        }


        return $Faqs;
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

    //* --- Výhody
    //* --- Prefix: DynamicFaqs

    public function isDynamicFaqsField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicFaqsField());
    }
}
