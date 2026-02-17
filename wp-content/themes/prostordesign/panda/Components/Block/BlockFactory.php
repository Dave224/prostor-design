<?php

namespace Components\Block;

use Utils\Util;

/**
 * Class BlockFactory
 * @package Components\Block
 */
class BlockFactory
{

    /**
     * @var string|int $Id
     */
    public static function getBlockPathById($Id): string
    {
        $Path = "";
        if ($Id == "title" || $Id == "content") {
            if ($Id == "title") {
                $TemplateName = "title";
            }
            if ($Id == "content") {
                $TemplateName = "content";
            }
            $ComponentPath = dirname(str_replace("\\", "/", Block::class));
            return "panda/{$ComponentPath}/templates/{$TemplateName}";
        }

        $Block = get_post($Id);
        $BlockModel = new BlockModel($Block);

        if ($BlockModel->isTypeSelect() && $BlockModel->isTypeClassExist()) {
            $SelectedType = str_replace(".", "\\", $BlockModel->getTypeSelect());
            $TemplateName = $SelectedType::getTemplateName();
            $ComponentPath = dirname(str_replace("\\", "/", $SelectedType));
            $Path = "panda/$ComponentPath/$TemplateName";
            return $Path;
        }

        return $Path;
    }

    public static function createById(?int $Id = null): BlockModel
    {
        if (Util::issetAndNotEmpty($Id)) {
            $Block = get_post($Id);
            return new BlockModel($Block);
        }
        global $post;
        return new BlockModel($post);
    }
}
