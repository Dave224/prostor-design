<?php

namespace Components\Block\Type\Contact;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\Contact\ContactConfig;
use Utils\uString;

/**
 * Class ContactModel
 * @package Components\Block\Type\Contact
 */
class ContactModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getImageSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsImageId(), $width, $height);
    }

    public function renderImage()
    {
        $Image = new ImageCreator($this->getParamsImageId());

        $Image->setSrc($this->getImageSize(941, 522));
        $Image->addToSrcset($this->getImageSize(941, 522), "1x");
        $Image->addToSrcset($this->getImageSize(1882, 1044), "2x");
        $Image->setDraggable(false);

        $ImageAlt = get_post_meta($this->getParamsImageId(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getParamsImageId());

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
        return $this->getMetaValue(ContactConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(ContactConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(ContactConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(ContactConfig::PARAMS_TITLE);
    }

    public function getParamsSettings(): ?string
    {
        return $this->getMetaValue(ContactConfig::PARAMS_SETTINGS);
    }

    public function getSettingsPath(): ?string
    {
        $VariantsPath = COMPONENTS_PATH . "Block/Type/Contact/variants/";
        if ($this->isParamsSettings()) {
            $VariantName = "ContactTheme";
            $VariantPath = $VariantsPath . $VariantName;
            return $VariantPath;
        } else {
            $VariantName = "ContactBlock";
            $VariantPath = $VariantsPath . $VariantName;
            return $VariantPath;
        }
    }


    public function getParamsImageId(): ?string
    {
        return $this->getMetaValue(ContactConfig::PARAMS_IMAGE_ID);
    }

    //* --- Kontakt
    //* --- Prefix: Contact

    public function getContactPhone(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_PHONE);
    }

    public function getContactPhoneFancy(): ?string
    {
        return uString::phoneNumberFormat($this->getMetaValue(ContactConfig::CONTACT_PHONE));
    }

    public function getContactPhoneClean(): ?string
    {
        return uString::clearPhoneNumber($this->getMetaValue(ContactConfig::CONTACT_PHONE));
    }

    public function getContactEmail(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_EMAIL);
    }

    public function getContactStreet(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_STREET);
    }

    public function getContactPsc(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_PSC);
    }

    public function getContactCity(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_CITY);
    }

    public function getContactIco(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_ICO);
    }

    public function getContactDic(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_DIC);
    }

    public function getContactSign(): ?string
    {
        return $this->getMetaValue(ContactConfig::CONTACT_SIGN);
    }


    //? --- Settery -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsSettings(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsSettings());
    }

    public function isParamsImageId(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsImageId());
    }

    //* --- Kontakt
    //* --- Prefix: Contact

    public function isContactPhone(): bool
    {
        return Util::issetAndNotEmpty($this->getContactPhone());
    }

    public function isContactEmail(): bool
    {
        return Util::issetAndNotEmpty($this->getContactEmail());
    }

    public function isContactStreet(): bool
    {
        return Util::issetAndNotEmpty($this->getContactStreet());
    }

    public function isContactPsc(): bool
    {
        return Util::issetAndNotEmpty($this->getContactPsc());
    }

    public function isContactCity(): bool
    {
        return Util::issetAndNotEmpty($this->getContactCity());
    }

    public function isContactIco(): bool
    {
        return Util::issetAndNotEmpty($this->getContactIco());
    }

    public function isContactDic(): bool
    {
        return Util::issetAndNotEmpty($this->getContactDic());
    }

    public function isContactSign(): bool
    {
        return Util::issetAndNotEmpty($this->getContactSign());
    }
}
