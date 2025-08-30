<?php

namespace App\Services\Sms;

interface SmsServiceInterface
{
    public function sendCode(string $to, string  $code): bool;
}