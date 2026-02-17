<?php
use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\Gallery\GalleryFactory;

$Gallery = GalleryFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section gallery-slider-section <?= $Gallery->renderSectionSettingsClass(); ?> --bg-<?= $Gallery->getBackground(); ?>">
    <div class="container">

        <?php if ($Gallery->isParamsTitle() || $Gallery->isParamsContent()) { ?>
            <header class="base-header -mb-base">
                <?php if ($Gallery->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Gallery->getPostId(), $Gallery->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>

                <?php if ($Gallery->isParamsContent()) { ?>
                    <p class="base-header__perex"><?= $Gallery->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($Gallery->isDynamicImagesField()) { ?>
            <div class="splide gallery-slider-section__row gallery">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($Gallery->getImagesCollection() as $Image) { ?>
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

        <?php if ($Gallery->isParamsButton()) { ?>
            <div class="steps-section__btn-wrapper">
                <a class="btn --primary" href="<?= $Gallery->getParamsButtonUrl(); ?>" <?php if ($Gallery->isParamsButtonTarget()) { ?>target="_blank"<?php } ?>>
                    <span><?= $Gallery->getParamsButtonText(); ?></span>
                </a>
            </div>
        <?php } ?>
    </div>
</section>
