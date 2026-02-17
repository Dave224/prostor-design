<?php

namespace Components\Block;

use Utils\Util;
use Interfaces\Blockable;
use Interfaces\Configable;

/**
 * Class BlockConfig
 * @package Components\Block
 */
class BlockConfig implements Configable
{
    const FORM_PREFIX = Block::KEY;

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {

        $Fieldsets = [
            self::TYPE_FIELDSET => self::getBlockFieldset(),
        ];

        $SelectedType = self::initSelectedType();
        if (Util::issetAndNotEmpty($SelectedType)) {
            $SelectedType = str_replace(".", "\\", $SelectedType);
            $SelectedFieldsets = $SelectedType::getFieldsets(self::FORM_PREFIX);

            $Fieldsets = array_merge(
                $Fieldsets,
                $SelectedFieldsets
            );
        }

        return $Fieldsets;
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        if (is_admin()) {
            \KT_MetaBox::createMultiple(self::getAllGenericFieldsets(), Block::KEY, \KT_MetaBox_Data_Type_Enum::POST_META);
        }
    }

    public static function getBlockTypes()
    {
        $BlockableClasses = getImplementingClasses(Blockable::class);

        $BlockTypes = [];

        foreach ($BlockableClasses as $ClassName) {
            $TypeName = $ClassName::getTitle();
            $ClassName = str_replace("\\", ".", $ClassName);
            $BlockTypes[$ClassName] = $TypeName;
        }
        return $BlockTypes;
    }

    public static function getBlockTypesTitles()
    {
        $BlockableClasses = getImplementingClasses(Blockable::class);

        $BlockTypes = [];

        foreach ($BlockableClasses as $ClassName) {
            $TypeName = $ClassName::getTitle();
            array_push($BlockTypes, $TypeName);
        }

        return $BlockTypes;
    }

    public static function getBlockTypesTitlesRest()
    {
        $BlockTypes = self::getBlockTypesTitles();

        return new \WP_REST_Response($BlockTypes, 200);
    }

    public static function initSelectedType()
    {
        $PostMeta = "";
        if (array_key_exists("post", $_GET)) {
            $PostMeta = get_post_meta($_GET['post']);
        } else if (array_key_exists("post_ID", $_POST)) {
            $PostMeta = get_post_meta($_POST['post_ID']);
        }

        if (Util::issetAndNotEmpty($PostMeta) && array_key_exists(self::TYPE_SELECT, $PostMeta)) {
            $SelectedType = $PostMeta[self::TYPE_SELECT][0];
            return $SelectedType;
        }
    }



    // --- BlockType ---------------------------

    const TYPE_FIELDSET = self::FORM_PREFIX . "-type";
    const TYPE_SELECT = self::TYPE_FIELDSET . "-select";

    public static function getBlockFieldset()
    {

        $fieldset = new \KT_Form_Fieldset(self::TYPE_FIELDSET, __("Typ bloku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::TYPE_FIELDSET);


        $fieldset->addSelect(self::TYPE_SELECT, __("Typ bloku", "PD_ADMIN_DOMAIN"))
            ->setOptionsData(self::getBlockTypes())
            ->setFirstEmpty();

        return $fieldset;
    }
}
