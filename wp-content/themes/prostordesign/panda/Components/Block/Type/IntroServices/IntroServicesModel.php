<?php

namespace Components\Block\Type\IntroServices;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\IntroServices\IntroServicesConfig;

/**
 * Class IntroServicesModel
 * @package Components\Block\Type\IntroServices
 */
class IntroServicesModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getImageSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsImage(), $width, $height);
    }

    public function renderImage()
    {
        $Image = new ImageCreator($this->getParamsImage());

        $Image->setSrc($this->getImageSize(1408, 697));
        $Image->addToSrcset($this->getImageSize(1408, 697), "1x");
        $Image->addToSrcset($this->getImageSize(2816, 1394), "2x");
        $Image->setDraggable(false);
        $Image->setClass("post-item__img");

        $ImageAlt = get_post_meta($this->getParamsImage(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getParamsImage());

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render();
    }

    //? --- Gettery -------------------------------------------------------------

    //* --- Nastavení bloku
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(IntroServicesConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(IntroServicesConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(IntroServicesConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::PARAMS_TITLE);
    }

    public function getParamsImage(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::PARAMS_IMAGE_ID);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::PARAMS_CONTENT);
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::PARAMS_BUTTON_URL);
    }

    public function getParamsButtonTarget(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::PARAMS_BUTTON_TARGET);
    }

    public function getButtonTarget(): ?string
    {
        $string = "";

        if ($this->isParamsButtonTarget()) {
            $string = 'target="_blank" rel="nofollow"';

            return $string;
        } else {
            return $string;
        }
    }

    //* --- Formulář
    //* --- Prefix: Form

    public function getFormTitle(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::FORM_TITLE);
    }

    public function getFormDesctiption(): ?string
    {
        return $this->getMetaValue(IntroServicesConfig::FORM_DESC);
    }


    //? --- Settery -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsImage(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsImage());
    }

    public function isParamsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsContent());
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

    public function isParamsButtonPopUp(): bool
    {
        return $this->isParamsButtonText() && !$this->isParamsButtonUrl();
    }

    //* --- Formulář
    //* --- Prefix: Form

    public function isFormTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getFormTitle());
    }

    public function isFormDesctiption(): bool
    {
        return Util::issetAndNotEmpty($this->getFormDesctiption());
    }
}
