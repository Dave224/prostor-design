<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\Partners\PartnersFactory;

$Partners = PartnersFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section  partners-section <?= $Partners->renderSectionSettingsClass(); ?> --bg-<?= $Partners->getBackground(); ?>">
    <div class="container ">

        <?php if ($Partners->isParamsTitle() || $Partners->isParamsContent()) { ?>
            <header class="base-header -mb-base">
                <?php if ($Partners->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Partners->getPostId(), $Partners->getParamsTitle(), "base-header__heading base-heading partners-section__heading"); ?>
                <?php } ?>

                <?php if ($Partners->isParamsContent()) { ?>
                    <p class="base-header__paragraph"><?= $Partners->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($Partners->isDynamicPartnerField()) { ?>
            <ul class="partners-section__logo-list">
                <?php foreach ($Partners->getPartnersCollection() as $Partner) { ?>
                    <li class="partners-section__item">
                        <a class="partners-section__logo" href="<?= $Partner[2]; ?>" target="_blank">
                            <?= $Partner[1]; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>

    </div>
</section>
