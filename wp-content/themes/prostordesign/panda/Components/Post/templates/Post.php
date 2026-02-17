<?php

use Components\Post\PostFactory;
use Utils\Svg;
use Utils\Image;

$Post = PostFactory::create(); ?>

<article class="event-item">
    <?php if($Post->hasThumbnail()) { ?>
        <a href="<?= $Post->getPermalink(); ?>" class="event-item-img">
            <?= $Post->renderThumbnail(); ?>
        </a>
    <?php } ?>
    <div class="event-item-content">
        <header>
            <h2 class="article-heading">
                <a href="<?= $Post->getPermalink(); ?>">
                    <?= $Post->getTitle(); ?>
                </a>
            </h2>
            <?= $Post->getExcerpt(true, 20); ?>
        </header>
        <div class="event-item-bottom-content">
            <div>
                <?= Svg::renderSvg("calendar"); ?>
                <span><?= $Post->getPublishDate(); ?></span>
            </div>
            <div>
                <?= Svg::renderSvg("person"); ?>
                <span><?= $Post->getPostAuthorName(); ?></span>
            </div>
            <a href="<?= $Post->getPermalink(); ?>" class="event-item-more-info">
                <span><?php _e("Více", "PD_DOMAIN"); ?></span>
                <img src="" data-src="<?= Image::imageGetUrlFromTheme("ico/arrow-blue.svg"); ?>" alt="" aria-hidden="true" draggable="false">
            </a>
        </div>
    </div>
</article>
