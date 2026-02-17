<?php

namespace Components\Services;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockFactory;
use Components\Services\ServicesConfig;

/**
 * Class ServicesModel
 * @package Components\Services
 */
class ServicesModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, ServicesConfig::FORM_PREFIX);
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
        $Thumbnail->setClass("intro-section__img");

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
        $BlocksIds = get_post_meta($this->getPostId(), ServicesConfig::BLOCK_INPUT);
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
        array_push($personInArray, $this->getMetaValue(ServicesConfig::PARAMS_PERSON_ID));
        return $personInArray;
    }

    public function getParamsTechnologyId()
    {
        return $this->getMetaValue(ServicesConfig::PARAMS_TECHNOLOGY_ID);
    }

    public function getParamsButtonText()
    {
        return $this->getMetaValue(ServicesConfig::PARAMS_BUTTON_TEXT);
    }

    //* --- Gallery
    //* --- Prefix: Gallery

    public function getGalleryTitle()
    {
        return $this->getMetaValue(ServicesConfig::GALLERY_TITLE);
    }

    public function getGalleryDesc()
    {
        return $this->getMetaValue(ServicesConfig::GALLERY_DESC);
    }

    //* --- O službě
    //* --- Prefix: About

    public function getAboutTitle()
    {
        return $this->getMetaValue(ServicesConfig::ABOUT_TITLE);
    }

    public function getAboutDesc()
    {
        return html_entity_decode($this->getMetaValue(ServicesConfig::ABOUT_DESC));
    }

    public function getAboutImage()
    {
        return $this->getMetaValue(ServicesConfig::ABOUT_MEDIA_ID);
    }

    //* --- Gallery Collection
    //* --- Prefix: Gallery

    public function getGalleryCollection(): ?array
    {
        return $this->getMetaValue(ServicesConfig::GALLERY_DYNAMIC_COLLECTION);
    }

    public function getGalleryImages()
    {
        $Gallery = [];

        foreach ($this->getGalleryCollection() as $Field) {
            $ImageId = kt_try_get_int($Field[ServicesConfig::GALLERY_ITEM_MEDIA_ID]);

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

    public function isParamsPersonId(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsPersonId());
    }

    public function isParamsTechnologyId(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTechnologyId());
    }

    public function isParamsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonText());
    }

    //* --- O službě
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

    //* --- Gallery
    //* --- Prefix: Gallery

    public function isGalleryTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getGalleryTitle());
    }

    public function isGalleryDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getGalleryDesc());
    }

    //* --- Gallery Collection
    //* --- Prefix: Gallery

    public function isGalleryCollection(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getGalleryCollection());
    }
}
