<?php

namespace Components\FooterHeaderSettings;

use Utils\Util;
use Utils\Image;
use Utils\uString;
use Helpers\ImageCreator;

class FooterHeaderSettingsModel extends \KT_WP_Options_Base_Model
{
    public function __construct()
    {
        parent::__construct(FooterHeaderSettingsConfig::FORM_PREFIX);
    }

    // public function getFooterLogoLogoSize(int $width, int  $height)
    // {
    //     return Image::getCloudImage($this->getFooterLogoLogo(), $width, $height);
    // }

    // public function renderFooterLogoLogo()
    // {
    //     $Image = new ImageCreator($this->getFooterLogoLogo());

    //     $Image->setSrc($this->getFooterLogoLogoSize("original", "original"));
    //     $Image->setDraggable(false);
    //     $Image->setAlt("Brilo");

    //     return $Image->render();
    // }

    //* --- getry & setry ------------------------

    //* --- Hlavní kontakt :: Header
    //* --- Prefix: Main Contact Header

    public function getMainContactHeaderPhone()
    {
        return uString::phoneNumberFormat($this->getOption(FooterHeaderSettingsConfig::MAIN_CONTACT_HEADER_PHONE));
    }

    public function getMainContactHeaderPhoneClean()
    {
        return uString::clearPhoneNumber($this->getMainContactHeaderPhone());
    }

    public function getMainContactHeaderEmail()
    {
        return $this->getOption(FooterHeaderSettingsConfig::MAIN_CONTACT_HEADER_EMAIL);
    }

    //* --- Patička :: Kariéra
    //* --- Prefix: Footer Career

    public function getFooterCareerTitle()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_CAREER_TITLE);
    }

    public function getFooterCareerDesc()
    {
        return html_entity_decode($this->getOption(FooterHeaderSettingsConfig::FOOTER_CAREER_DESC) ?? "");
    }

    public function getFooterCareerLinkText()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_CAREER_LINK_TEXT);
    }

    public function getFooterCareerLinkUrl()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_CAREER_LINK_URL);
    }

    public function getFooterCareerNewTab()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_CAREER_NEW_TAB);
    }

    public function getFooterCareerTarget()
    {
        $string = "";
        if ($this->isFooterCareerNewTab()) {
            $string = 'target="_blank" rel="nofollow"';
        }
        return $string;
    }

    //* --- Patička :: Mapa
    //* --- Prefix: Footer Map

    public function getFooterMapUrl()
    {
        return $this->getOption(FooterHeaderSettingsConfig::FOOTER_MAP_URL);
    }

    //? --- Patička logo
    //? --- Prefix: FooterLogo

    // public function getFooterLogoLogo()
    // {
    //     return $this->getOption(FooterHeaderSettingsConfig::FOOTER_LOGO_LOGO);
    // }

    //* --- isssety ---------------------------

    //* --- Hlavní kontakt :: Header
    //* --- Prefix: Main Contact Header

    public function isMainContactHeaderPhone()
    {
        return Util::issetAndNotEmpty($this->getMainContactHeaderPhone());
    }

    public function isMainContactHeaderEmail()
    {
        return Util::issetAndNotEmpty($this->getMainContactHeaderEmail());
    }

    //* --- Patička :: Kariéra
    //* --- Prefix: Footer Career

    public function isFooterCareerTitle()
    {
        return Util::issetAndNotEmpty($this->getFooterCareerTitle());
    }

    public function isFooterCareerDesc()
    {
        return Util::issetAndNotEmpty($this->getFooterCareerDesc());
    }

    public function isFooterCareerLinkText()
    {
        return Util::issetAndNotEmpty($this->getFooterCareerLinkText());
    }

    public function isFooterCareerLinkUrl()
    {
        return Util::issetAndNotEmpty($this->getFooterCareerLinkUrl());
    }

    public function isFooterCareerNewTab()
    {
        return Util::issetAndNotEmpty($this->getFooterCareerNewTab());
    }

    //* --- Patička :: Mapa
    //* --- Prefix: Footer Map

    public function isFooterMapUrl()
    {
        return Util::issetAndNotEmpty($this->getFooterMapUrl());
    }

    //? --- Patička logo
    //? --- Prefix: FooterLogo

    // public function isFooterLogoLogo()
    // {
    //     return Util::issetAndNotEmpty($this->getFooterLogoLogo());
    // }
}
