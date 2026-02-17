<?php

namespace Components\BlocksStaticLayouts;

use Interfaces\Configable;

class BlocksStaticLayoutsConfig implements Configable
{
    const FORM_PREFIX = "block-static-layouts";

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
        if (isset($_GET["page"]) && $_GET["page"] == BLOCK_STATIC_LAYOUTS_PAGE) {
            add_action("add_meta_boxes_" . BLOCK_STATIC_LAYOUTS_PAGE_SLUG, [self::class, "addBlocksStaticLayoutField"]);
            add_action("updated_option", [self::class, "saveBlocksStaticLayoutField"]);
        }
    }

    public static function addBlocksStaticLayoutField()
    {
        add_meta_box(
            self::class,
            __("Výběr bloků", "PD_ADMIN_DOMAIN"),
            [self::class, "getBlocksStaticLayoutField"],
            BLOCK_STATIC_LAYOUTS_PAGE_SLUG,
            "normal",
            "high"
        );
    }

    public static function getBlocksStaticLayoutField()
    {
        get_template_part("panda/Admin/Components/BlocksField/StaticLayoutBlocksField");
    }

    public static function saveBlocksStaticLayoutField($post_id)
    {
        if (array_key_exists(self::FORM_PREFIX, $_POST)) {
            update_option(self::PRODUCT_CATEGORIES_BLOCK_INPUT, $_POST[self::FORM_PREFIX][self::PRODUCT_CATEGORIES_BLOCK_INPUT]);
            update_option(self::PRODUCT_DETAIL_BLOCK_INPUT, $_POST[self::FORM_PREFIX][self::PRODUCT_DETAIL_BLOCK_INPUT]);
        } else {
            add_option(self::PRODUCT_CATEGORIES_BLOCK_INPUT, $_POST[self::FORM_PREFIX][self::PRODUCT_CATEGORIES_BLOCK_INPUT]);
            add_option(self::PRODUCT_DETAIL_BLOCK_INPUT, $_POST[self::FORM_PREFIX][self::PRODUCT_DETAIL_BLOCK_INPUT]);
        }
    }

    const PRODUCT_CATEGORIES_BLOCK_INPUT    = self::FORM_PREFIX . "-product-categories-blocks-ids";
    const PRODUCT_DETAIL_BLOCK_INPUT        = self::FORM_PREFIX . "-product-detail-blocks-ids";

    public static function getAllBlocksInputs()
    {
        $BlocksInputs = [
            "Pro kategorie produktů"   => self::PRODUCT_CATEGORIES_BLOCK_INPUT,
            "Pro detail produktů"      => self::PRODUCT_DETAIL_BLOCK_INPUT,
        ];

        return $BlocksInputs;
    }
}
