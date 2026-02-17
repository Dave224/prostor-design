<?php
use Components\Product\Term\ProductCategoryFactory;

$ProductCategory = ProductCategoryFactory::create();
?>
<section class="base-section intro-section --p-top-0 --p-bottom-0 --gray-intro-bg">
    <div class="container ">
        <div class="intro-section__content">
            <header class="base-header intro-section__header">
                <h1 class="base-header__heading base-heading">
                    <?= $ProductCategory->getTitle(); ?>
                </h1>
                <?php if ($ProductCategory->isContent()) { ?>
                    <p class="base-header__perex">
                        <?= $ProductCategory->getContent(); ?>
                    </p>
                <?php } ?>
            </header>

            <?php if ($ProductCategory->isThumbnail()) { ?>
                <div class="intro-section__placeholder">
                    <?= $ProductCategory->renderThumbnail(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>