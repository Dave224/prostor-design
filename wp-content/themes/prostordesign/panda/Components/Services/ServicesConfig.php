<?php

namespace Components\Services;

use Components\Person\Person;
use Components\Technology\Technology;
use Interfaces\Configable;

/**
 * Class ServicesConfig
 * @package Components\Services
 */
class ServicesConfig implements Configable
{
    const FORM_PREFIX = Services::KEY;

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::ABOUT_FIELDSET => self::getTextImageFieldset(),
            self::GALLERY_FIELDSET => self::getGalleryFieldset(),
            self::GALLERY_DYNAMIC_FIELDSET => self::getGalleryDynamicFieldset()
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function getAllDynamicFieldsets(): array
    {
        return [
            self::GALLERY_ITEM_FIELDSET => self::getGalleryItemFieldset()
        ];
    }

    public static function registerMetaboxes()
    {
        registerMetabox(self::class, Services::KEY);
        add_action("add_meta_boxes_services", [self::class, "addBlocksField"]);

        add_action("save_post_services", [self::class, "saveBlocksField"]);
    }

    public static function addBlocksField()
    {
        add_meta_box(
            self::class,
            __("Výběr bloků", "PD_ADMIN_DOMAIN"),
            [self::class, "getBlocksField"],
            "services",
            "normal",
            "high"
        );
    }

    public static function getBlocksField()
    {
        get_template_part("panda/Admin/Components/BlocksFieldServices/BlocksFieldServices");
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

    // --- Parametry ---------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_PERSON_ID = self::PARAMS_FIELDSET . "-person-id";
    const PARAMS_TECHNOLOGY_ID = self::PARAMS_FIELDSET . "-technology-id";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "-button-text";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addSelect(self::PARAMS_PERSON_ID, __("Kontaktní osoba:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Person::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));
        $fieldset->addSelect(self::PARAMS_TECHNOLOGY_ID, __("Technologie:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Technology::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->setAfterFieldsetContent("Pokud bude nastaven text tlačítka, zobrazí se tlačítko s pop-up formulářem.");

        return $fieldset;
    }

    // --- O službě ---------------------------

    const ABOUT_FIELDSET = self::FORM_PREFIX . "-about";
    const ABOUT_TITLE = self::ABOUT_FIELDSET . "-title";
    const ABOUT_DESC = self::ABOUT_FIELDSET . "-desc";
    const ABOUT_MEDIA_ID = self::ABOUT_FIELDSET . "-media-id";

    public static function getTextImageFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::ABOUT_FIELDSET, __("O službě", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::ABOUT_FIELDSET);

        $fieldset->addText(self::ABOUT_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::ABOUT_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::ABOUT_MEDIA_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- Galerie ---------------------------

    const GALLERY_FIELDSET = self::FORM_PREFIX . "-gallery";
    const GALLERY_TITLE = self::GALLERY_FIELDSET . "-title";
    const GALLERY_DESC = self::GALLERY_FIELDSET . "-desc";

    public static function getGalleryFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::GALLERY_FIELDSET, __("Galerie", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::GALLERY_FIELDSET);

        $fieldset->addText(self::GALLERY_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::GALLERY_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- Galerie - item ---------------------------

    const GALLERY_ITEM_FIELDSET = self::FORM_PREFIX . "-gallery-item";
    const GALLERY_ITEM_MEDIA_ID = self::GALLERY_ITEM_FIELDSET . "-media-id";

    public static function getGalleryItemFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::GALLERY_ITEM_FIELDSET, __("Položka galerie", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(SELF::GALLERY_ITEM_FIELDSET);

        $fieldset->addMedia(self::GALLERY_ITEM_MEDIA_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- Galerie - dynamic collection ---------------------------

    const GALLERY_DYNAMIC_FIELDSET = self::FORM_PREFIX . "-gallery-dynamic";
    const GALLERY_DYNAMIC_COLLECTION = self::GALLERY_DYNAMIC_FIELDSET . "-collection";

    public static function getGalleryDynamicFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::GALLERY_DYNAMIC_FIELDSET, __("Galerie", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::GALLERY_DYNAMIC_FIELDSET);

        $fieldset->addFieldset(self::GALLERY_DYNAMIC_COLLECTION, __("Obrázek:", "PD_ADMIN_DOMAIN"), [self::class, self::GALLERY_ITEM_FIELDSET]);

        return $fieldset;
    }
}
