<?php

namespace Components\ThemeSettings;

use Components\Person\Person;
use Components\Product\Product;
use Interfaces\Configable;
use Components\Block\Block;
use KT_Text_Field;

/**
 * Class ThemeSettingsConfig
 * @package Components\ThemeSettings
 */
class ThemeSettingsConfig implements Configable
{
    const FORM_PREFIX = "theme-settings";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::ESHOP_FAST_CONTACT_FIELDSET           => self::getEshopFastContactFieldset(),
            self::SERVICES_FAST_CONTACT_FIELDSET        => self::getServicesFastContactFieldset(),
            self::TECHNOLOGIES_FAST_CONTACT_FIELDSET    => self::getTechnologiesFastContactFieldset(),
            self::CONTACT_FIELDSET                      => self::getContactFieldset(),
            self::SOCIAL_FIELDSET                       => self::getSocialFieldset(),
            self::ANALYTICS_FIELDSET                    => self::getAnalyticsFieldset(),
            self::RECAPTCHA_FIELDSET                    => self::getRecaptchaFieldset(),
            self::LINK_FIELDSET                         => self::getLinkFieldset(),
            self::FORM_SETTINGS_FIELDSET                => self::getFormSettingsFieldset(),
            self::FILTRATION_FIELDSET                   => self::getFiltrationFieldset(),
            self::PRODUCT_CANONICAL_SETTING_FIELDSET    => self::getProductCanonicalSettingsFieldset(),
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::CANONICAL_FIELDSET    => self::getCanonicalFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [
            self::FORM_FIELDSET => self::getFormFieldset(),
        ];
    }

    public static function registerMetaboxes()
    {
        \KT_MetaBox::createMultiple(self::getAllNormalFieldsets(), \KT_WP_Configurator::getThemeSettingSlug(), \KT_MetaBox_Data_Type_Enum::OPTIONS);

        $themeSideMetaboxes = \KT_MetaBox::createMultiple(self::getAllSideFieldsets(), \KT_WP_Configurator::getThemeSettingSlug(), \KT_MetaBox_Data_Type_Enum::OPTIONS, false);
        foreach ($themeSideMetaboxes as $themeSideMetabox) {
            $themeSideMetabox->setContext(\KT_MetaBox::CONTEXT_SIDE);
            $themeSideMetabox->register();
        }
    }

    // --- NASTAVENÍ FORMULÁŘE ------------------------

    const FORM_FIELDSET = self::FORM_PREFIX . "-form";
    const FORM_CONTACT_EMAIL = self::FORM_FIELDSET . "-contact-email";

    public static function getFormFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FORM_FIELDSET, __("Email formuláře", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FORM_FIELDSET);

        $fieldset->addText(self::FORM_CONTACT_EMAIL, __("Email:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const FORM_SETTINGS_FIELDSET = self::FORM_PREFIX . "-form-settings";
    const FORM_SETTINGS_SERVICE_TITLE = self::FORM_SETTINGS_FIELDSET . "-service-title";
    const FORM_SETTINGS_SERVICE_DESC = self::FORM_SETTINGS_FIELDSET . "-service-desc";
    const FORM_SETTINGS_TECHNOLOGY_TITLE = self::FORM_SETTINGS_FIELDSET . "-technology-title";
    const FORM_SETTINGS_TECHNOLOGY_DESC = self::FORM_SETTINGS_FIELDSET . "-technology-desc";

    public static function getFormSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FORM_SETTINGS_FIELDSET, __("Nastavení formuláře", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FORM_SETTINGS_FIELDSET);

        $fieldset->addText(self::FORM_SETTINGS_SERVICE_TITLE, __("Formulář služby - titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::FORM_SETTINGS_SERVICE_DESC, __("Formulář služby - popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::FORM_SETTINGS_TECHNOLOGY_TITLE, __("Formulář technologie - titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::FORM_SETTINGS_TECHNOLOGY_DESC, __("Formulář technologie - popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- SOCIÁLNÍ SÍTĚ ------------------------

    const SOCIAL_FIELDSET = self::FORM_PREFIX . "-social";
    const SOCIAL_FACEBOOK = self::SOCIAL_FIELDSET . "-facebook";
    const SOCIAL_INSTAGRAM = self::SOCIAL_FIELDSET . "-instagram";
    const SOCIAL_LINKEDIN = self::SOCIAL_FIELDSET . "-linkedin";
    const SOCIAL_WHATSAPP = self::SOCIAL_FIELDSET . "-whatsapp";

    public static function getSocialFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SOCIAL_FIELDSET, __("Sociální sítě", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SOCIAL_FIELDSET);

        $fieldset->addText(self::SOCIAL_FACEBOOK, __("Facebook:", "PD_ADMIN_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_URL);
        $fieldset->addText(self::SOCIAL_INSTAGRAM, __("Instagram:", "PD_ADMIN_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_URL);
        $fieldset->addText(self::SOCIAL_LINKEDIN, __("LinkedIn:", "PD_ADMIN_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_URL);
        $fieldset->addText(self::SOCIAL_WHATSAPP, __("WhatsApp:", "PD_ADMIN_DOMAIN"))
            ->setInputType(\KT_Text_Field::INPUT_URL);

        return $fieldset;
    }

    // --- RYCHLÝ KONTAKT - SLUŽBY ------------------------

    const SERVICES_FAST_CONTACT_FIELDSET = self::FORM_PREFIX . "-serivces-fast-contact";
    const SERVICES_FAST_CONTACT_TITLE = self::SERVICES_FAST_CONTACT_FIELDSET . "-title";
    const SERVICES_FAST_CONTACT_DESC = self::SERVICES_FAST_CONTACT_FIELDSET . "-desc";
    const SERVICES_FAST_CONTACT_CALL_TITLE = self::SERVICES_FAST_CONTACT_FIELDSET . "-call-title";
    const SERVICES_FAST_CONTACT_CALL_DESC = self::SERVICES_FAST_CONTACT_FIELDSET . "-call-desc";

    public static function getServicesFastContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SERVICES_FAST_CONTACT_FIELDSET, __("Rychlý kontakt - služby", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SERVICES_FAST_CONTACT_FIELDSET);

        $fieldset->addText(self::SERVICES_FAST_CONTACT_TITLE, __("Titulek u osoby", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(SELF::SERVICES_FAST_CONTACT_DESC, __("Popisek u osoby", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::SERVICES_FAST_CONTACT_CALL_TITLE, __("Titulek pro zavolání", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(SELF::SERVICES_FAST_CONTACT_CALL_DESC, __("Popisek pro zavolání", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- RYCHLÝ KONTAKT - Technologie ------------------------

    const TECHNOLOGIES_FAST_CONTACT_FIELDSET = self::FORM_PREFIX . "-technologies-fast-contact";
    const TECHNOLOGIES_FAST_CONTACT_TITLE = self::TECHNOLOGIES_FAST_CONTACT_FIELDSET . "-title";
    const TECHNOLOGIES_FAST_CONTACT_DESC = self::TECHNOLOGIES_FAST_CONTACT_FIELDSET . "-desc";
    const TECHNOLOGIES_FAST_CONTACT_CALL_TITLE = self::TECHNOLOGIES_FAST_CONTACT_FIELDSET . "-call-title";
    const TECHNOLOGIES_FAST_CONTACT_CALL_DESC = self::TECHNOLOGIES_FAST_CONTACT_FIELDSET . "-call-desc";

    public static function getTechnologiesFastContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::TECHNOLOGIES_FAST_CONTACT_FIELDSET, __("Rychlý kontakt - technologie", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::TECHNOLOGIES_FAST_CONTACT_FIELDSET);

        $fieldset->addText(self::TECHNOLOGIES_FAST_CONTACT_TITLE, __("Titulek u osoby", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(SELF::TECHNOLOGIES_FAST_CONTACT_DESC, __("Popisek u osoby", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::TECHNOLOGIES_FAST_CONTACT_CALL_TITLE, __("Titulek pro zavolání", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(SELF::TECHNOLOGIES_FAST_CONTACT_CALL_DESC, __("Popisek pro zavolání", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- RYCHLÝ KONTAKT - E-shop ------------------------

    const ESHOP_FAST_CONTACT_FIELDSET = self::FORM_PREFIX . "-eshop-fast-contact";
    const ESHOP_FAST_CONTACT_TITLE = self::ESHOP_FAST_CONTACT_FIELDSET . "-title";
    const ESHOP_FAST_CONTACT_DESC = self::ESHOP_FAST_CONTACT_FIELDSET . "-desc";
    const ESHOP_FAST_CONTACT_CALL_TITLE = self::ESHOP_FAST_CONTACT_FIELDSET . "-call-title";
    const ESHOP_FAST_CONTACT_CALL_DESC = self::ESHOP_FAST_CONTACT_FIELDSET . "-call-desc";
    const ESHOP_FAST_CONTACT_PERSON = self::ESHOP_FAST_CONTACT_FIELDSET . "-person";

    public static function getEshopFastContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::ESHOP_FAST_CONTACT_FIELDSET, __("Rychlý kontakt - e-shop", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::ESHOP_FAST_CONTACT_FIELDSET);

        $fieldset->addText(self::ESHOP_FAST_CONTACT_TITLE, __("Titulek u osoby", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::ESHOP_FAST_CONTACT_DESC, __("Popisek u osoby", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::ESHOP_FAST_CONTACT_CALL_TITLE, __("Titulek pro zavolání", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::ESHOP_FAST_CONTACT_CALL_DESC, __("Popisek pro zavolání", "PD_ADMIN_DOMAIN"));
        $fieldset->addSelect(self::ESHOP_FAST_CONTACT_PERSON, __("Osoba", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Person::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));

        return $fieldset;
    }

    // --- KONTAKTY ------------------------

    const CONTACT_FIELDSET = self::FORM_PREFIX . "-contact";
    const CONTACT_COMPANY_NAME = self::CONTACT_FIELDSET . "-name";
    const CONTACT_STREET = self::CONTACT_FIELDSET . "-street";
    const CONTACT_CITY = self::CONTACT_FIELDSET . "-city";
    const CONTACT_ZIP = self::CONTACT_FIELDSET . "-zip";
    const CONTACT_PHONE = self::CONTACT_FIELDSET . "-contact-phone";
    const CONTACT_EMAIL = self::CONTACT_FIELDSET . "-contact-email";
    const CONTACT_DESCRIPTION = self::CONTACT_FIELDSET . "-description";
    const CONTACT_DIC = self::CONTACT_FIELDSET . "-dic";
    const CONTACT_ICO = self::CONTACT_FIELDSET . "-ico";
    const CONTACT_ESTABLISHMENT = self::CONTACT_FIELDSET . "-establishment";
    const CONTACT_LOGO_ID = self::CONTACT_FIELDSET . "-logo-id";

    public static function getContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::CONTACT_FIELDSET, __("Kontaktní údaje pro vyhledávače", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::CONTACT_FIELDSET);

        $fieldset->addText(self::CONTACT_COMPANY_NAME, __("Název Firmy:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_STREET, __("Ulice a ČP:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_CITY, __("Město:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_ZIP, __("PSČ:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_PHONE, __("Telefon:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_EMAIL, __("E-mail:", "PD_ADMIN_DOMAIN"));
        $fieldset->addDate(self::CONTACT_ESTABLISHMENT, __("Datum založení:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_DIC, __("DIČ:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_ICO, __("IČO:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::CONTACT_LOGO_ID, __("Logo:", "PD_ADMIN_DOMAIN"));


        return $fieldset;
    }
    // --- ANALYTIKA ------------------------

    const ANALYTICS_FIELDSET = self::FORM_PREFIX . "-analytics";
    const ANALYTICS_HEADER_CODE = self::ANALYTICS_FIELDSET . "-header-code";
    const ANALYTICS_BODY_CODE = self::ANALYTICS_FIELDSET . "-body-code";

    public static function getAnalyticsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::ANALYTICS_FIELDSET, __("Analytika", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::ANALYTICS_FIELDSET);

        $fieldset->addTextarea(self::ANALYTICS_HEADER_CODE, __("Kód v header:", "PD_ADMIN_DOMAIN"))
            ->setFilterSanitize(FILTER_DEFAULT);

        $fieldset->addTextarea(self::ANALYTICS_BODY_CODE, __("Kód v body:", "PD_ADMIN_DOMAIN"))
            ->setFilterSanitize(FILTER_DEFAULT);

        return $fieldset;
    }

    // --- RECAPTCHA ------------------------

    const RECAPTCHA_FIELDSET = self::FORM_PREFIX . "-recaptcha";
    const RECAPTCHA_ON = self::RECAPTCHA_FIELDSET . "-on";
    const RECAPTCHA_SECRET_KEY = self::RECAPTCHA_FIELDSET . "-secret-key";
    const RECAPTCHA_SITE_KEY = self::RECAPTCHA_FIELDSET . "-site-key";

    public static function getRecaptchaFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::RECAPTCHA_FIELDSET, __("Google ReCaptcha", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::RECAPTCHA_FIELDSET);

        $fieldset->addSwitch(self::RECAPTCHA_ON, __("Zapnout ReCaptchu:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::RECAPTCHA_SECRET_KEY, __("Secret key:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::RECAPTCHA_SITE_KEY, __("Site key:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- LINK ------------------------

    const LINK_FIELDSET = self::FORM_PREFIX . "-link";
    const LINK_TYPE = self::LINK_FIELDSET . "-type";

    public static function getLinkFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::LINK_FIELDSET, __("Nastavení odkazu", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::LINK_FIELDSET);

        $fieldset->addSwitch(self::LINK_TYPE, __("Styl odkazu (Technologie - slider):", "PD_ADMIN_DOMAIN"), "Tlačítko", "Odkaz");

        return $fieldset;
    }

    // --- CANONICAL ------------------------

    const PRODUCT_CANONICAL_SETTING_FIELDSET = self::FORM_PREFIX . "-canonical";
    const PRODUCT_CANONICAL_SETTING_FIELD     = self::PRODUCT_CANONICAL_SETTING_FIELDSET . "-field";

    public static function getProductCanonicalSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PRODUCT_CANONICAL_SETTING_FIELDSET, __("Nastavení kanonických URL", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PRODUCT_CANONICAL_SETTING_FIELDSET);

        $fieldset->addFieldset(self::PRODUCT_CANONICAL_SETTING_FIELD, __("Nastavení kanonických URL", "PD_ADMIN_DOMAIN"), [self::class, self::CANONICAL_FIELDSET]);

        return $fieldset;
    }

    const CANONICAL_FIELDSET    = self::FORM_PREFIX . "-specification";
    const CANONICAL_PRODUCT     = self::CANONICAL_FIELDSET . "-product";
    const CANONICAL_CATEGORY    = self::CANONICAL_FIELDSET . "-category";

    public static function getCanonicalFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::CANONICAL_FIELDSET, __("Nastavení kanonických URL", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::CANONICAL_FIELDSET);

        $fieldset->addSelect(self::CANONICAL_CATEGORY, __("Kategorie, pro kterou chcete nastavit kanonickou URL:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Taxonomy_Data_Manager('product_cat'));

        $fieldset->addSelect(self::CANONICAL_PRODUCT, __("Produkt, který bude použit pro výše vybranou kategorii jako kanonická URL:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Product::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));

        return $fieldset;
    }

    // --- FILTRATION ------------------------

    const FILTRATION_FIELDSET       = self::FORM_PREFIX . "-filtration";
    const FILTRATION_TITLE          = self::FILTRATION_FIELDSET . "-title";
    const FILTRATION_DESCRIPTION    = self::FILTRATION_FIELDSET . "-description";

    public static function getFiltrationFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FILTRATION_FIELDSET, __("Nastavení filtrace", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FILTRATION_FIELDSET);

        $fieldset->addText(self::FILTRATION_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::FILTRATION_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
