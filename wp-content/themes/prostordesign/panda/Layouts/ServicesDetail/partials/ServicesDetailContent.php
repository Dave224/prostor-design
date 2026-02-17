<?php

use Components\PersonQuery\PersonQueryFactory;
use Components\Services\ServicesFactory;
use Components\Technology\TechnologyFactory;
use Utils\Image;
use Utils\Util;

$Service = ServicesFactory::create();
$PersonQuery = PersonQueryFactory::createCard($Service->getParamsPersonId());
$Technology = "";
if ($Service->isParamsTechnologyId()) {
    $Technology = TechnologyFactory::createById($Service->getParamsTechnologyId());
}
?>

<section class="base-section  detail-section --p-bottom-0">
    <div class="container ">
        <div class="row content-w-aside ">
            <div class="col-lg-7">

                <div class="entry-content detail-section-entry-content">
                    <?= $Service->getContent(); ?>
                </div>

                <?php if (Util::issetAndNotEmpty($Technology)) { ?>
                    <div class="detail-entry-content-block">
                        <div class="entry-content">
                            <h2>
                                <?= $Technology->getTitle(); ?>
                            </h2>
                            <?= $Technology->getExcerpt(); ?>
                        </div>

                        <a href="<?= $Technology->getPermalink(); ?>" class="btn --primary">
                            <span>
                                <?php _e("více informací", "PD_ADMIN_DOMAIN"); ?>
                            </span>
                            <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" draggable="false" />
                        </a>
                    </div>
                <?php } ?>

            </div>

            <?php if ($PersonQuery->hasPosts()) { ?>
                <?= $PersonQuery->thePosts(); ?>
            <?php } ?>

        </div>

        <?php if (Util::issetAndNotEmpty($Technology)) { ?>
            <div class="detail-section__placeholder">
                <?php if ($Technology->hasThumbnail()) { ?>
                    <div class="detail-section__img">
                        <?= $Technology->renderWideThumbnail(); ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

    </div>
</section>
