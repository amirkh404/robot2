<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected AuthServiceInterface  $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
       return view('auth.login'); 
    }

    public function login(LoginRequest $request)
    {
        if($this->authService->login($request)) {
            $request->session()->regenerate();

            return redirect()->route('two-factor.form');
        }

        return back()->withErrors([
            'email' => 'اطلاعات ورود نادرست است',
        ]);
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();
        
        return redirect('/')->with('error', 'اکانت شما با موفقیت حذف گردید');
    }
}
