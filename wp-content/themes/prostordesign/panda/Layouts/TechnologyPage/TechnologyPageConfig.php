<?php

namespace Layouts\TechnologyPage;

use Components\Technology\Technology;
use Utils\Admin;
use Interfaces\Configable;


/**
 * Class TechnologyPageConfig
 * @package Layouts\TechnologyPage
 */
class TechnologyPageConfig implements Configable
{
    const FORM_PREFIX = "page-tech";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::TECHNOLOGY_FIELDSET => self::getTechnologyFieldset(),
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::FORM_FIELDSET => self::getFormFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function getAllDynamicFieldsets()
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        if (Admin::isPageTemplate("pages/page-tech.php")) {
            add_action("add_meta_boxes_page", [self::class, "addBlocksField"]);
        }
        add_action("save_post_page", [self::class, "saveBlocksField"]);

        if (is_admin()) {
            $pageMetaboxes = \KT_MetaBox::createMultiple(self::getAllNormalFieldsets(), KT_WP_PAGE_KEY, \KT_MetaBox_Data_Type_Enum::POST_META, false);

            foreach ($pageMetaboxes as $pageMetabox) {
                $pageMetabox->setPageTemplate("pages/page-tech.php");
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
        get_template_part("panda/Admin/Components/BlocksFieldTechnologyPage/BlocksFieldTechnologyPage");
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

    const SETTINGS_FIELDSET = self::FORM_PREFIX . "-settings";
    const SETTINGS_SPACE_TOP = self::SETTINGS_FIELDSET . "-space-top";
    const SETTINGS_SPACE_BOT = self::SETTINGS_FIELDSET . "-space-bot";
    const SETTINGS_DIVIDER = self::SETTINGS_FIELDSET . "-divider";

    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení intra", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addSwitch(self::SETTINGS_SPACE_TOP, __("Mezera nad blokem:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::SETTINGS_SPACE_BOT, __("Mezera pod blokem:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::SETTINGS_DIVIDER, __("Oddělovač pod blokem:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- Parametry ------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_DESCRIPTION = self::PARAMS_FIELDSET . "-description";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "-button-text";
    const PARAMS_BUTTON_URL = self::PARAMS_FIELDSET . "-button-url";
    const PARAMS_BUTTON_TARGET = self::PARAMS_FIELDSET . "-button-target";
    const PARAMS_IMAGE = self::PARAMS_FIELDSET . "-image";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextareaMinimal(self::PARAMS_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_BUTTON_TARGET, __("Otevřít v novém okně:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_IMAGE, __("Obrázek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- Nastavení formuláře ------------------------

    const FORM_FIELDSET = self::FORM_PREFIX . "-form";
    const FORM_TITLE = self::FORM_FIELDSET . "-title";
    const FORM_DESC = self::FORM_FIELDSET . "-desc";

    public static function getFormFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FORM_FIELDSET, __("Nastavení formuláře", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FORM_FIELDSET);

        $fieldset->addText(self::FORM_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::FORM_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- Výběr technologií ------------------------

    const TECHNOLOGY_FIELDSET = self::FORM_PREFIX . "-tech";
    const TECHNOLOGY_COUNT = self::TECHNOLOGY_FIELDSET . "-count";
    const TECHNOLOGY_SELECT = self::TECHNOLOGY_FIELDSET . "-select";

    public static function getTechnologyFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::TECHNOLOGY_FIELDSET, __("Výběr technologií", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::TECHNOLOGY_FIELDSET);

        $fieldset->addMultiSelect(self::TECHNOLOGY_SELECT, __("Technologie:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Technology::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));
        $fieldset->addNumber(self::TECHNOLOGY_COUNT, __("Počet technologií na stránce:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
