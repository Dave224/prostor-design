<?php

namespace Components\Block\Type\Documents;


/**
 * Class DocumentsFactory
 * @package Components\Type\Documents
 */
class DocumentsFactory
{
    public static function create(): DocumentsModel
    {
        global $post;
        return new DocumentsModel($post);
    }
}
