<?php
use Components\Person\PersonFactory;

$Person = PersonFactory::create();
?>

<li class="col-sm-6 col-md-4 col-xl-3 team-section__list-item ">
    <div class="contact-person --center">
        <div class="contact-person__left">
            <?php if ($Person->hasThumbnail()) { ?>
                <div class="contact-person__img">
                    <?= $Person->renderThumbnail(); ?>
                </div>
            <?php } ?>

            <div class="contact-person__name ">
                <h3 class="large-text">
                    <?= $Person->getTitle(); ?>
                </h3>

                <?php if ($Person->isParamsPosition()) { ?>
                    <p class="contact-person__position">
                        <?= $Person->getParamsPosition(); ?>
                    </p>
                <?php } ?>
            </div>
        </div>

        <?php if ($Person->isParamsDesc()) { ?>
            <p class="contact-person__perex">
                <?= $Person->getParamsDesc(); ?>
            </p>
        <?php } ?>
    </div>
</li>