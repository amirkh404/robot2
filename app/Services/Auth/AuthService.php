<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthService implements AuthServiceInterface
{
    public function login(LoginRequest $request): bool
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            session(['login_phone' => auth()->user()->phone]);
            return true;
        }
        return false;
    }
    
    public function logout(): void
    {
        Auth::logout();
    }
}