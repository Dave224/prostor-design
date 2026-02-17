<?php

namespace Components\Block\Type\History;


/**
 * Class HistoryFactory
 * @package Components\Type\History
 */
class HistoryFactory
{
    public static function create(): HistoryModel
    {
        global $post;
        return new HistoryModel($post);
    }
}
