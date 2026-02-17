<?php

namespace Layouts\Block;

use Utils\Admin;
use Interfaces\Configable;


/**
 * Class BlockConfig
 * @package Layouts\Block
 */
class BlockConfig implements Configable
{

    const FORM_PREFIX = "page-block";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        if (Admin::isPageTemplate("pages/page-blocks.php")) {
            add_action("add_meta_boxes_page", [self::class, "addBlocksField"]);
        }
        add_action("save_post_page", [self::class, "saveBlocksField"]);
    }

    public static function addBlocksField()
    {
        add_meta_box(
            self::class,
            __("Výběr bloků", "PD_ADMIN_DOMAIN"),
            [self::class, "getBlocksField"],
            "page",
            "normal",
            "high"
        );
    }

    public static function getBlocksField()
    {
        get_template_part("panda/Admin/Components/BlocksField/BlocksField");
    }

    public static function saveBlocksField($post_id)
    {
        if (is_admin()) {
            if (!current_user_can('edit_post', $post_id)) return;
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        }

        if (array_key_exists(self::FORM_PREFIX, $_POST)) {
            update_post_meta($post_id, self::BLOCK_INPUT, $_POST[self::FORM_PREFIX][self::BLOCK_INPUT]);
        }
    }

    const BLOCK_INPUT = self::FORM_PREFIX . "-blocks-ids";
}
