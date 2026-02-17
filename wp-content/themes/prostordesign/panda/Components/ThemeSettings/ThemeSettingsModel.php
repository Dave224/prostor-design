<?php

namespace Components\ThemeSettings;

use Components\Person\PersonFactory;
use Utils\Image;
use Utils\uString;
use Utils\Util;

/**
 * Class ThemeSettingsModel
 * @package Components\ThemeSettings
 */
class ThemeSettingsModel extends \KT_WP_Options_Base_Model
{

    private $SocialsSameAsData;
    private $ContactLogoSrc;


    public function __construct()
    {
        parent::__construct(ThemeSettingsConfig::FORM_PREFIX);
    }

    //? --- getry & setry ------------------------

    //* --- Nastavení formuláře
    //* --- Prefix: Form

    public function getFormEmail(): ?string
    {
        return $this->getOption(ThemeSettingsConfig::FORM_CONTACT_EMAIL);
    }

    //* --- Kontakt
    //* --- Prefix: Contact

    public function getContactCompanyName()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_COMPANY_NAME);
    }

    public function getContactStreet()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_STREET);
    }

    public function getContactCity()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_CITY);
    }

    public function getContactZip()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_ZIP);
    }

    public function getContactPhone()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_PHONE);
    }

    public function getContactPhoneClean()
    {
        return uString::clearPhoneNumber($this->getContactPhone());
    }

    public function getContactPhoneFancy()
    {
        return uString::phoneNumberFormat($this->getContactPhone());
    }

    public function getContactEmail()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_EMAIL);
    }

    public function getContactEmailFancy()
    {
        $email = $this->getContactEmail();
        $wordToFind  = '@';
        $wrap_before = '<span>';
        $wrap_after  = '</span>';

        $fancyEmail = preg_replace("/($wordToFind)/i", "$wrap_before$1$wrap_after", $email);
        return $fancyEmail;
    }

    public function getContactDescription()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_DESCRIPTION);
    }

    public function getContactEstablishment()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_ESTABLISHMENT);
    }

    public function getContactDic()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_DIC);
    }

    public function getContactIco()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_ICO);
    }

    public function getContactLogoId()
    {
        return $this->getOption(ThemeSettingsConfig::CONTACT_LOGO_ID);
    }

    /** @return string */
    public function getContactLogoSrc()
    {
        if (isset($this->ContactLogoSrc)) {
            return $this->ContactLogoSrc;
        }

        if ($this->isContactLogoId()) {
            return $this->ContactLogoSrc = Image::getImageSrc($this->getContactLogoId(), KT_WP_IMAGE_SIZE_ORIGINAL);
        }

        return $this->ContactLogoSrc = "";
    }

    public function getContactAdressFull()
    {
        return $adress = $this->getContactStreet() . ", " . $this->getContactZip() . " " . $this->getContactCity();
    }


    //* --- Sociání sítě
    //* --- Prefix: Social

    public function getSocialFacebook()
    {
        return $this->getOption(ThemeSettingsConfig::SOCIAL_FACEBOOK);
    }

    public function getSocialInstagram()
    {
        return $this->getOption(ThemeSettingsConfig::SOCIAL_INSTAGRAM);
    }

    public function getSocialLinkedin()
    {
        return $this->getOption(ThemeSettingsConfig::SOCIAL_LINKEDIN);
    }

    public function getSocialWhatsapp()
    {
        return $this->getOption(ThemeSettingsConfig::SOCIAL_WHATSAPP);
    }

    /** @return array */
    public function getSocialsSameAsData()
    {
        if (isset($this->SocialsSameAsData)) {
            return $this->SocialsSameAsData;
        }
        $data = [];
        if ($this->isSocialFacebook()) {
            $data[] = sprintf("%s - social network profile (Facebook)", $this->getSocialFacebook());
        }
        if ($this->isSocialInstagram()) {
            $data[] = sprintf("%s - social network profile (Instagram)", $this->getSocialInstagram());
        }
        if ($this->isSocialLinkedin()) {
            $data[] = sprintf("%s - social network profile (Linkedin)", $this->getSocialLinkedin());
        }
        if ($this->isSocialWhatsapp()) {
            $data[] = sprintf("%s - social network profile (Whatsapp)", $this->getSocialWhatsapp());
        }
        return $this->SocialsSameAsData = $data;
    }

    //* --- Analytika
    //* --- Prefix: Analytics

    public function getAnalyticsHeaderCode()
    {
        return $this->getOption(ThemeSettingsConfig::ANALYTICS_HEADER_CODE);
    }

    public function getAnalyticsBodyCode()
    {
        return $this->getOption(ThemeSettingsConfig::ANALYTICS_BODY_CODE);
    }

    //* --- Recaptcha
    //* --- Prefix: Recaptcha

    public function getRecaptchaOn()
    {
        return $this->getOption(ThemeSettingsConfig::RECAPTCHA_ON);
    }

    public function getRecaptchaSecretKey()
    {
        return $this->getOption(ThemeSettingsConfig::RECAPTCHA_SECRET_KEY);
    }

    public function getRecaptchaSiteKey()
    {
        return $this->getOption(ThemeSettingsConfig::RECAPTCHA_SITE_KEY);
    }

    //* --- Ryhchlý kontakt - služby
    //* --- Prefix: ServicesContact

    public function getServicesContactTitle()
    {
        return $this->getOption(ThemeSettingsConfig::SERVICES_FAST_CONTACT_TITLE);
    }

    public function getServicesContactDesc()
    {
        return $this->getOption(ThemeSettingsConfig::SERVICES_FAST_CONTACT_DESC);
    }

    public function getServicesContactCallTitle()
    {
        return $this->getOption(ThemeSettingsConfig::SERVICES_FAST_CONTACT_CALL_TITLE);
    }

    public function getServicesContactCallDesc()
    {
        return $this->getOption(ThemeSettingsConfig::SERVICES_FAST_CONTACT_CALL_DESC);
    }

    //* --- Ryhchlý kontakt - technologie
    //* --- Prefix: TechnologyContact

    public function getTechnologyContactTitle()
    {
        return $this->getOption(ThemeSettingsConfig::TECHNOLOGIES_FAST_CONTACT_TITLE);
    }

    public function getTechnologyContactDesc()
    {
        return $this->getOption(ThemeSettingsConfig::TECHNOLOGIES_FAST_CONTACT_DESC);
    }

    public function getTechnologyContactCallTitle()
    {
        return $this->getOption(ThemeSettingsConfig::TECHNOLOGIES_FAST_CONTACT_CALL_TITLE);
    }

    public function getTechnologyContactCallDesc()
    {
        return $this->getOption(ThemeSettingsConfig::TECHNOLOGIES_FAST_CONTACT_CALL_DESC);
    }

    //* --- Ryhchlý kontakt - eshop
    //* --- Prefix: EshopContact

    public function getEshopContactTitle()
    {
        return $this->getOption(ThemeSettingsConfig::ESHOP_FAST_CONTACT_TITLE);
    }

    public function getEshopContactDescription()
    {
        return $this->getOption(ThemeSettingsConfig::ESHOP_FAST_CONTACT_DESC);
    }

    public function getEshopContactCallTitle()
    {
        return $this->getOption(ThemeSettingsConfig::ESHOP_FAST_CONTACT_CALL_TITLE);
    }

    public function getEshopContactCallDescription()
    {
        return $this->getOption(ThemeSettingsConfig::ESHOP_FAST_CONTACT_CALL_DESC);
    }

    public function getEshopContactPerson()
    {
        return $this->getOption(ThemeSettingsConfig::ESHOP_FAST_CONTACT_PERSON);
    }

    public function getEshopContactPersonFactory()
    {
        return PersonFactory::createById($this->getEshopContactPerson());
    }

    //* --- Nastavení odkazu
    //* --- Prefix: Link

    public function getLinkType(): ?string
    {
        return $this->getOption(ThemeSettingsConfig::LINK_TYPE);
    }

    //* --- Nastavení formulářů
    //* --- Prefix: FormSettings

    public function getFormSettingsServiceTitle(): ?string
    {
        return $this->getOption(ThemeSettingsConfig::FORM_SETTINGS_SERVICE_TITLE);
    }

    public function getFormSettingsServiceDesc(): ?string
    {
        return $this->getOption(ThemeSettingsConfig::FORM_SETTINGS_SERVICE_DESC);
    }

    public function getFormSettingsTechnologyTitle(): ?string
    {
        return $this->getOption(ThemeSettingsConfig::FORM_SETTINGS_TECHNOLOGY_TITLE);
    }

    public function getFormSettingsTechnologyDesc(): ?string
    {
        return $this->getOption(ThemeSettingsConfig::FORM_SETTINGS_TECHNOLOGY_DESC);
    }

    //? --- veřejné metody ------------------------------------------------------

    //* --- Nastavení formuláře
    //* --- Prefix: Form

    public function isFormEmail(): bool
    {
        return Util::issetAndNotEmpty($this->getFormEmail());
    }

    //* --- Kontakt
    //* --- Prefix: Contact

    public function isContactCompanyName()
    {
        return Util::issetAndNotEmpty($this->getContactCompanyName());
    }

    public function isContactStreet()
    {
        return Util::issetAndNotEmpty($this->getContactStreet());
    }

    public function isContactCity()
    {
        return Util::issetAndNotEmpty($this->getContactCity());
    }

    public function isContactZip()
    {
        return Util::issetAndNotEmpty($this->getContactZip());
    }

    public function isContactPhone()
    {
        return Util::issetAndNotEmpty($this->getContactPhone());
    }

    public function isContactEmail()
    {
        return Util::issetAndNotEmpty($this->getContactEmail());
    }

    public function isContactDescription()
    {
        return Util::issetAndNotEmpty($this->getContactDescription());
    }

    public function isContactEstablishment()
    {
        return Util::issetAndNotEmpty($this->getContactEstablishment());
    }

    public function isContactDic()
    {
        return Util::issetAndNotEmpty($this->getContactDic());
    }

    public function isContactIco()
    {
        return Util::issetAndNotEmpty($this->getContactIco());
    }

    public function isContactLogoId()
    {
        return Util::issetAndNotEmpty($this->getContactLogoId());
    }

    public function isContactAdress()
    {
        return $this->isContactStreet() && $this->isContactCity() && $this->isContactZip();
    }

    //* --- Analytika
    //* --- Prefix: Analytics

    public function isAnalyticsHeaderCode()
    {
        return Util::issetAndNotEmpty($this->getAnalyticsHeaderCode());
    }

    public function isAnalyticsBodyCode()
    {
        return Util::issetAndNotEmpty($this->getAnalyticsBodyCode());
    }

    //* --- Sociání sítě
    //* --- Prefix: Social

    public function isSocialFacebook()
    {
        return Util::issetAndNotEmpty($this->getSocialFacebook());
    }

    public function isSocialInstagram()
    {
        return Util::issetAndNotEmpty($this->getSocialInstagram());
    }

    public function isSocialLinkedin()
    {
        return Util::issetAndNotEmpty($this->getSocialLinkedin());
    }

    public function isSocialWhatsapp()
    {
        return Util::issetAndNotEmpty($this->getSocialWhatsapp());
    }

    public function isSocials()
    {
        if ($this->isSocialFacebook() || $this->isSocialInstagram() || $this->isSocialLinkedin() || $this->isSocialWhatsapp()) {
            return true;
        } else {
            return false;
        }
    }

    public function isSocialsSameAsData()
    {
        return Util::arrayIssetAndNotEmpty($this->getSocialsSameAsData());
    }

    //* --- Recaptcha
    //* --- Prefix: Recaptcha

    public function isRecaptchaOn()
    {
        return Util::issetAndNotEmpty($this->getRecaptchaOn());
    }

    public function isRecaptchaSecretKey()
    {
        return Util::issetAndNotEmpty($this->getRecaptchaSecretKey());
    }

    public function isRecaptchaSiteKey()
    {
        return Util::issetAndNotEmpty($this->getRecaptchaSiteKey());
    }

    public function isRecaptchOnAndSet(): bool
    {
        return $this->isRecaptchaOn() && $this->isRecaptchaSecretKey() && $this->isRecaptchaSiteKey();
    }

    //* --- Nastavení odkazu
    //* --- Prefix: Link

    public function isLinkType(): bool
    {
        return Util::issetAndNotEmpty($this->getLinkType());
    }

    //* --- Ryhchlý kontakt - služby
    //* --- Prefix: ServicesContact

    public function isServicesContactTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getServicesContactTitle());
    }

    public function isServicesContactDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getServicesContactDesc());
    }

    public function isServicesContactCallTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getServicesContactCallTitle());
    }

    public function isServicesContactCallDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getServicesContactCallDesc());
    }

    //* --- Ryhchlý kontakt - technologie
    //* --- Prefix: TechnologyContact

    public function isTechnologyContactTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getTechnologyContactTitle());
    }

    public function isTechnologyContactDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getTechnologyContactDesc());
    }

    public function isTechnologyContactCallTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getTechnologyContactCallTitle());
    }

    public function isTechnologyContactCallDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getTechnologyContactCallDesc());
    }

    //* --- Ryhchlý kontakt - eshop
    //* --- Prefix: EshopContact

    public function isEshopContactTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getEshopContactTitle());
    }

    public function isEshopContactDescription(): bool
    {
        return Util::issetAndNotEmpty($this->getEshopContactDescription());
    }

    public function isEshopContactCallTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getEshopContactCallTitle());
    }

    public function isEshopContactCallDescription(): bool
    {
        return Util::issetAndNotEmpty($this->getEshopContactCallDescription());
    }

    public function isEshopContactPerson(): bool
    {
        return Util::issetAndNotEmpty($this->getEshopContactPerson());
    }

    //* --- Nastavení formulářů
    //* --- Prefix: FormSettings

    public function isFormSettingsServiceTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getFormSettingsServiceTitle());
    }

    public function isFormSettingsServiceDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getFormSettingsServiceDesc());
    }

    public function isFormSettingsTechnologyTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getFormSettingsTechnologyTitle());
    }

    public function isFormSettingsTechnologyDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getFormSettingsTechnologyDesc());
    }
}
