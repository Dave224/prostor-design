<?php
use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\Steps\StepsFactory;

$Steps = StepsFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section steps-section <?= $Steps->renderSectionSettingsClass(); ?> --bg-<?= $Steps->getBackground(); ?>">
    <div class="container">

        <?php if ($Steps->isParamsTitle() || $Steps->isParamsContent()) { ?>
            <header class="base-header -mb-base">
                <?php if ($Steps->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Steps->getPostId(), $Steps->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>

                <?php if ($Steps->isParamsContent()) { ?>
                    <p class="base-header__perex steps-section__perex"><?= $Steps->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($Steps->isDynamicItemsField()) { ?>
            <ul class="steps-section__row">
                <?php foreach ($Steps->getItemsCollection() as $Item) { ?>
                    <?php if (Util::issetAndNotEmpty($Item[0])) { ?>
                        <li class="step-item">
                            <div class="step-item__counter">
                            </div>
                            <div class="step-item__content">
                                <h3 class="step-item__title">
                                    <?= $Item[0]; ?>
                                </h3>
                                <?php if (Util::issetAndNotEmpty($Item[1])) { ?>
                                    <p><?= $Item[1]; ?></p>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>

        <?php if ($Steps->isParamsButton()) { ?>
            <div class="steps-section__btn-wrapper">
                <a class="btn --primary steps-section__btn" href="<?= $Steps->getParamsButtonUrl(); ?>" <?php if ($Steps->isParamsButtonTarget()) { ?>target="_blank"<?php } ?>>
                    <span><?= $Steps->getParamsButtonText(); ?></span>
                </a>
            </div>
        <?php } ?>
    </div>
</section>
