<?php

namespace Helpers;

use Utils\Util;

/**
 * Class GoogleRecaptchaVerify
 * @package Helpers
 */
class GoogleRecaptchaVerify
{
    const INPUT_NAME = "google-recaptcha-response-input";

    private $response;
    private $siteSecretKey;
    private $formSecretKey;

    public function __construct(string $siteSecretKey, string $formSecretKey)
    {
        $this->setSiteSecretKey($siteSecretKey);
        $this->setFormSecretKey($formSecretKey);
        $this->initResponse();

        if (Util::issetAndNotEmpty($this->getResponse()->score)) {
            \KT_Logger::info($this->getResponse()->score);
        }
    }

    public function isResponseValid(): bool
    {
        if ($this->getResponse()->success == true) {
            return $this->getResponse()->score > 0.5;
        }
        return false;
    }

    public static function isRecaptchaResponseInput(): bool
    {
        return Util::issetAndNotEmpty($_POST[self::INPUT_NAME]);
    }

    public static function getRecaptchaResponseInput(): string
    {
        return $_POST[self::INPUT_NAME];
    }

    public static function renderInput(): string
    {
        $inputName = self::INPUT_NAME;
        return "<input type='hidden' class='{$inputName}' name='{$inputName}'>";
    }

    private function initResponse(): void
    {
        $postData = [
            'secret' => $this->getSiteSecretKey(),
            'response' => $this->getFormSecretKey(),
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        $this->setResponse($response);
    }

    private function getResponse()
    {
        return $this->response;
    }

    private function setResponse($response): void
    {
        $this->response = $response;
    }


    private function getSiteSecretKey(): string
    {
        return $this->siteSecretKey;
    }

    private function getFormSecretKey(): string
    {
        return $this->formSecretKey;
    }

    private function setSiteSecretKey(string $siteSecretKey): void
    {
        $this->siteSecretKey = $siteSecretKey;
    }

    private function setFormSecretKey(string $formSecretKey): void
    {
        $this->formSecretKey = $formSecretKey;
    }
}
