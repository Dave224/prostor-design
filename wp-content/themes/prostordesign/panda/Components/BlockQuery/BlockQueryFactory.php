<?php

namespace Components\BlockQuery;

/**
 * Class BlockQueryFactory
 * @package Components\BlockQuery
 */
class BlockQueryFactory
{

    public static function create($Count = BlockQuery::DEFAULT_COUNT): BlockQuery
    {
        return new BlockQuery($Count);
    }
}
