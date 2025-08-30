<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorRequest;
use App\Services\Auth\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function __construct(protected TwoFactorService $twoFactorService) {}

    public function showForm()
    {
        $phone = auth()->user()->phone;

        $result = $this->twoFactorService->generateCode($phone);

        if($result === 'already_sent'){
            session()->flash('info','کد قبلا ارسال شده است لطفا کمی صبر کنید');
        } else {
            session()->flash('info','کد تایید برای شما ارسال شد');
        }
        
        if(!session()->has('login_phone')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor');
    }

    public function resend()
    {
        $phone = session('login_phone');

        if(!$phone) return redirect()->route('phone.form');

        $result = $this->twoFactorService->generateCode($phone);

        if($result = 'already_sent'){
            return back()->with('info','کد قبلا ارسال شده است لطفا کمی صبر کنید');
        }

        $this->twoFactorService->generateCode($phone);
        return back();
    }

    public function verifyCode(TwoFactorRequest $request)
    {
        $phone = session('login_phone');
        $code = $request->get('code');

        if($this->twoFactorService->validateCode($phone, $code)){
           $this->twoFactorService->clearCode($phone);

            $user = Auth::user();
            session()->forget('login_phone');

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home')->with('success', 'با موفقیت وارد شدید.');
           }

        return back()->withErrors(['code' => 'کد وارد شده نادرست است.']);
    }
}
