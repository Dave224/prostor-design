<?php

use Components\Post\PostFactory;

$Post = PostFactory::create();
?>

<article class="search-results-item">
    <h2 class="search-result-heading article-heading">
        <a href="<?= $Post->getPermalink(); ?>">
            <span><?= $Post->getTitle(); ?></span>
            <span>(<?= $Post->getSingularName(); ?>)</span>
        </a>
    </h2>

    <p class="search-result-link small-text">
        <a href="<?= $Post->getPermalink(); ?>"><?= $Post->getPermalink(); ?></a>
    </p>

    <p><?= $Post->getExcerpt(true, 30); ?></p>
</article>
