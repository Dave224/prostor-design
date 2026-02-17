<?php

use Components\Post\PostFactory;

$Post = PostFactory::create();
?>

<article class="aside-posts-item">
    <a href="<?= $Post->getPermalink(); ?>">
        <?php if($Post->hasThumbnail()) { ?>
        <div class="aside-posts-item-img">
            <?= $Post->renderThumbnailGrid(); ?>
        </div>
        <?php } ?>

        <h3 class="aside-posts-item-heading"><?= $Post->getTitle(); ?></h3>

    </a>
</article>