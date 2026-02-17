<?php

namespace Components\BlockQuery;

use Components\Block\Block;
use Components\Block\BlockFactory;
use Presenters\QueryBase;

/**
 * Class BlockQuery
 * @package Components\BlockQuery
 */
class BlockQuery extends QueryBase
{

    public function __construct($maxCount = self::DEFAULT_COUNT)
    {
        parent::__construct();
        $this->setComponent(Block::class);
        $this->setPostType(Block::KEY);
        $this->setTemplate(Block::TEMPLATE);
        $this->setMaxCount($maxCount);
        $this->initArgs();
    }

    public function getBlocks(): array
    {
        $Blocks = [];
        foreach ($this->getPosts() as $Item) {
            global $post;
            $post = $Item;
            $CurentBlock = BlockFactory::createById();
            if ($CurentBlock->isTypeSelect() && $CurentBlock->isTypeClassExist()) {
                array_push($Blocks, $CurentBlock->getBlockAdmin());
            }
        }

        return $Blocks;
    }


    // Custom Args for Query
    public function initArgs()
    {
        $Args = [
            "post_type"      => $this->getPostType(),
            "post_status"    => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby"        => "date",
            "order"          => \KT_Repository::ORDER_DESC,
        ];

        return $this->setArgs($Args);
    }
}
