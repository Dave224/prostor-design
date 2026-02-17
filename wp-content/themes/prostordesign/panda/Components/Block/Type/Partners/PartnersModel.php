<?php

namespace Components\Block\Type\Partners;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\Partners\PartnersConfig;

/**
 * Class PartnersModel
 * @package Components\Block\Type\Partners
 */
class PartnersModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(PartnersConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(PartnersConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(PartnersConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(PartnersConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(PartnersConfig::PARAMS_CONTENT);
    }

    public function getParamsBackground(): ?string
    {
        return $this->getMetaValue(PartnersConfig::PARAMS_BACKGROUND);
    }

    public function getBackground(): ?string
    {
        if ($this->isParamsBackground()) {
            return "dark";
        } else {
            return "light";
        }
    }

    //* --- Partner
    //* --- Prefix: DynamicPartner

    public function getDynamicPartnerField(): ?array
    {
        return $this->getMetaValue(PartnersConfig::PARTNER_DYNAMIC_FIELD);
    }

    public function getPartnersCollection(): ?array
    {
        $Partners = [];
        $Iterator = 0;

        foreach ($this->getDynamicPartnerField() as $Field) {
            $Title = $Field[PartnersConfig::PARTNER_TITLE];
            $Link = $Field[PartnersConfig::PARTNER_LINK_URL];
            $ImageId = $Field[PartnersConfig::PARTNER_IMAGE_ID];

            $renderedImage = "";
            $Image = new ImageCreator($ImageId);

            $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 235, 88));
            $Image->addToSrcset(Image::getCloudImage($ImageId, 235, 88), "1x");
            $Image->addToSrcset(Image::getCloudImage($ImageId, 470, 166), "2x");
            $Image->setDraggable(false);

            $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
            $ImageTitle = get_the_title($ImageId);

            if ($ImageAlt) {
                $Image->setAlt($ImageAlt);
            } else {
                $Image->setAlt($ImageTitle);
            }

            $renderedImage = $Image->render();

            $Partners["n-" . $Iterator] = [
                $Title,
                $renderedImage,
                $Link,
            ];

            $Iterator++;
        }


        return $Partners;
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

    //* --- Partner
    //* --- Prefix: DynamicPartner

    public function isDynamicPartnerField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicPartnerField());
    }
}
