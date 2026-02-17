<?php

namespace Components\PopUpSettings;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;

class PopUpSettingsModel extends \KT_WP_Options_Base_Model
{
    public function __construct()
    {
        parent::__construct(PopUpSettingsConfig::FORM_PREFIX);
    }

    //* --- getry & setry ------------------------

    //* --- Nastavení popUpu
    //* --- Prefix: PopUp

    public function getPopUpTitle(): ?String
    {
        return $this->getOption(PopUpSettingsConfig::POP_UP_TITLE);
    }

    public function getPopUpDescription(): ?String
    {
        return html_entity_decode($this->getOption(PopUpSettingsConfig::POP_UP_DESCRIPTION));
    }

    public function getPopUpImageId(): ?int
    {
        return $this->getOption(PopUpSettingsConfig::POP_UP_IMAGE);
    }

    public function getPopUpImageSize(int $width, int  $height): ?String
    {
        return Image::getCloudImage($this->getPopUpImageId(), $width, $height);
    }

    public function renderPopUpImage(): ?String
    {
        $Image = new ImageCreator($this->getPopUpImageId());

        $Image->setSrc($this->getPopUpImageSize(600, 600));
        $Image->setDraggable(false);

        return $Image->render();
    }

    public function getPopUpButtonText(): ?String
    {
        return $this->getOption(PopUpSettingsConfig::POP_UP_BUTTON_TEXT);
    }

    public function getPopUpButtonUrl(): ?String
    {
        return $this->getOption(PopUpSettingsConfig::POP_UP_BUTTON_URL);
    }

    public function getPopUpButtonTarget(): ?bool
    {
        return $this->getOption(PopUpSettingsConfig::POP_UP_BUTTON_TARGET);
    }

    public function getPopUpShow(): ?bool
    {
        return $this->getOption(PopUpSettingsConfig::POP_UP_SHOW);
    }

    //* --- isssety ---------------------------

    //* --- Nastavení popUpu
    //* --- Prefix: PopUp

    public function isPopUpTitle(): ?bool
    {
        return Util::issetAndNotEmpty($this->getPopUpTitle());
    }

    public function isPopUpDescription(): ?bool
    {
        return Util::issetAndNotEmpty($this->getPopUpDescription());
    }

    public function isPopUpImageId(): ?bool
    {
        return Util::issetAndNotEmpty($this->getPopUpImageId());
    }

    public function isPopUpButtonText(): ?bool
    {
        return Util::issetAndNotEmpty($this->getPopUpButtonText());
    }

    public function isPopUpButtonUrl(): ?bool
    {
        return Util::issetAndNotEmpty($this->getPopUpButtonUrl());
    }

    public function isPopUpButtonTarget(): ?bool
    {
        return Util::issetAndNotEmpty($this->getPopUpButtonTarget());
    }

    public function isPopUpButton(): ?bool
    {
        return $this->isPopUpButtonText() && $this->isPopUpButtonUrl();
    }

    public function isPopUpButtonShow(): ?bool
    {
        return Util::issetAndNotEmpty($this->getPopUpShow());
    }

}
