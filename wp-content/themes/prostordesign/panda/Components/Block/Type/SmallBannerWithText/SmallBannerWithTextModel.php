<?php

namespace Components\Block\Type\SmallBannerWithText;

use Utils\Util;

/**
 * Class SmallBannerWithTextModel
 * @package Components\Block\Type\SmallBannerWithText
 */
class SmallBannerWithTextModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post);
    }

    //? --- Getry -------------------------------------------------------------

    public function getTarget(): ?string
    {
        if ($this->isSettingsNewTab()) {
            $target = 'target="_blank"';
            return $target;
        } else {
            return "";
        }
    }

    //* --- Základní nastavení
    //* --- Prefix: Settings

    public function getSettingsButtonText(): ?string
    {
        return $this->getMetaValue(SmallBannerWithTextConfig::SETTINGS_BUTTON_TEXT);
    }

    public function getSettingsButtonUrl(): ?string
    {
        return $this->getMetaValue(SmallBannerWithTextConfig::SETTINGS_BUTTON_URL);
    }

    public function getSettingsNewTab(): ?bool
    {
        return $this->getMetaValue(SmallBannerWithTextConfig::SETTINGS_NEW_TAB);
    }

    public function getSettingsContent(): ?string
    {
        return html_entity_decode($this->getMetaValue(SmallBannerWithTextConfig::SETTINGS_CONTENT));
    }

    //? --- Issety ------------------------------------------------------------

    //* --- Základní nastavení
    //* --- Prefix: Settings

    public function isSettingsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getSettingsButtonText());
    }

    public function isSettingsButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getSettingsButtonUrl());
    }

    public function isSettingsNewTab(): bool
    {
        return Util::issetAndNotEmpty($this->getSettingsNewTab());
    }

    public function isSettingsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getSettingsContent());
    }
}
