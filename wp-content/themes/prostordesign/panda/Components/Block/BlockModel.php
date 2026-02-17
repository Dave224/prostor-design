<?php

namespace Components\Block;

use Utils\Util;
use Utils\Admin;

/**
 * Class BlockModel
 * @package Components\Block
 */
class BlockModel extends \KT_WP_Post_Base_Model
{
    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getBlockAdmin()
    {
        $Block = [
            "Title" => $this->getTitle(),
            "Id" => $this->getPostId(),
            "UrlEdit" => Admin::getEditLink($this->getPostId()),
            "Type" => $this->getTypeTitle(),
        ];
        return $Block;
    }

    //* --- Getters ------------------------------

    public function getTypeSelect()
    {
        return $this->getMetaValue(BlockConfig::TYPE_SELECT);
    }

    public function getTypeClassName(): string
    {
        return str_replace(".", "\\", $this->getTypeSelect());
    }

    public function getTypeTitle()
    {
        $ClassName = $this->getTypeClassName();
        return $ClassName::getTitle();
    }


    //* --- Issets -------------------------------

    public function isTypeSelect(): bool
    {
        return Util::issetAndNotEmpty($this->getTypeSelect());
    }

    public function isTypeClassExist(): bool
    {
        return class_exists($this->getTypeClassName());
    }
}
