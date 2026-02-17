<?php

namespace Components\Person;

use Utils\Util;
use Utils\Image;
use Utils\uString;
use Helpers\ImageCreator;
use Components\Person\PersonConfig;

/**
 * Class PersonModel
 * @package Components\Person
 */
class PersonModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, PersonConfig::FORM_PREFIX);
    }

    public function getThumbnailSize($width, $height)
    {
        return Image::getCloudImage($this->getThumbnailId(), $width, $height);
    }

    public function renderThumbnail()
    {
        $Thumbnail = new ImageCreator($this->getThumbnailId());

        $Thumbnail->setSrc($this->getThumbnailSize(224, 224));
        $Thumbnail->addToSrcset($this->getThumbnailSize(224, 224), "1x");
        $Thumbnail->addToSrcset($this->getThumbnailSize(448, 448), "2x");
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

    //* --- Getters ------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsPosition()
    {
        return $this->getMetaValue(PersonConfig::PARAMS_POSITION);
    }

    public function getParamsFirstPhone()
    {
        return $this->getMetaValue(PersonConfig::PARAMS_FIRST_PHONE);
    }

    public function getParamsFirstPhoneClear()
    {
        return uString::clearPhoneNumber($this->getMetaValue(PersonConfig::PARAMS_FIRST_PHONE));
    }

    public function getParamsFirstPhoneFancy()
    {
        return uString::phoneNumberFormat($this->getMetaValue(PersonConfig::PARAMS_FIRST_PHONE));
    }

    public function getParamsSecondPhone()
    {
        return $this->getMetaValue(PersonConfig::PARAMS_SECOND_PHONE);
    }

    public function getParamsSecondPhoneClear()
    {
        return uString::clearPhoneNumber($this->getMetaValue(PersonConfig::PARAMS_SECOND_PHONE));
    }

    public function getParamsSecondPhoneFancy()
    {
        return uString::phoneNumberFormat($this->getMetaValue(PersonConfig::PARAMS_SECOND_PHONE));
    }

    public function getParamsEmail()
    {
        return $this->getMetaValue(PersonConfig::PARAMS_EMAIL);
    }

    public function getParamsDesc()
    {
        return $this->getMetaValue(PersonConfig::PARAMS_DESC);
    }

    //* --- Issety ------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function isParamsPosition()
    {
        return Util::issetAndNotEmpty($this->getParamsPosition());
    }

    public function isParamsFirstPhone()
    {
        return Util::issetAndNotEmpty($this->getParamsFirstPhone());
    }

    public function isParamsSecondPhone()
    {
        return Util::issetAndNotEmpty($this->getParamsSecondPhone());
    }

    public function isParamsEmail()
    {
        return Util::issetAndNotEmpty($this->getParamsEmail());
    }

    public function isParamsDesc()
    {
        return Util::issetAndNotEmpty($this->getParamsDesc());
    }
}
