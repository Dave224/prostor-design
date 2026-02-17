<?php

namespace Components\Block\Type\Gallery;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;

/**
 * Class GalleryModel
 * @package Components\Block\Type\Gallery
 */
class GalleryModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(GalleryConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(GalleryConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(GalleryConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(GalleryConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(GalleryConfig::PARAMS_CONTENT);
    }

    public function getParamsBackground(): ?string
    {
        return $this->getMetaValue(GalleryConfig::PARAMS_BACKGROUND);
    }

    public function getBackground(): ?string
    {
        if ($this->isParamsBackground()) {
            return "dark";
        } else {
            return "light";
        }
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(GalleryConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(GalleryConfig::PARAMS_BUTTON_URL);
    }

    public function getParamsButtonTarget(): ?bool
    {
        return $this->getMetaValue(GalleryConfig::PARAMS_BUTTON_TARGET);
    }

    //* --- Obrázky
    //* --- Prefix: DynamicImages

    public function getDynamicImagesField(): ?array
    {
        return $this->getMetaValue(GalleryConfig::IMAGES_DYNAMIC_FIELD);
    }

    public function getImagesCollection(): ?array
    {
        $Benefits = [];
        $Iterator = 0;

        foreach ($this->getDynamicImagesField() as $Field) {
            $ImageId = $Field[GalleryConfig::IMAGES_IMAGE_ID];

            $renderedImage = "";
            $Image = new ImageCreator($ImageId);

            $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 590, null));
            $Image->setDraggable(false);

            $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
            $ImageTitle = get_the_title($ImageId);

            if ($ImageAlt) {
                $Image->setAlt($ImageAlt);
            } else {
                $Image->setAlt($ImageTitle);
            }

            $renderedImage = $Image->render();

            $Benefits["n-" . $Iterator] = [
                $renderedImage,
                Image::getCloudImage($ImageId, 1080),
            ];

            $Iterator++;
        }


        return $Benefits;
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

    //* --- Obráziky
    //* --- Prefix: DynamicImages

    public function isDynamicImagesField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicImagesField());
    }
}
