<?php
namespace Components\User;

use Utils\Util;
use Utils\Image;

class UserModel extends \KT_WP_User_Base_Model
{
    private $paramImageUrl;
    private $userImageSrc;


    function __construct($userId)
    {
        parent::__construct($userId);
    }

    // --- getry & setry ------------------------

    public function getParamImageId()
    {
        return $this->getMetaValue(UserConfig::IMAGE_ID);
    }


    public function getParamImageUrl()
    {
        if (isset($this->paramImageUrl)) {
            return $this->paramImageUrl;
        }
        if ($this->isParamImageId()) {
            return $this->paramImageUrl = Image::getImageSrc($this->getParamImageId(), KT_WP_IMAGE_SIZE_MEDIUM);
        }
        return $this->paramImageUrl = "";
    }

    public function getUserImage()
    {
        if (isset($this->userImageSrc)) {
            return $this->userImageSrc;
        }

        if ($this->isParamImageId()) {
            $avatarUrl = $this->getParamImageUrl();
        } else {
            $avatarUrl = get_avatar_url($this->getId(), ["size" => 168]);
        }

        return $this->userImageSrc = $avatarUrl;
    }


    // --- veřejné funkce ------------------------

    public function isParamImageId()
    {
        return Util::isIdFormat($this->getParamImageId());
    }
}
