<?php

use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\AboutCompany\AboutCompanyFactory;

$AboutCompany = AboutCompanyFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section  about-us-section <?= $AboutCompany->renderSectionSettingsClass(); ?> --bg-dark  --animated">
    <div class="container ">
        <div class="about-us-section__row">

            <div class="about-us-section__left-block">
                <?php if ($AboutCompany->isParamsTitle() || $AboutCompany->isParamsContent()) { ?>
                    <header class="base-header -mb-base">
                        <?php if ($AboutCompany->isParamsTitle()) { ?>
                            <?= $PageBlock->renderHeadline($AboutCompany->getPostId(), $AboutCompany->getParamsTitle(), "base-header__heading base-heading about-us-section__heading"); ?>
                        <?php } ?>
                        <?php if ($AboutCompany->isParamsSubtitle()) { ?>
                            <p class="base-header__perex "><?= $AboutCompany->getParamsSubtitle(); ?></p>
                        <?php } ?>
                    </header>
                <?php } ?>

                <?php if ($AboutCompany->isParamsContent()) { ?>
                    <div class="entry-content">
                        <?= $AboutCompany->getParamsContent(); ?>
                    </div>
                <?php } ?>

                <?php if ($AboutCompany->isBenefitsField()) { ?>
                    <ul class="about-us-section__advantages">

                        <?php foreach ($AboutCompany->getBenefits() as $Benefit) { ?>
                            <li class="about-us-section__advantage large-text">
                                <?php if (Util::issetAndNotEmpty($Benefit[1])) { ?>
                                    <?= $Benefit[1]; ?>
                                <?php } ?>
                                <span><?= $Benefit[0]; ?></span>
                            </li>
                        <?php } ?>

                    </ul>
                <?php } ?>

            </div>

            <div class="about-us-section__right-block">
                <div class="about-us-section__people-block">

                    <?php if ($AboutCompany->isPersonDesc()) { ?>
                        <p class="about-us-section__people-text">
                            <?= $AboutCompany->getPersonDesc(); ?>
                        </p>
                    <?php } ?>

                    <div class="about-us-section__people">

                        <?php if ($AboutCompany->isPersonImageId()) { ?>
                            <div class="about-us-section__people-img">
                                <?= $AboutCompany->renderPersonImageId(); ?>
                            </div>
                        <?php } ?>

                        <?php if ($AboutCompany->isPersonName()) { ?>
                            <h3 class="about-us-section__people-name base-text"><?= $AboutCompany->getPersonName(); ?></h3>
                        <?php } ?>

                        <?php if ($AboutCompany->isPersonPosition()) { ?>
                            <span class="about-us-section__people-job"><?= $AboutCompany->getPersonPosition(); ?></span>
                        <?php } ?>

                    </div>
                </div>
                <?php if ($AboutCompany->isParamsImageId()) { ?>
                    <div class="about-us-section__background-img">
                        <?= $AboutCompany->renderParamsImageId(); ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($AboutCompany->isParamsButtonText() && $AboutCompany->isParamsButtonUrl()) { ?>
                <div class="about-us-section__button-block">
                    <a href="<?= $AboutCompany->getParamsButtonUrl(); ?>" class="btn  --primary">
                        <span>
                            <?= $AboutCompany->getParamsButtonText(); ?>
                        </span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
