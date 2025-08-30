<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;

interface AuthServiceInterface
{
    public function login(LoginRequest $request): bool;

    public function logout(): void;
}