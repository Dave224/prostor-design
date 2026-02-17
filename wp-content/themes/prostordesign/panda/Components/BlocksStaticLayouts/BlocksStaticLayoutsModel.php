<?php

namespace Components\BlocksStaticLayouts;

use Components\Block\BlockFactory;
use KT_WP_Options_Base_Model;
use Utils\Util;

class BlocksStaticLayoutsModel extends KT_WP_Options_Base_Model
{
    public function __construct()
    {
        parent::__construct(BlocksStaticLayoutsConfig::FORM_PREFIX);
    }

    public function loopBlocks($BlockExtraId = null, $InputKey = null)
    {
        foreach ($this->getBlockIdsToArray($InputKey) as $BlockId) {
            $BlockPath = BlockFactory::getBlockPathById($BlockId);
            if ($BlockPath === "") {
                continue;
            }

            if (Util::issetAndNotEmpty($BlockExtraId)) {
                $BlockId = $BlockExtraId;
            }

            $Block = get_post($BlockId);
            global $post;
            $post = $Block;
            get_template_part($BlockPath);
        }
    }

    //* --- getry & setry ------------------------

    public function getBlocksIds($InputKey)
    {
        $BlocksIds = get_option($InputKey);
        return $BlocksIds;
    }

    public function getBlockIdsToArray($InputKey)
    {
        return $BlocksIds = explode(",", $this->getBlocksIds($InputKey));
    }

    //* --- issety ---------------------------

    public function isBlocks ($InputKey): bool
    {
        return Util::issetAndNotEmpty($this->getBlocksIds($InputKey));
    }
}
