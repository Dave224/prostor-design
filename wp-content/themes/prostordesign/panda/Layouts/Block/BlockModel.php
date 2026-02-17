<?php

namespace Layouts\Block;

use Utils\Util;
use Components\Block\BlockFactory;

/**
 * Class BlockModel
 * @package Layouts\Block
 */
class BlockModel extends \KT_WP_Post_Base_Model
{
    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
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

    public function isBlockFirst($postId): bool
    {
        foreach ($this->getBlockIdsToArray() as $index => $BlockId) {
            if ($index == 0 && $BlockId == $postId) {
                return true;
            } else {
                return false;
            }
        }
    }

    //* --- getry ------------------------


    //? --- Nastavení stránky
    //? --- Prefix: Settings

    public function getBlocksIds()
    {
        $BlocksIds = get_post_meta($this->getPostId(), BlockConfig::BLOCK_INPUT);
        return $BlocksIds = reset($BlocksIds);
    }

    public function getBlockIdsToArray()
    {
        return explode(",", $this->getBlocksIds());
    }

    //* --- issety ------------------------


    //? --- Nastavení stránky
    //? --- Prefix: Settings

    public function isBlocks()
    {
        return Util::issetAndNotEmpty($this->getBlockIdsToArray()[0]);
    }


    //* --- Setters ------------------------


}
