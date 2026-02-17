<?php

use Components\Form\FormConfig;
use Helpers\GoogleRecaptchaVerify;
use Components\ThemeSettings\ThemeSettingsFactory;
use Components\FastContactForm\FastContactFormFactory;
use Components\FastContactForm\FastContactFormConfig;

$Theme = ThemeSettingsFactory::create();
$FormPresenter = FastContactFormFactory::create(false);
$Form = $FormPresenter->getForm();
$Form->addAttrClass("contact-form");
$fieldset = $FormPresenter->getFieldset();
$Form->setEnctype("multipart/form-data");

/** @var \KT_Text_Field $NameField */
$NameField = $fieldset[FastContactFormConfig::NAME];
$NameField->setSanitizeValue(true);
$NameField->setAttrId("name");
$NameField->addAttrClass("contact-form__input");

/** @var \KT_Text_Field $PhoneField */
$PhoneField = $fieldset[FastContactFormConfig::PHONE];
$PhoneField->setSanitizeValue(true);
$PhoneField->setAttrId("phone");
$PhoneField->addAttrClass("contact-form__input");

/** @var \KT_Text_Field $HoneyField */
$HoneyField = $fieldset[KT_Contact_Form_Base_Config::HONEY];
$HoneyField->setSanitizeValue(true);

/** @var \KT_Text_Field $FavouriteField */
$FavouriteField = $fieldset[FormConfig::FAVOURITE];
$FavouriteField->setSanitizeValue(true);

?>

<?= $Form->getFormHeader(); ?>
<div class="contact-form__top">
    <div class="contact-form__input-block">
        <span class="contact-form__text">
            <span>*</span>
            <?php _e("Vaše jméno:", "PD_ADMIN_DOMAIN"); ?>
        </span>
        <?= $NameField->getField(); ?>
    </div>

    <div class="contact-form__input-block">
        <span class="contact-form__text">
            <?php _e("Váš telefon:", "PD_ADMIN_DOMAIN"); ?>
        </span>
        <?= $PhoneField->getField(); ?>
    </div>

</div>

<div class="contact-form__bottom">
    <div>
        <p>
            <?php _e("Položky označené", "PD_ADMIN_DOMAIN"); ?>
            <span>*</span>
            <?php _e("jsou povinné.", "PD_ADMIN_DOMAIN"); ?>
        </p>
        <p>
            <?php _e("Odesláním souhlasíte s", "PD_ADMIN_DOMAIN"); ?>
            <a href="<?= get_privacy_policy_url(); ?>">
                <?php _e("ochranou osobních údajů.", "PD_ADMIN_DOMAIN"); ?>
            </a>
        </p>
    </div>

    <button class="btn  --primary submitButton">
        <span><?php _e("Odeslat zprávu", "PD_ADMIN_DOMAIN"); ?></span>
    </button>
</div>
<div class="d-none">
    <?php if ($Theme->isRecaptchOnAndSet()) { ?>
        <?= GoogleRecaptchaVerify::renderInput(); ?>
    <?php } else { ?>
        <?= $fieldset[KT_Contact_Form_Base_Config::NONCE]->getField(); ?>
    <?php } ?>
    <?= $FavouriteField->getControlHtml(); ?>
    <?= $HoneyField->getField(); ?>
    <input type="hidden" name="emailToSend" value="<?php if ($Theme->isFormEmail()) { ?><?= $Theme->getFormEmail(); ?><?php } ?>" />
</div>
<?= $Form->getFormFooter(); ?>
