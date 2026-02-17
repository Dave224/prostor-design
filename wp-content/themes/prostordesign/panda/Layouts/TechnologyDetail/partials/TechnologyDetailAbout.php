<?php

use Components\Technology\TechnologyFactory;

$Technology = TechnologyFactory::create();
?>

<?php if ($Technology->isAboutTitle() || $Technology->isAboutImage()) { ?>
    <section class="base-section  text-and-picture-section --p-bottom-0">
        <div class="container ">

            <?php if ($Technology->isAboutTitle()) { ?>
                <header class="base-header  text-and-picture-section__heading">
                    <h2 class="base-header__heading base-heading">
                        <?= $Technology->getAboutTitle(); ?>
                    </h2>
                </header>
            <?php } ?>

            <div class="text-and-picture-section__content">

                <?php if ($Technology->isAboutTitle()) { ?>
                    <div class="text-and-picture-section__text">
                        <div class="entry-content">
                            <?= $Technology->getAboutDesc(); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($Technology->isAboutImage()) { ?>
                    <div class="text-and-picture-section__picture">
                        <div class="text-and-picture-section__width">
                            <div class="text-and-picture-section__placeholder">
                                <?= $Technology->renderAboutImage(); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
<?php } ?>
