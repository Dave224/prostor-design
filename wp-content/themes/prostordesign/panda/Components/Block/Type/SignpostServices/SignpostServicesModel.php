<?php

namespace Components\Block\Type\SignpostServices;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\SignpostServices\SignpostServicesConfig;
use KT;

/**
 * Class SignpostServicesModel
 * @package Components\Block\Type\SignpostServices
 */
class SignpostServicesModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getPersonImageIdSize($width, $height)
    {
        return Image::getCloudImage($this->getPersonImageId(), $width, $height);
    }

    public function renderPersonImageId()
    {
        $PersonImageId = new ImageCreator($this->getPersonImageId());

        $PersonImageId->setSrc($this->getPersonImageIdSize(112, 112));
        $PersonImageId->addToSrcset($this->getPersonImageIdSize(112, 112), "1x");
        $PersonImageId->addToSrcset($this->getPersonImageIdSize(224, 224), "2x");
        $PersonImageId->setDraggable(false);

        $ImageAlt = get_post_meta($this->getPersonImageId(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getPersonImageId());

        if ($ImageAlt) {
            $PersonImageId->setAlt($ImageAlt);
        } else {
            $PersonImageId->setAlt($ImageTitle);
        }

        return $PersonImageId->render();
    }

    public function getParamsImageIdSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsImageId(), $width, $height);
    }

    public function renderParamsImageId()
    {
        $ImageId = new ImageCreator($this->getParamsImageId());

        $ImageId->setSrc($this->getParamsImageIdSize(736, 500));
        $ImageId->addToSrcset($this->getParamsImageIdSize(736, 500), "1x");
        $ImageId->addToSrcset($this->getParamsImageIdSize(1472, 1000), "2x");
        $ImageId->setDraggable(false);

        $ImageAlt = get_post_meta($this->getParamsImageId(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getParamsImageId());

        if ($ImageAlt) {
            $ImageId->setAlt($ImageAlt);
        } else {
            $ImageId->setAlt($ImageTitle);
        }

        return $ImageId->render();
    }

    //? --- Gettery -------------------------------------------------------------

    //* --- Nastavení bloku
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(SignpostServicesConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(SignpostServicesConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(SignpostServicesConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(SignpostServicesConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(SignpostServicesConfig::PARAMS_CONTENT);
    }

    public function getParamsVariant(): ?string
    {
        return $this->getMetaValue(SignpostServicesConfig::PARAMS_VARIANT);
    }

    //* --- Položky rozcestníku
    //* --- Prefix: SignpostItems

    public function getSingpostItemsField(): ?array
    {
        return $this->getMetaValue(SignpostServicesConfig::DYNAMIC_SIGNPOST_ITEMS_FIELD);
    }

    public function getSingpostItemsFour(): ?array
    {
        $SingpostItems = [];
        $Iterator = 0;

        foreach ($this->getSingpostItemsField() as $Key => $Field) {
            $Title = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_TITLE];
            $Description = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_DESCRIPTION];
            $ImageId = KT::tryGetInt($Field[SignpostServicesConfig::SIGNPOST_ITEMS_IMAGE_ID]);
            $ButtonText = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_BUTTON_TEXT];
            $ButtonUrl = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_BUTTON_URL];

            $renderedImage = "";
            $Image = new ImageCreator($ImageId);

            if ($Key === 0) {

                $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 688, 480));
                $Image->addToSrcset(Image::getCloudImage($ImageId, 688, 480), "1x");
                $Image->addToSrcset(Image::getCloudImage($ImageId, 1376, 960), "2x");
                $Image->setDraggable(false);
                $Image->setClass("post-item__img");

                $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
                $ImageTitle = get_the_title($ImageId);

                if ($ImageAlt) {
                    $Image->setAlt($ImageAlt);
                } else {
                    $Image->setAlt($ImageTitle);
                }

                $renderedImage = $Image->render();

                $SingpostItems["n-" . $Iterator] = [
                    $Title,
                    $Description,
                    $renderedImage,
                    $ButtonText,
                    $ButtonUrl,
                ];
            } else {

                $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 252, 235));
                $Image->addToSrcset(Image::getCloudImage($ImageId, 252, 235), "1x");
                $Image->addToSrcset(Image::getCloudImage($ImageId, 504, 470), "2x");
                $Image->setDraggable(false);
                $Image->setClass("post-item__img");

                $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
                $ImageTitle = get_the_title($ImageId);

                if ($ImageAlt) {
                    $Image->setAlt($ImageAlt);
                } else {
                    $Image->setAlt($ImageTitle);
                }

                $renderedImage = $Image->render();

                $SingpostItems["n-" . $Iterator] = [
                    $Title,
                    $Description,
                    $renderedImage,
                    $ButtonText,
                    $ButtonUrl,
                ];
            }

            $Iterator++;
        }


        return $SingpostItems;
    }

    public function getSingpostItemsThree(): ?array
    {
        $SingpostItems = [];
        $Iterator = 0;

        foreach ($this->getSingpostItemsField() as $Field) {
            $Title = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_TITLE];
            $Description = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_DESCRIPTION];
            $ImageId = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_IMAGE_ID];
            $ButtonText = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_BUTTON_TEXT];
            $ButtonUrl = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_BUTTON_URL];

            $renderedImage = "";
            $Image = new ImageCreator($ImageId);

            $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 453, 316));
            $Image->addToSrcset(Image::getCloudImage($ImageId, 453, 316), "1x");
            $Image->addToSrcset(Image::getCloudImage($ImageId, 906, 632), "2x");
            $Image->setDraggable(false);
            $Image->setClass("post-item__img");

            $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
            $ImageTitle = get_the_title($ImageId);

            if ($ImageAlt) {
                $Image->setAlt($ImageAlt);
            } else {
                $Image->setAlt($ImageTitle);
            }

            $renderedImage = $Image->render();

            $SingpostItems["n-" . $Iterator] = [
                $Title,
                $Description,
                $renderedImage,
                $ButtonText,
                $ButtonUrl,
            ];

            $Iterator++;
        }


        return $SingpostItems;
    }

    public function getSingpostItemsTwo(): ?array
    {
        $SingpostItems = [];
        $Iterator = 0;

        foreach ($this->getSingpostItemsField() as $Field) {
            $Title = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_TITLE];
            $Description = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_DESCRIPTION];
            $ImageId = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_IMAGE_ID];
            $ButtonText = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_BUTTON_TEXT];
            $ButtonUrl = $Field[SignpostServicesConfig::SIGNPOST_ITEMS_BUTTON_URL];

            $renderedImage = "";
            $Image = new ImageCreator($ImageId);

            $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 688, 480));
            $Image->addToSrcset(Image::getCloudImage($ImageId, 688, 480), "1x");
            $Image->addToSrcset(Image::getCloudImage($ImageId, 1376, 960), "2x");
            $Image->setDraggable(false);
            $Image->setClass("post-item__img");

            $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
            $ImageTitle = get_the_title($ImageId);

            if ($ImageAlt) {
                $Image->setAlt($ImageAlt);
            } else {
                $Image->setAlt($ImageTitle);
            }

            $renderedImage = $Image->render();

            $SingpostItems["n-" . $Iterator] = [
                $Title,
                $Description,
                $renderedImage,
                $ButtonText,
                $ButtonUrl,
            ];

            $Iterator++;
        }


        return $SingpostItems;
    }

    //? --- Settery -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsVariant(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsVariant());
    }

    public function isParamsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsContent());
    }

    //* --- Položky rozcestníku
    //* --- Prefix: SignpostItems

    public function isSingpostItemsField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getSingpostItemsField());
    }
}
