<?php

namespace App\Services\Sms;

use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;

class KavenegarService implements SmsServiceInterface
{
    protected KavenegarApi $api;
    protected string $templateName;

    public function __construct()
    {
        $this->api = new KavenegarApi(config('sms.kavenegar.api_key'));
        $this->templateName = config('sms.kavenegar.template_name');
    }

    public function sendCode(string $to, string $code): bool
    {
        try {
            $this->api->VerifyLookup(
                $to,
                $code,
                null,
                null,
                $this->templateName
            );
            return true;
        } catch (ApiException | HttpException) {
            return false;
        }
    }
}