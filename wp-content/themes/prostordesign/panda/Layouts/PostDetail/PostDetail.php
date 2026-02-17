<?php

use Components\Post\PostFactory;
use Components\SchemaGenerator\SchemaGenerator;

$Post = PostFactory::create();
SchemaGenerator::addModel($Post);

get_template_part(COMPONENTS_PATH . "Header/Header"); ?>

<section class="base-section">
    <div class="container">
        <div class="entry-content">
            <h1><?= $Post->getTitle(); ?></h1>
            <?= $Post->getContent(); ?>
        </div>
    </div>
</section>

<?php get_template_part(COMPONENTS_PATH . "Footer/Footer");
