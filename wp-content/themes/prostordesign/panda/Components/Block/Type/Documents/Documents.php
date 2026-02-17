<?php
use Utils\Image;
use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\Documents\DocumentsFactory;

$Documents = DocumentsFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section documents-section <?= $Documents->renderSectionSettingsClass(); ?> --bg-<?= $Documents->getBackground(); ?>">
    <div class="container">

        <?php if ($Documents->isParamsTitle() || $Documents->isParamsContent()) { ?>
            <header class="base-header -mb-base">
                <?php if ($Documents->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Documents->getPostId(), $Documents->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>

                <?php if ($Documents->isParamsContent()) { ?>
                    <p class="base-header__perex documents-section__perex"><?= $Documents->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($Documents->isDynamicItemsField()) { ?>
            <ul class="documents-section__row">
                <?php foreach ($Documents->getItemsCollection() as $Document) { ?>
                    <?php if (Util::issetAndNotEmpty($Document[1])) { ?>
                        <div class="document-item">
                            <img class="document-item__icon" src="<?= Image::imageGetUrlFromTheme('svg/document.svg')?>" width="40" height="40">
                            <?php if (Util::issetAndNotEmpty($Document[0])) { ?>
                                <div class="document-item__body">
                                    <span class="document-item__title">
                                        <?= $Document[0]; ?>
                                    </span>
                                    <span class="document-item__metadata"><?= $Document[2]; ?>, <?= $Document[3]; ?></span>
                                </div>
                            <?php } ?>
                            <a class="btn --primary --icon-only document-item__btn" href=" <?= $Document[1]; ?>" target="_blank" title="<?php _e('Stáhnout', 'PD_DOMAIN'); ?>">
                                <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme('svg/download.svg')?>" alt="{{ pro" draggable="false"/>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</section>
