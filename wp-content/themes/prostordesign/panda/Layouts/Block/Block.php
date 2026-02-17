<?php

use Layouts\Block\BlockFactory;

$PageBlock = BlockFactory::create();

get_template_part(COMPONENTS_PATH . "Header/Header"); ?>


<?php $PageBlock->loopBlocks(); ?>


<?php get_template_part(COMPONENTS_PATH . "Footer/Footer"); ?>
