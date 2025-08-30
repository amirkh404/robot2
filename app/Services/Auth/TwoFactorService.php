<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Sms\SmsServiceInterface;
use Illuminate\Support\Facades\Cache;

class TwoFactorService
{
    public function __construct(protected SmsServiceInterface $smsService) {}

    public function generateCode(string $phone): string
    {
        if (Cache::has('2fa_last_sent_' . $phone)) {
            return 'already_sent';
        }

        $code = rand(100000, 999999);

        cache::put('2fa_code_' . $phone, $code, now()->addMinutes(2));
        cache::put('2fa_last_sent_' . $phone, now(), now()->addSeconds(60));

        $this->smsService->sendCode($phone, (string) $code);

        return $code;
    }

    public function validateCode(string $phone, string $code): bool
    {
        $catchCode = Cache::get('2fa_code_' . $phone);
        return (string) $catchCode === (string) $code;
    }

    public function clearCode(string $phone): void
    {
        Cache::forget('2fa_code_' . $phone);
    }
}