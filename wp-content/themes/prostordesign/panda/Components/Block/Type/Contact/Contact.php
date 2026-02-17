<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\Contact\ContactFactory;

$Contact = ContactFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
$VariantPath = COMPONENTS_PATH . "Block/Type/Contact/variants/";
?>

<section class="base-section  contact-section <?= $Contact->renderSectionSettingsClass(); ?>">
    <div class="container ">
        <div class="row">
            <div class="col-lg-6">

                <?php if ($Contact->isParamsTitle()) { ?>
                    <header class="base-header -mb-base">
                        <?= $PageBlock->renderHeadline($Contact->getPostId(), $Contact->getParamsTitle(), "base-header__heading base-heading contact-section__heading"); ?>
                    </header>
                <?php } ?>

                <?php get_template_part($Contact->getSettingsPath()); ?>

            </div>

            <?php if ($Contact->isParamsImageId()) { ?>
                <div class="col-lg-6">
                    <div class="contact-section__img">
                        <div class="contact-section__img-placeholder">
                            <?= $Contact->renderImage(); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>
</section>
