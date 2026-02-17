<?php

namespace Components\Block\Type\ImageWithText;

use Components\Block\BlockConfig;
use Helpers\ImageCreator;
use Utils\Image;
use Utils\uString;
use Utils\Util;

/**
 * Class ImageWithTextModel
 * @package Components\Block\Type\ImageWithText
 */
class ImageWithTextModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post);
    }

    public function getParamsImageSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsImageId(), $width, $height);
    }

    public function renderParamsImage()
    {
        $ParamsImage = new ImageCreator($this->getParamsImageId());

        $ParamsImage->setSrc($this->getParamsImageSize(737, 418));
        $ParamsImage->addToSrcset($this->getParamsImageSize(737, 418), "1x");
        // $ParamsImage->addToSrcset($this->getParamsImageSize(1538, 836), "2x");
        $ParamsImage->setDraggable(false);

        $ParamsImageAlt = get_post_meta($this->getParamsImageId(), '_wp_attachment_image_alt', true);
        $ParamsImageTitle = get_the_title($this->getParamsImageId());

        if ($ParamsImageAlt) {
            $ParamsImage->setAlt($ParamsImageAlt);
        } else {
            $ParamsImage->setAlt($ParamsImageTitle);
        }

        return $ParamsImage->render();
    }

    //? --- Getry -------------------------------------------------------------

    //* --- Nastavení bloku
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(ImageWithTextConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(ImageWithTextConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(ImageWithTextConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Další nastavení bloku
    //* --- Prefix: AdditionalSettings

    public function getAdditionalSettingsImagePosition(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::ADDITIONAL_SETTINGS_IMAGE_POSITION);
    }

    public function getAdditionalSettingsImageSize(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::ADDITIONAL_SETTINGS_IMAGE_SIZE);
    }

    public function getAdditionalSettingsSectionColor(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::ADDITIONAL_SETTINGS_SECTION_COLOR);
    }

    public function getAdditionalSettingsTextPosition(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::ADDITIONAL_SETTINGS_TEXT_POSITION);
    }

    public function renderAdditionalSettingsClass(): ?string
    {
        $AdditionalClass = $this->getAdditionalSettingsImagePosition();
        $AdditionalClass .= " " . $this->getAdditionalSettingsImageSize();
        $AdditionalClass .= " " . $this->getAdditionalSettingsSectionColor();
        $AdditionalClass .= " " . $this->getAdditionalSettingsTextPosition();

        return $AdditionalClass;
    }

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return html_entity_decode($this->getMetaValue(ImageWithTextConfig::PARAMS_CONTENT));
    }

    public function getParamsImageId(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::PARAMS_IMAGE_ID);
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(ImageWithTextConfig::PARAMS_BUTTON_URL);
    }

    //? --- Issety ------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsContent());
    }

    public function isParamsImageId(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsImageId());
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

}
