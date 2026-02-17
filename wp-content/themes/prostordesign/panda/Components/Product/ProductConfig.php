<?php

namespace Components\Product;


use Interfaces\Configable;

class ProductConfig implements Configable
{
    const FORM_PREFIX = "pd-product";
	
	const WC_PRICE = '_price';
	const WC_REGULAR_PRICE = '_regular_price';
	const WC_SALE_PRICE = '_sale_price';
	const WC_VARIATION_SALE_PRICE = '_min_variation_sale_price';

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::PARAMS_FIELDSET                   => self::getParamsFieldset(),
            self::DYNAMIC_SPECIFICATION_FIELDSET    => self::getDynamicSpecificationFieldset(),
            self::DYNAMIC_COLORS_FIELDSET           => self::getDynamicColorsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::SPECIFICATION_FIELDSET    => self::getSpecificationFieldset(),
            self::COLORS_FIELDSET           => self::getColorsFieldset(),
        ];
    }

    public static function registerMetaboxes()
    {
        registerMetabox(self::class, Product::KEY);

        add_action("add_meta_boxes_product", [self::class, "addBlocksPostField"]);

        add_action("save_post_product", [self::class, "saveBlocksPostField"]);
    }

    // --- Parametry ---------------------------

    const PARAMS_FIELDSET       = self::FORM_PREFIX . "-params";
    const PARAMS_TITLE          = self::PARAMS_FIELDSET . "-title";
    const PARAMS_DESCRIPTION    = self::PARAMS_FIELDSET . "-description";
    const PARAMS_ASIDE          = self::PARAMS_FIELDSET . "-aside";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek nad popisem produktu", "PD_ADMIN_DOMAIN"));
        $fieldset->addWpEditor(self::PARAMS_DESCRIPTION, __("Popis produktu", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_ASIDE, __("Zobrazit aside s kontaktní osobou", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- Specifikace ---------------------------

    const SPECIFICATION_FIELDSET    = self::FORM_PREFIX . "-specification";
    const SPECIFICATION_ITEM        = self::SPECIFICATION_FIELDSET . "-item";

    public static function getSpecificationFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SPECIFICATION_FIELDSET, __("Specifikace", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SPECIFICATION_FIELDSET);

        $fieldset->addText(self::SPECIFICATION_ITEM, __("Položka v seznamu:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const DYNAMIC_SPECIFICATION_FIELDSET = self::FORM_PREFIX . "-dynamic-specification";
    const DYNAMIC_SPECIFICATION_FIELD = self::DYNAMIC_SPECIFICATION_FIELDSET . "-field";

    public static function getDynamicSpecificationFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::DYNAMIC_SPECIFICATION_FIELDSET, __("Specifikace", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::DYNAMIC_SPECIFICATION_FIELDSET);

        $fieldset->addFieldset(self::DYNAMIC_SPECIFICATION_FIELD, __("Specifikace", "PD_ADMIN_DOMAIN"), [self::class, self::SPECIFICATION_FIELDSET]);

        return $fieldset;
    }

    // --- Barvy ---------------------------

    const COLORS_FIELDSET    = self::FORM_PREFIX . "-colors";
    const COLORS_TITLE       = self::COLORS_FIELDSET . "-title";
    const COLORS_COLOR       = self::COLORS_FIELDSET . "-color";

    public static function getColorsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::COLORS_FIELDSET, __("Barvy", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::COLORS_FIELDSET);

        $fieldset->addText(self::COLORS_TITLE, __("Položka v seznamu:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::COLORS_COLOR, __("Barva v RGB (oddělte hodnoty čárkami):", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const DYNAMIC_COLORS_FIELDSET = self::FORM_PREFIX . "-dynamic-colors";
    const DYNAMIC_COLORS_FIELD = self::DYNAMIC_COLORS_FIELDSET . "-field";

    public static function getDynamicColorsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::DYNAMIC_COLORS_FIELDSET, __("Barvy", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::DYNAMIC_COLORS_FIELDSET);

        $fieldset->addFieldset(self::DYNAMIC_COLORS_FIELD, __("Barvy", "PD_ADMIN_DOMAIN"), [self::class, self::COLORS_FIELDSET]);

        return $fieldset;
    }

    public static function addBlocksPostField()
    {
        add_meta_box(
            self::class,
            __("Výběr bloků", ADMIN_DOMAIN),
            [self::class, "getBlocksPostField"],
            "product",
            "normal",
            "high"
        );
    }

    public static function getBlocksPostField()
    {
        get_template_part("panda/Admin/Components/BlocksField/BlocksField");
    }

    public static function saveBlocksPostField($post_id)
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