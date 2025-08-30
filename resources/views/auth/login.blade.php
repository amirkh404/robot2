<title>عضویت در فروشگاه پوشاک ما</title>

@extends('layouts.guest')

@section('subtitle', 'خوش برگشتی!')

@section('conetent')
        <div class="p-6">
            <form action="{{ route('login') }}" method="post">
            @csrf

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label for="email" class="block text-sm text-right font-medium text-gray-700 mb-1">ایمیل</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}" 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus-border-indigo-500 transition-all">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm text-right font-medium text-gray-700 mb-1">رمز عبور</label>
                <input type="password" name="password" id="password" required 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus-border-indigo-500 transition-all">
            </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            <button type="submit" 
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition">
            ورود
            </button>
        </form>
        </div>
@endsection