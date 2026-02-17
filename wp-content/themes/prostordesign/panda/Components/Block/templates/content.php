<?php

use Layouts\Block\BlockFactory;

$PageBlock = BlockFactory::create(); ?>

<section class="entry-content-section base-section ">
    <div class="container">
        <div class="entry-content">
            <?= $PageBlock->getContent(); ?>
        </div>
    </div>
</section>
