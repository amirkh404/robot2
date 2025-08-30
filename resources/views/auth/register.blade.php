@extends('layouts.guest')

@section('conetent')
    <div class="p-6">
        <form action="{{ route('register') }}" method="post">
            @csrf

            <div class="mb-5">
                <label for="name" class="block text-sm text-right font-medium text-gray-700 mb-1">نام</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}" 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus-border-indigo-500 transition-all">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm text-right font-medium text-gray-700 mb-1">ایمیل</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}" 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus-border-indigo-500 transition-all">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm text-right font-medium text-gray-700 mb-1">شماره تلفن</label>
                <input type="phone" name="phone" id="phone" required value="{{ old('phone') }}" 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus-border-indigo-500 transition-all">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm text-right font-medium text-gray-700 mb-1">رمز عبور</label>
                <input type="password" name="password" id="password" required 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus-border-indigo-500 transition-all">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm text-right font-medium text-gray-700 mb-1">تکرار رمز عبور</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus-border-indigo-500 transition-all">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
            class="w-full bg-gradient-to-l from-indigo-600 to-purple-600 text-white py-3 px-4 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md hover:shadow-lg">
            ثبت نام
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            قبلاً حساب دارید؟
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">وارد شوید</a>
        </div>
    </div>
@endsection