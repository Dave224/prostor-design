<?php

use Components\Technology\TechnologyFactory;
use Components\ThemeSettings\ThemeSettingsFactory;

$Technology = TechnologyFactory::create();
$Theme = ThemeSettingsFactory::create();
?>

<div class="popup-form --requestPopup">
    <div class="popup-form__block">

        <div class="contact-form__block">

            <?php if ($Theme->isFormSettingsTechnologyTitle()) { ?>
                <h3 class="base-subheading">
                    <?= $Theme->getFormSettingsTechnologyTitle(); ?>
                </h3>
            <?php } ?>
            <?php if ($Theme->isFormSettingsTechnologyDesc()) { ?>
                <p class="contact-form__perex">
                    <?= $Theme->getFormSettingsTechnologyDesc(); ?>
                </p>
            <?php } ?>

            <?php get_template_part(COMPONENTS_PATH . "Form/Form"); ?>
        </div>
        <span class="popup-form__cross"></span>
    </div>
</div>


<div class="fast-contact-form popup-form --requestPopup">
    <div class="popup-form__block">

        <div class="contact-form__block">
            <h3 class="base-subheading">
                <?php _e("Zavolejte mi", "PD_ADMIN_DOMAIN"); ?>
            </h3>
            <p class="contact-form__perex">
                <?php _e("Zavoláme Vám a nic nemusíte řešit...", "PD_ADMIN_DOMAIN"); ?>
            </p>
            <?php get_template_part(COMPONENTS_PATH . "FastContactForm/FastContactForm"); ?>
            <span class="popup-form__cross"></span>
        </div>
    </div>
</div>
