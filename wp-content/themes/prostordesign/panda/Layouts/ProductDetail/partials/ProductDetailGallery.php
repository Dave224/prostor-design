<?php

use Components\Product\ProductFactory;

$Product = ProductFactory::create();
?>

<div class="product-detail-gallery gallery">

    <?php if ($Product->hasThumbnail()) { ?>
        <div class="product-detail-gallery__main">
            <div class="gallery-item gallery-img-item">
                <div class="gallery-icon">
                    <a href="<?= $Product->renderGalleryDetailImageSrc($Product->getThumbnailId()); ?>">
                        <?= $Product->renderThumbnail(); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($Product->isGalleryImages()) { ?>

        <?php
        $galleryFirstFour = array_slice($Product->getGalleryImages(), 0, 4);
        $galleryRest = array_slice($Product->getGalleryImages(), 4);
        ?>

        <ul class="product-detail-gallery__list">
            <?php foreach ($galleryFirstFour as $GalleryImage) { ?>
                <li class="product-detail-gallery__item">
                    <div class="gallery-item gallery-img-item">
                        <div class="gallery-icon">
                            <a href="<?= $GalleryImage["ImageUrl"]; ?>" data-thumb="<?= $GalleryImage["ImageUrl"]; ?>">
                                <?= $GalleryImage["ImageRender"]; ?>
                            </a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php foreach ($galleryRest as $GalleryImage) { ?>
                <li class="product-detail-gallery__item" style="display:none;">
                    <div class="gallery-item gallery-img-item">
                        <div class="gallery-icon">
                            <a href="<?= $GalleryImage["ImageUrl"]; ?>" data-thumb="<?= $GalleryImage["ImageUrl"]; ?>"></a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
