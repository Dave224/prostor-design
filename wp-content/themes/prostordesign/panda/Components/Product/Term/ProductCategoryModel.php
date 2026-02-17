<?php


namespace Components\Product\Term;

use Helpers\ImageCreator;
use Utils\Image;
use Utils\Util;

/**
 * Class ProductCategoryModel
 * @package Components\Product\Term
 */
class ProductCategoryModel extends \KT_WP_Term_Base_Model
{
    public function __construct(\WP_Term $term)
    {
        parent::__construct($term);
    }

    static public function getTerms($parentId = 0)
    {
        return get_terms([
            'taxonomy' => ProductCategory::KEY,
            'hide_empty' => true,
            'parent' => $parentId,
            'orderby' => 'name',
            'order' => 'ASC',
        ]);
    }


    static public function isProductCategory()
    {
        $ajaxCategoryId = (int) self::getAjaxCategoryId();
        return ($ajaxCategoryId > 0 || is_tax(ProductCategory::KEY));
    }

    static public function getProductCategoryId()
    {
        $ajaxCategoryId = (int) self::getAjaxCategoryId();
        if ($ajaxCategoryId > 0) {
            return $ajaxCategoryId;
        }

        return get_queried_object_id();
    }

    static public function getAjaxCategoryId()
    {
        $requestValue = Util::arrayTryGetValue($_REQUEST, 'ajax_category');
        if (Util::issetAndNotEmpty($requestValue)) {
            return $requestValue;
        }
    }

    public function getTitle()
    {
        return $this->getName();
    }

    public function getContent()
    {
        return $this->getDescription();
    }

    public function getImageForBlockId()
    {

        $thumbnailId = get_term_meta($this->getId(), ProductCategoryConfig::SETTINGS_IMAGE_FOR_BLOCK, true);
        if (!Util::issetAndNotEmpty($thumbnailId)) {
            // Fallback: try the default WooCommerce/WordPress key
            $thumbnailId = get_term_meta($this->getId(), 'thumbnail_id', true);
        }
        return $thumbnailId;
    }


    public function getImageForBlockSize($width, $height)
    {
        return Image::getCloudImage($this->getImageForBlockId(), $width, $height);
    }

    public function renderImageForBlock()
    {
        $Image = new ImageCreator($this->getImageForBlockId());

        $Image->setSrcWithoutPostfix($this->getImageForBlockSize(500, 316));
        $Image->addToSrcset($this->getImageForBlockSize(500, 316), "1x");
        $Image->addToSrcset($this->getImageForBlockSize(1000, 632), "2x");
        $Image->setDraggable(false);

        return $Image->render();
    }

    public function renderImageForBlockSmaller()
    {
        $Image = new ImageCreator($this->getImageForBlockId());

        $Image->setSrcWithoutPostfix($this->getImageForBlockSize(236, 186));
        $Image->addToSrcset($this->getImageForBlockSize(236, 186), "1x");
        $Image->addToSrcset($this->getImageForBlockSize(472, 372), "2x");
        $Image->setDraggable(false);
        $Image->setClass("product-signpost-item__img");

        return $Image->render();
    }

    public function getThumbnailId()
    {
        $thumbnailId = get_term_meta($this->getId(), ProductCategoryConfig::SETTINGS_THUMBNAIL, true);
        if (!Util::issetAndNotEmpty($thumbnailId)) {
            // Fallback: try the default WooCommerce/WordPress key
            $thumbnailId = get_term_meta($this->getId(), 'thumbnail_id', true);
        }
        return $thumbnailId;
    }

    public function getThumbnailSize($width, $height)
    {
        return Image::getCloudImage($this->getThumbnailId(), $width, $height);
    }

    public function renderThumbnail()
    {
        $Image = new ImageCreator($this->getThumbnailId());

        $Image->setSrcWithoutPostfix($this->getThumbnailSize(1140, 512));
        $Image->addToSrcset($this->getThumbnailSize(1140, 512), "1x");
        $Image->addToSrcset($this->getThumbnailSize(2280, 1024), "2x");
        $Image->setDraggable(false);
        $Image->setClass("intro-section__img");

        return $Image->render();
    }

    public function isImageForBlockId(): bool
    {
        return Util::issetAndNotEmpty($this->getImageForBlockId());
    }

    public function isThumbnail(): bool
    {
        return Util::issetAndNotEmpty($this->getThumbnailId());
    }

    public function isContent(): bool
    {
        return Util::issetAndNotEmpty($this->getContent());
    }
}
