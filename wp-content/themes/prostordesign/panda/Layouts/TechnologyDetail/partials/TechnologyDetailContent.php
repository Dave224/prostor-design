<?php

use Components\PersonQuery\PersonQueryFactory;
use Components\Technology\TechnologyFactory;

$Technology = TechnologyFactory::create();
$PersonQuery = PersonQueryFactory::createCard($Technology->getParamsPersonId());
?>

<section class="base-section  detail-section --divider">
    <div class="container ">
        <div class="row content-w-aside ">
            <div class="col-lg-7">

                <div class="entry-content detail-section-entry-content">
                    <?= $Technology->getContent(); ?>
                </div>

            </div>

            <?php if ($PersonQuery->hasPosts()) { ?>
                <?= $PersonQuery->thePosts(); ?>
            <?php } ?>

        </div>

    </div>
</section>
