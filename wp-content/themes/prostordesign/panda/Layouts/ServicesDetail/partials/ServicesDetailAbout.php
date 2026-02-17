<?php

use Components\Services\ServicesFactory;

$Service = ServicesFactory::create();
?>

<?php if ($Service->isAboutTitle() || $Service->isAboutImage()) { ?>
    <section class="base-section  text-and-picture-section">
        <div class="container ">

            <?php if ($Service->isAboutTitle()) { ?>
                <header class="base-header  text-and-picture-section__heading">
                    <h2 class="base-header__heading base-heading">
                        <?= $Service->getAboutTitle(); ?>
                    </h2>
                </header>
            <?php } ?>

            <div class="text-and-picture-section__content">

                <?php if ($Service->isAboutTitle()) { ?>
                    <div class="text-and-picture-section__text">
                        <div class="entry-content">
                            <?= $Service->getAboutDesc(); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($Service->isAboutImage()) { ?>
                    <div class="text-and-picture-section__picture">
                        <div class="text-and-picture-section__width">
                            <div class="text-and-picture-section__placeholder">
                                <?= $Service->renderAboutImage(); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
<?php } ?>
