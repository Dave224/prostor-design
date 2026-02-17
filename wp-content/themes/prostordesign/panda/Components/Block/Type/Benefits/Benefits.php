<?php
use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\Benefits\BenefitsFactory;

$Benefits = BenefitsFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section usps-section <?= $Benefits->renderSectionSettingsClass(); ?> --bg-<?= $Benefits->getBackground(); ?>">
    <div class="container">

        <?php if ($Benefits->isParamsTitle() || $Benefits->isParamsContent()) { ?>
            <header class="base-header -mb-base">
                <?php if ($Benefits->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Benefits->getPostId(), $Benefits->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>

                <?php if ($Benefits->isParamsContent()) { ?>
                    <p class="base-header__perex usps-section__perex"><?= $Benefits->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($Benefits->isDynamicBenefitsField()) { ?>
            <ul class="usps-section__row">
                <?php foreach ($Benefits->getBenefitsCollection() as $Benefit) { ?>
                    <li class="usp-item">
                        <?php if (Util::issetAndNotEmpty($Benefit[1])) { ?>
                            <div class="usp-item__icon">
                                <?= $Benefit[1]; ?>
                            </div>
                        <?php } ?>
                        <div class="usp-item__content">
                            <?php if (Util::issetAndNotEmpty($Benefit[0])) { ?>
                                <h3 class="usp-item__title">
                                    <?= $Benefit[0]; ?>
                                </h3>
                            <?php } ?>
                            <?php if (Util::issetAndNotEmpty($Benefit[2])) { ?>
                                <p><?= $Benefit[2]; ?></p>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</section>
