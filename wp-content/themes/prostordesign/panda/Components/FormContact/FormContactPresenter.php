<?php

namespace Components\FormContact;

use Utils\Util;
use Helpers\GoogleRecaptchaVerify;
use PHPMailer\PHPMailer\PHPMailer;
use Components\ThemeSettings\ThemeSettingsFactory;

class FormContactPresenter extends \KT_Contact_Form_Base_Presenter
{
    const PROCESSED_PARAM = "form-contact-processed";
    const SENDER_NAME = "info";


    public function __construct($withProcessing = true)
    {
        parent::__construct(false);

        if ($withProcessing) {
            $this->process();
        }
    }

    // --- veřejné funkce ------------------------------

    public function process()
    {
        $Theme = ThemeSettingsFactory::create();

        if (\KT::arrayIssetAndNotEmpty($_POST) && array_key_exists(FormContactConfig::FORM_PREFIX, $_POST)) {
            $form = $this->getForm();
            if (!$form->nonceValidate()) {
                wp_die(__("Error processing resource addresses...", "KT_CORE_DOMAIN"));
                exit;
            }

            if ($Theme->isRecaptchOnAndSet() && GoogleRecaptchaVerify::isRecaptchaResponseInput()) {
                $recaptcha = new GoogleRecaptchaVerify($Theme->getRecaptchaSecretKey(), GoogleRecaptchaVerify::getRecaptchaResponseInput());
                if (!$recaptcha->isResponseValid()) {
                    add_action(KT_PROJECT_NOTICES_ACTION, [&$this, "renderRecaptchaNotice"]);
                    return;
                }
            } else {
                if (!$form->nonceValidate()) {
                    wp_die(__("Error processing resource addresses...", "KT_CORE_DOMAIN"));
                    exit;
                }
            }

            $form->validate();
            if (!$form->hasError()) {
                $values = filter_input(INPUT_POST, FormContactConfig::FORM_PREFIX, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                if (\KT::arrayIssetAndNotEmpty($values)) {
                    $spam = filter_var(\KT::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::FAVOURITE), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if (\KT::issetAndNotEmpty($spam)) {
                        wp_die(__("You filled out unauthorized control element...", "KT_CORE_DOMAIN"));
                        exit;
                    }

                    $honey = filter_var(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::HONEY), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $now = date("Y/m/d");
                    if ($honey !== "abcd1234-{$now}") {
                        wp_die(__("You filled out unauthorized control element...", "KT_CORE_DOMAIN"));
                        exit;
                    }

                    if ($this->processMail($values)) {
                        wp_redirect(add_query_arg($this->getProcessdParam(), "1", Util::getRequestUrl()));
                        exit;
                    }
                }
            }
            add_action(KT_PROJECT_NOTICES_ACTION, array(&$this, "renderErrorNotice"));
        }
    }


    // --- neveřejné funkce ------------------------------

    protected function processMail(array $values)
    {

        if (count($values) > 0) {
            $name = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::NAME));
            $email = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::EMAIL));
            $phone = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::PHONE));
            $message = htmlspecialchars(Util::arrayTryGetValue($values, \KT_Contact_Form_Base_Config::MESSAGE));

            if (Util::issetAndNotEmpty($name) && Util::issetAndNotEmpty($email) && is_email($email)) {
                $ktWpInfo = new \KT_WP_Info();
                $requestUrl = Util::getRequestUrl();
                $requestLink = "<a href=\"$requestUrl\">$requestUrl</a>";

                $hostName = parse_url($requestLink, PHP_URL_HOST);

                $content = sprintf(__("Jméno a Příjmení: %s", DOMAIN), $name) . "<br>";
                $content .= sprintf(__("E-mail: %s", DOMAIN), $email) . "<br>";
                $content .= sprintf(__("Telefon: %s", DOMAIN), $phone) . "<br>";
                $content .= __("Zpráva:", "BT_DOMAIN") . "<br><br>$message<br><br>";
                $content .= sprintf(__("Done by URL: %s", "KT_CORE_DOMAIN"), $requestLink) . "<br><br>---<br>";


                $content .= sprintf($this->getEmailSignature(), $ktWpInfo->getUrl());

                if (Util::issetAndNotEmpty($_POST["emailToSend"])) {
                    $contactFormEmail = $_POST["emailToSend"];
                } else {
                    $contactFormEmail = $this->getFormEmail();
                }

                $sender = self::SENDER_NAME . '@prostor-design.cz';

                $mailer = new PHPMailer();
                $mailer->CharSet = "UTF-8";
                $mailer->Encoding = 'base64';
                $mailer->ContentType = 'text/html';

                $mailer->setFrom($sender);
                $mailer->addAddress($contactFormEmail);
                $mailer->Body = html_entity_decode($content);
                $mailer->Subject = 'Zpráva z kontaktního formuláře';

                $msg = "";


                if (!$mailer->send()) {
                    $msg .= 'Mailer Error: ' . $mailer->ErrorInfo;
                } else {
                    $msg .= 'Message sent!';
                }

                $sendResult = $mailer->send();

                $this->logMailProcessed($sendResult, sprintf(__("E-mail for %s <%s> from URL %s done by: %s.", "KT_CORE_DOMAIN"), $name, $email, $requestUrl, $sendResult));
                return $sendResult;
            }
        }
        return false;
    }

    protected function initForm()
    {
        /* @var $form KT_Form */
        $form = parent::initForm();
        $form->setAction(Util::getRequestUrl());
        $form->setAttrId("contact-form");
        return $form;
    }

    public function getProcessdParam()
    {
        return self::PROCESSED_PARAM;
    }

    protected function initFieldset()
    {
        /** @var KT_Fieldset $fieldset */
        $fieldset = FormContactConfig::getFieldset();
        return $this->fieldset = $fieldset;
    }
}
