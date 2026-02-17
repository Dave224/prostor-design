<?php

use Components\Services\ServicesFactory;

$Service = ServicesFactory::create();
?>

<section class="base-section --bg-dark gallery-slider-section">
    <div class="container ">

        <?php if ($Service->isGalleryTitle() || $Service->isGalleryDesc()) { ?>
            <header class="base-header -mb-base">

                <?php if ($Service->isGalleryTitle()) { ?>
                    <h2 class="base-header__heading base-heading">
                        <?= $Service->getGalleryTitle(); ?>
                    </h2>
                <?php } ?>

                <?php if ($Service->isGalleryDesc()) { ?>
                    <p class="base-header__perex ">
                        <?= $Service->getGalleryDesc(); ?>
                    </p>
                <?php } ?>

            </header>
        <?php } ?>

        <?php if ($Service->isGalleryCollection()) { ?>
            <div class="splide gallery-slider-section__row gallery">
                <div class="splide__track">
                    <ul class="splide__list">

                        <?php foreach ($Service->getGalleryImages() as $Image) { ?>
                            <li class="splide__slide ">
                                <div class="gallery-item gallery-img-item">
                                    <div class="gallery-icon">
                                        <a href="<?= $Image[1]; ?>" data-thumb="<?= $Image[1]; ?>">
                                            <?= $Image[0]; ?>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        <?php } ?>

    </div>
</section>
