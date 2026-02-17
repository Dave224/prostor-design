<?php

namespace Components\Technology;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockFactory;
use Components\Technology\TechnologyConfig;

/**
 * Class TechnologyModel
 * @package Components\Technology
 */
class TechnologyModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, TechnologyConfig::FORM_PREFIX);
    }

    public function getThumbnailSize($width, $height)
    {
        return Image::getCloudImage($this->getThumbnailId(), $width, $height);
    }

    public function renderThumbnail()
    {
        $Thumbnail = new ImageCreator($this->getThumbnailId());

        $Thumbnail->setSrc($this->getThumbnailSize(688, 616));
        $Thumbnail->addToSrcset($this->getThumbnailSize(688, 616), "1x");
        $Thumbnail->addToSrcset($this->getThumbnailSize(1376, 1232), "2x");
        $Thumbnail->setDraggable(false);

        $ThumbnailAlt = get_post_meta($this->getThumbnailId(), '_wp_attachment_image_alt', true);
        $ThumbnailTitle = get_the_title($this->getThumbnailId());

        if ($ThumbnailAlt) {
            $Thumbnail->setAlt($ThumbnailAlt);
        } else {
            $Thumbnail->setAlt($ThumbnailTitle);
        }

        return $Thumbnail->render();
    }

    public function getPageImageSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsPageImage(), $width, $height);
    }

    public function renderParamsPageImage()
    {
        $Image = new ImageCreator($this->getParamsPageImage());

        $Image->setSrc($this->getPageImageSize(688, 616));
        $Image->addToSrcset($this->getPageImageSize(688, 616), "1x");
        $Image->addToSrcset($this->getPageImageSize(1376, 1232), "2x");
        $Image->setDraggable(false);

        $ImageAlt = get_post_meta($this->getParamsPageImage(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getParamsPageImage());

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render();
    }

    public function renderWideThumbnail()
    {
        $Thumbnail = new ImageCreator($this->getThumbnailId());

        $Thumbnail->setSrc($this->getThumbnailSize(1920, 710));
        $Thumbnail->addToSrcset($this->getThumbnailSize(1920, 710), "1x");
        $Thumbnail->addToSrcset($this->getThumbnailSize(2840, 1420), "2x");
        $Thumbnail->setDraggable(false);

        $ThumbnailAlt = get_post_meta($this->getThumbnailId(), '_wp_attachment_image_alt', true);
        $ThumbnailTitle = get_the_title($this->getThumbnailId());

        if ($ThumbnailAlt) {
            $Thumbnail->setAlt($ThumbnailAlt);
        } else {
            $Thumbnail->setAlt($ThumbnailTitle);
        }

        return $Thumbnail->render();
    }

    public function getAboutImageSize($width, $height)
    {
        return Image::getCloudImage($this->getAboutImage(), $width, $height);
    }

    public function renderAboutImage()
    {
        $Image = new ImageCreator($this->getAboutImage());

        $Image->setSrc($this->getAboutImageSize(776, 523));
        $Image->addToSrcset($this->getAboutImageSize(776, 523), "1x");
        $Image->addToSrcset($this->getAboutImageSize(1552, 1046), "2x");
        $Image->setDraggable(false);

        $ImageAlt = get_post_meta($this->getAboutImage(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getAboutImage());

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render();
    }

    public function loopBlocks($BlockExtraId = null)
    {
        foreach ($this->getBlockIdsToArray() as $BlockId) {
            $BlockPath = BlockFactory::getBlockPathById($BlockId);
            if ($BlockPath === "") {
                continue;
            }
            if ($BlockId == "title" || $BlockId == "content") {
                $BlockId = $this->getPostId();
            }

            if (Util::issetAndNotEmpty($BlockExtraId)) {
                $BlockId = $BlockExtraId;
            }
            $Block = get_post($BlockId);
            global $post;
            $post = $Block;
            get_template_part($BlockPath);
        }
    }

    public function renderHeadline($postId, $content = null, $class = "base-heading")
    {
        $headline = "";
        foreach ($this->getBlockIdsToArray() as $index => $BlockId) {
            if ($index == 0 && $BlockId == $postId) {
                $headline = "<h1 class='$class'>$content</h1>";
                return $headline;
            } else {
                $headline = "<h2 class='$class'>$content</h1>";
                return $headline;
            }
        }
        return $headline;
    }

    //? --- Bloky
    //? --- Prefix: Blocks

    public function getBlocksIds()
    {
        $BlocksIds = get_post_meta($this->getPostId(), TechnologyConfig::BLOCK_INPUT);
        return $BlocksIds = reset($BlocksIds);
    }

    public function getBlockIdsToArray()
    {
        return explode(",", $this->getBlocksIds());
    }

    //* --- Getters ------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsPersonId()
    {
        $personInArray = [];
        array_push($personInArray, $this->getMetaValue(TechnologyConfig::PARAMS_PERSON_ID));
        return $personInArray;
    }

    public function getParamsImagePosition()
    {
        return $this->getMetaValue(TechnologyConfig::PARAMS_IMAGE_POSITION);
    }

    public function getParamsButtonText()
    {
        return $this->getMetaValue(TechnologyConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsPageImage()
    {
        return $this->getMetaValue(TechnologyConfig::PARAMS_PAGE_IMAGE);
    }

    //* --- O technologii
    //* --- Prefix: About

    public function getAboutTitle()
    {
        return $this->getMetaValue(TechnologyConfig::ABOUT_TITLE);
    }

    public function getAboutDesc()
    {
        return html_entity_decode($this->getMetaValue(TechnologyConfig::ABOUT_DESC));
    }

    public function getAboutImage()
    {
        return $this->getMetaValue(TechnologyConfig::ABOUT_MEDIA_ID);
    }

    //* --- Technické parametry
    //* --- Prefix: Technickal params

    public function getTechnickalParamsContent()
    {
        return $this->getMetaValue(TechnologyConfig::TECHNICAL_PARAMS_CONTENT);
    }

    public function getTechnickalParamsContentFancy()
    {
        $Content = $this->getTechnickalParamsContent();
        $Content = str_replace("[y]", '<img class="aligncenter" src="' . Image::imageGetUrlFromTheme("svg/check-ico.svg") . '" alt="ANO">', $Content);
        $Content = str_replace("[x]", '<img class="aligncenter" src="' . Image::imageGetUrlFromTheme("svg/cross-ico.svg") . '" alt="NE">', $Content);
        return $Content;
    }

    public function getTechnickalParamsYear()
    {
        return $this->getMetaValue(TechnologyConfig::TECHNICAL_PARAMS_YEAR);
    }

    public function getTechnickalParamsAccuracy()
    {
        return $this->getMetaValue(TechnologyConfig::TECHNICAL_PARAMS_ACCURACY);
    }

    public function getTechnickalParamsTechnology()
    {
        return $this->getMetaValue(TechnologyConfig::TECHNICAL_PARAMS_TECHNOLOGY);
    }

    public function getTechnickalParamsWeight()
    {
        return $this->getMetaValue(TechnologyConfig::TECHNICAL_PARAMS_WEIGHT);
    }

    //* --- Gallery
    //* --- Prefix: Gallery

    public function getGalleryTitle()
    {
        return $this->getMetaValue(TechnologyConfig::GALLERY_TITLE);
    }

    public function getGalleryDesc()
    {
        return $this->getMetaValue(TechnologyConfig::GALLERY_DESC);
    }

    //* --- Gallery Collection
    //* --- Prefix: Gallery

    public function getGalleryCollection()
    {
        return $this->getMetaValue(TechnologyConfig::GALLERY_DYNAMIC_COLLECTION);
    }

    public function getGalleryImages()
    {
        $Gallery = [];

        foreach ($this->getGalleryCollection() as $Field) {
            $ImageId = kt_try_get_int($Field[TechnologyConfig::GALLERY_ITEM_MEDIA_ID]);

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

            $Gallery[] = [
                $renderedImage,
                Image::getCloudImage($ImageId, 1080),
            ];
        }


        return $Gallery;
    }

    //* --- Issety ------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function isParamsPersonId()
    {
        return Util::issetAndNotEmpty($this->getParamsPersonId());
    }

    public function isParamsImagePosition()
    {
        return Util::issetAndNotEmpty($this->getParamsImagePosition());
    }

    public function isParamsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonText());
    }

    public function isParamsPageImage(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsPageImage());
    }
    //* --- O technologii
    //* --- Prefix: About

    public function isAboutTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getAboutTitle());
    }

    public function isAboutDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getAboutDesc());
    }

    public function isAboutImage(): bool
    {
        return Util::issetAndNotEmpty($this->getAboutImage());
    }

    //* --- Text s obrázkem
    //* --- Prefix: Text image

    public function isTextThumbnailTitle()
    {
        return Util::issetAndNotEmpty($this->getTextThumbnailTitle());
    }

    public function isTextThumbnailDesc()
    {
        return Util::issetAndNotEmpty($this->getTextThumbnailDesc());
    }

    public function isTextThumbnailMediaId()
    {
        return Util::issetAndNotEmpty($this->getTextThumbnailMediaId());
    }

    //* --- Technické parametry
    //* --- Prefix: Technickal params

    public function isTechnickalParamsContent()
    {
        return Util::issetAndNotEmpty($this->getTechnickalParamsContent());
    }

    public function isTechnickalParamsYear()
    {
        return Util::issetAndNotEmpty($this->getTechnickalParamsYear());
    }

    public function isTechnickalParamsAccuracy()
    {
        return Util::issetAndNotEmpty($this->getTechnickalParamsAccuracy());
    }

    public function isTechnickalParamsTechnology()
    {
        return Util::issetAndNotEmpty($this->getTechnickalParamsTechnology());
    }

    public function isTechnickalParamsWeight()
    {
        return Util::issetAndNotEmpty($this->getTechnickalParamsWeight());
    }

    //* --- Gallery
    //* --- Prefix: Gallery

    public function isGalleryTitle()
    {
        return Util::issetAndNotEmpty($this->getGalleryTitle());
    }

    public function isGalleryDesc()
    {
        return Util::issetAndNotEmpty($this->getGalleryDesc());
    }

    //* --- Gallery Collection
    //* --- Prefix: Gallery

    public function isGalleryCollection()
    {
        return Util::arrayIssetAndNotEmpty($this->getGalleryCollection());
    }
}
