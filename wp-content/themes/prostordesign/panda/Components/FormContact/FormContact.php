<?php

use Components\FormContact\FormContactConfig;
use Components\FormContact\FormContactFactory;
use Helpers\GoogleRecaptchaVerify;
use Components\ThemeSettings\ThemeSettingsFactory;
use Components\Block\Type\IntroServices\IntroServicesFactory;
use Layouts\TechnologyPage\TechnologyPageFactory;

$Theme = ThemeSettingsFactory::create();
$FormPresenter = FormContactFactory::create(false);
$Form = $FormPresenter->getForm();
$Form->addAttrClass("contact-form");
$fieldset = $FormPresenter->getFieldset();
$Form->setEnctype("multipart/form-data");


/** @var \KT_Text_Field $EmailField */
$EmailField = $fieldset[KT_Contact_Form_Base_Config::EMAIL];
$EmailField->setSanitizeValue(true);
$EmailField->setAttrId("name");
$EmailField->addAttrClass("contact-form__input");

/** @var \KT_Text_Field $NameField */
$NameField = $fieldset[KT_Contact_Form_Base_Config::NAME];
$NameField->setSanitizeValue(true);
$NameField->setAttrId("name");
$NameField->addAttrClass("contact-form__input");

/** @var \KT_Text_Field $PhoneField */
$PhoneField = $fieldset[KT_Contact_Form_Base_Config::PHONE];
$PhoneField->setSanitizeValue(true);
$PhoneField->setAttrId("phone");
$PhoneField->addAttrClass("contact-form__input");

/** @var \KT_Textarea_Field $MessageField */
$MessageField = $fieldset[KT_Contact_Form_Base_Config::MESSAGE];
$MessageField->setSanitizeValue(true);
$MessageField->setAttrId("text");
$MessageField->addAttrClass("contact-form__textarea");

/** @var \KT_Text_Field $FavouriteField */
$FavouriteField = $fieldset[FormContactConfig::FAVOURITE];
$FavouriteField->setSanitizeValue(true);

/** @var \KT_Text_Field $HoneyField */
$HoneyField = $fieldset[KT_Contact_Form_Base_Config::HONEY];
$HoneyField->setSanitizeValue(true);

$IntroServices = IntroServicesFactory::create();
$PageTech = TechnologyPageFactory::create();
?>

<?= $Form->getFormHeader(); ?>

<div class="contact-form__top">
    <div class="contact-form__input-block">
        <span class="contact-form__text">
            <?php _e("Vaše jméno:", "PD_ADMIN_DOMAIN"); ?>
            <span>*</span>
        </span>
        <?= $NameField->getField(); ?>
    </div>
    <div class="contact-form__input-block">
        <span class="contact-form__text">
            <?php _e("Váš email:", "PD_ADMIN_DOMAIN"); ?>
            <span>*</span>
        </span>
        <?= $EmailField->getField(); ?>
    </div>
    <div class="contact-form__input-block">
        <span class="contact-form__text">
            <?php _e("Váš telefon:", "PD_ADMIN_DOMAIN"); ?>
        </span>
        <?= $PhoneField->getField(); ?>
    </div>

</div>
<div class="contact-form__textarea-block">
    <span class="contact-form__text">
        <?php _e("Vaše zpráva:", "PD_ADMIN_DOMAIN"); ?>
    </span>
    <?= $MessageField->getField(); ?>
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
