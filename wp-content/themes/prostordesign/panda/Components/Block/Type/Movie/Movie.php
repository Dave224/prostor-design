<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\Movie\MovieFactory;
use Utils\Image;

$Movie = MovieFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section  video-section <?= $Movie->renderSectionSettingsClass(); ?>">
    <div class="container ">
        <?php if ($Movie->isParamsTitle() || $Movie->isParamsContent()) { ?>
            <header class="base-header -mb-base">
                <?php if ($Movie->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Movie->getPostId(), $Movie->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>
                <?php if ($Movie->isParamsContent()) { ?>
                    <p class="base-header__perex "><?= $Movie->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($Movie->isParamsMovieUrl() || $Movie->isParamsMovieId()) { ?>
            <div class="video-section__video">
                <img class="video-section__spinner" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/spinner.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                <img class="video-section__play-button" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/play-button.svg"); ?>" alt="" draggable="false" aria-hidden="true">
                <?php if ($Movie->isParamsMovieImage()) { ?>
                    <?= $Movie->renderImage(); ?>

                    <?php if ($Movie->isParamsMovieUrl()) { ?>
                        <iframe <?= $Movie->getMovieSrc(); ?> allowfullscreen="allowfullscreen" title="" frameborder="0" allow="autoplay"></iframe>
                    <?php } elseif ($Movie->isParamsMovieId()) { ?>
                        <video class="" loop="loop" autoplay="autoplay" muted="muted" <?= $Movie->getParamsMovieSrc(); ?> type="video/mp4"></video>
                    <?php } ?>

            </div>
        <?php } ?>

    </div>
</section>
<?php } ?>
