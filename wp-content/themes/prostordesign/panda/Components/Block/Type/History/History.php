<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\History\HistoryFactory;
use Utils\Util;

$History = HistoryFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>

<section class="base-section  timeline-section <?= $History->renderSectionSettingsClass(); ?>">
    <div class="container ">

        <?php if ($History->isParamsTitle()) { ?>
            <header class="base-header -mb-base">
                <?= $PageBlock->renderHeadline($History->getPostId(), $History->getParamsTitle(), "base-header__heading base-heading timeline-section__heading"); ?>
            </header>
        <?php } ?>

        <?php if ($History->isTimelineField()) { ?>
            <ul class="timeline-section__list">
                <?php foreach ($History->getTimelineCollection() as $TimelineItem) { ?>
                    <li class="timleine-item --small">
                        <?php if (Util::issetAndNotEmpty($TimelineItem[0])) { ?>
                            <h3 class="timleine-item__year base-heading">
                                <?= $TimelineItem[0]; ?>
                            </h3>
                        <?php } ?>

                        <?php if (Util::issetAndNotEmpty($TimelineItem[1]) || Util::issetAndNotEmpty($TimelineItem[2])) { ?>
                            <div class="timleine-item__content">

                                <?php if (Util::issetAndNotEmpty($TimelineItem[1])) { ?>
                                    <h4 class="timleine-item__title large-text">
                                        <?= $TimelineItem[1]; ?>
                                    </h4>
                                <?php } ?>

                                <?php if (Util::issetAndNotEmpty($TimelineItem[2])) { ?>
                                    <p class="timleine-item__perex">
                                        <?= $TimelineItem[2]; ?>
                                    </p>
                                <?php } ?>

                            </div>
                        <?php } ?>

                    </li>
                <?php } ?>
            </ul>
        <?php } ?>

    </div>
</section>
