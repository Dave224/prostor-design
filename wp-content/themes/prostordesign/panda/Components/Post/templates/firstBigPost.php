<?php
use Components\Post\PostFactory;
use Utils\Svg;

$Post = PostFactory::create();
?>

<article class="posts-item blog-left-side">
    <?php if($Post->hasThumbnail()) { ?>
        <div class="img-part">
            <a class="posts-item-img" href="<?= $Post->getPermalink(); ?>">
                <?= $Post->renderBigPostThumbnail(); ?>
            </a>
            <span class="date"><?= $Post->getPublishDate(); ?></span>
        </div>
    <?php } ?>

    <div class="text-part">

        <h2 class="posts-item-heading">
            <a href="<?= $Post->getPermalink(); ?>">
                <?= $Post->getTitle(); ?>
            </a>
        </h2>

        <div class="posts-item-text-perex">
            <?= $Post->getExcerpt(true, 20); ?>
        </div>
        <div class="to-read">
            <a href="<?= $Post->getPermalink(); ?>">
                <span><?php _e("Přečíst článek", "PD_DOMAIN"); ?></span>
                <?= Svg::renderSvg("arrow-blue"); ?>
            </a>
        </div>
    </div>
</article>
