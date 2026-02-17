<?php

namespace Layouts\FrontPage;

use Utils\Admin;
use Interfaces\Configable;


/**
 * Class FrontPageConfig
 * @package Layouts\FrontPage
 */
class FrontPageConfig implements Configable
{
    const FORM_PREFIX = "page-home";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::DYNAMIC_SLIDER_FIELDSET => self::getDynamicSliderFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::SLIDER_FIELDSET => self::getSliderFieldset(),
        ];
    }

    public static function registerMetaboxes()
    {
        if (Admin::isPageTemplate("pages/page-front.php")) {
            add_action("add_meta_boxes_page", [self::class, "addBlocksField"]);
        }
        add_action("save_post_page", [self::class, "saveBlocksField"]);

        if (is_admin()) {
            $pageMetaboxes = \KT_MetaBox::createMultiple(self::getAllNormalFieldsets(), KT_WP_PAGE_KEY, \KT_MetaBox_Data_Type_Enum::POST_META, false);

            foreach ($pageMetaboxes as $pageMetabox) {
                $pageMetabox->setPageTemplate("pages/page-front.php");
                $pageMetabox->setPriority(\KT_MetaBox::PRIORITY_HIGH);
                $pageMetabox->register();
            }
        }
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
        get_template_part("panda/Admin/Components/BlocksFieldFrontPage/BlocksFieldFrontPage");
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

    // --- Parametry ------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_DESCRIPTION = self::PARAMS_FIELDSET . "-description";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "-button-text";
    const PARAMS_BUTTON_URL = self::PARAMS_FIELDSET . "-button-url";
    const PARAMS_BUTTON_TARGET = self::PARAMS_FIELDSET . "-button-target";
    const PARAMS_MOBILE_IMAGE_ID = self::PARAMS_FIELDSET . "-mobile-image-id";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextareaMinimal(self::PARAMS_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_BUTTON_TARGET, __("Otevřít v novém okně:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_MOBILE_IMAGE_ID, __("Obrázek pro telefon:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const SLIDER_FIELDSET = self::FORM_PREFIX . "-params";
    const SLIDER_IMAGE_ID = self::SLIDER_FIELDSET . "-image-id";

    public static function getSliderFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SLIDER_FIELDSET, __("Obrázek", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SLIDER_FIELDSET);

        $fieldset->addMedia(self::SLIDER_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->setAfterFieldsetContent("Obrázek pro telefon funguje pouze pro první položku.");

        return $fieldset;
    }

    const DYNAMIC_SLIDER_FIELDSET = self::FORM_PREFIX . "-dynamic-slider";
    const DYNAMIC_SLIDER_COLLECTION = self::DYNAMIC_SLIDER_FIELDSET . "-collection";

    public static function getDynamicSliderFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::DYNAMIC_SLIDER_FIELDSET, __("Slider", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::DYNAMIC_SLIDER_FIELDSET);

        $fieldset->addFieldset(self::DYNAMIC_SLIDER_COLLECTION, __("Obrázek", "PD_ADMIN_DOMAIN"), [self::class, self::SLIDER_FIELDSET]);
        $fieldset->setAfterFieldsetContent("Maximální počet položek: 5");

        return $fieldset;
    }
}
