<?php
use Components\Block\Type\IntroServices\IntroServicesFactory;

$IntroServices = IntroServicesFactory::create();
?>
<div class="popup-form --requestPopup">
    <div class="popup-form__block">
        <div class="contact-form__block">
            <?php if ($IntroServices->isFormTitle()) { ?>
                <h3 class="base-subheading">
                    <?= $IntroServices->getFormTitle(); ?>
                </h3>
            <?php } ?>
            <?php if ($IntroServices->isFormDesctiption()) { ?>
                <p class="contact-form__perex">
                    <?= $IntroServices->getFormDesctiption(); ?>
                </p>
            <?php } ?>
            <?php get_template_part(COMPONENTS_PATH . "Form/Form"); ?>
        </div>
        <span class="popup-form__cross"></span>
    </div>
</div>
