<?php

namespace Components\Block\Type\BlockWithCard;

use Utils\Util;
use Utils\Image;
use Utils\uString;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\BlockWithCard\BlockWithCardConfig;

/**
 * Class BlockWithCardModel
 * @package Components\Block\Type\BlockWithCard
 */
class BlockWithCardModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getFirstImageSize($width, $height)
    {
        return Image::getCloudImage($this->getFirstCardImage(), $width, $height);
    }

    public function renderFirstImage()
    {
        $Image = new ImageCreator($this->getFirstCardImage());

        $Image->setSrc($this->getFirstImageSize(405, 242));
        $Image->addToSrcset($this->getFirstImageSize(405, 242), "1x");
        $Image->addToSrcset($this->getFirstImageSize(810, 484), "2x");
        $Image->setDraggable(false);

        $ImageAlt = get_post_meta($this->getFirstCardImage(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getFirstCardImage());

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render();
    }

    public function getSecondImageSize($width, $height)
    {
        return Image::getCloudImage($this->getSecondCardImage(), $width, $height);
    }

    public function renderSecondImage()
    {
        $Image = new ImageCreator($this->getSecondCardImage());

        $Image->setSrc($this->getSecondImageSize(405, 242));
        $Image->addToSrcset($this->getSecondImageSize(405, 242), "1x");
        $Image->addToSrcset($this->getSecondImageSize(810, 484), "2x");
        $Image->setDraggable(false);

        $ImageAlt = get_post_meta($this->getSecondCardImage(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getSecondCardImage());

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
        return $this->getMetaValue(BlockWithCardConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(BlockWithCardConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(BlockWithCardConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return apply_filters("the_content", $this->getMetaValue(BlockWithCardConfig::PARAMS_CONTENT));
    }

    //* --- Parametry karty
    //* --- Prefix: FirstCard

    public function getFirstCardTitle(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::FIRST_CARD_TITLE);
    }

    public function getFirstCardDesc(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::FIRST_CARD_DESC);
    }

    public function getFirstCardImage(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::FIRST_CARD_IMAGE);
    }

    public function getFirstCardButtonText(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::FIRST_CARD_BUTTON_TEXT);
    }

    public function getFirstCardButtonUrl(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::FIRST_CARD_BUTTON_URL);
    }

    //* --- Parametry karty 2
    //* --- Prefix: SecondCard

    public function getSecondCardTitle(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::SECOND_CARD_TITLE);
    }

    public function getSecondCardDesc(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::SECOND_CARD_DESC);
    }

    public function getSecondCardImage(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::SECOND_CARD_IMAGE);
    }

    public function getSecondCardButtonText(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::SECOND_CARD_BUTTON_TEXT);
    }

    public function getSecondCardButtonUrl(): ?string
    {
        return $this->getMetaValue(BlockWithCardConfig::SECOND_CARD_BUTTON_URL);
    }

    public function getSecondCardButtonIco(): ?bool
    {
        return $this->getMetaValue(BlockWithCardConfig::SECOND_CARD_BUTTON_ICO);
    }

    public function getSecondCardButtonClass(): ?string
    {
        $class = "";
        if ($this->isSecondCardButtonIco()) {
            $class = "btn  --primary --ico-first";
            return $class;
        } else {
            $class = "btn  --primary --arrow-small";
            return $class;
        }
    }

    public function getSecondCardButtonImage(): ?string
    {
        $image = "";
        if ($this->isSecondCardButtonIco()) {
            $image = "svg/shopping-cart.svg";
            return $image;
        } else {
            $image = "svg/arrow-small-white.svg";
            return $image;
        }
    }


    //? --- Issety -------------------------------------------------------------


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

    //* --- Parametry karty
    //* --- Prefix: FirstCard

    public function isFirstCard(): bool
    {
        if ($this->isFirstCardTitle() || $this->isFirstCardDesc() || $this->isFirstCardImage() || $this->isFirstCardButtonText() || $this->isFirstCardButtonUrl()) {
            return true;
        } else {
            return false;
        }
    }

    public function isFirstCardTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstCardTitle());
    }

    public function isFirstCardDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstCardDesc());
    }

    public function isFirstCardImage(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstCardImage());
    }

    public function isFirstCardButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstCardButtonText());
    }

    public function isFirstCardButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstCardButtonUrl());
    }

    //* --- Parametry karty 2
    //* --- Prefix: SecondCard

    public function isSecondCard(): bool
    {
        if ($this->isSecondCardTitle() || $this->isSecondCardDesc() || $this->isSecondCardImage() || $this->isSecondCardButtonText() || $this->isSecondCardButtonUrl()) {
            return true;
        } else {
            return false;
        }
    }

    public function isSecondCardTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondCardTitle());
    }

    public function isSecondCardDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondCardDesc());
    }

    public function isSecondCardImage(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondCardImage());
    }

    public function isSecondCardButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondCardButtonText());
    }

    public function isSecondCardButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondCardButtonUrl());
    }

    public function isSecondCardButtonIco(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondCardButtonIco());
    }
}
