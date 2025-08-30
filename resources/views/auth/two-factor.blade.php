@extends('layouts.guest')

@section('subtitle', '')

@section('conetent')
    <div class="p-6">
        @if(session('error'))
        <div class="text-red-600 mb-4 text-sm text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('two-factor.verify') }}" method="post" id="otp-form">
            @csrf
            <div class="flex justify-center space-x-2 gap-2 mb-6" dir="ltr">
                @for ($i = 0; $i < 6; $i++)
                    <input type="text" name="code[]" maxlength="1" 
                    class="w-12 h-12 text-center text-xl border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-500 otp-input" 
                    required>
                @endfor
            </div>

            <input type="hidden" name="code" id="code">

            @error('code')
                <p class="text-red-600 mt-2 mb-2 text-center">{{ $message }}</p>
            @enderror

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">تایید</button>
        </form>

        <form action="{{ route('two-factor.send') }}" method="post" class="mt-4">
            @csrf
            <button type="submit" class="w-full mt-2 bg-white border border-indigo-600 font-medium text-indogo-600 px-4 py-2 rounded hover:bg-indigo-600 hover:text-white transition duration-200">ارسال مجدد کد</button>
        </form>
        @if(session('info') && !$errors->any())
            <div class="text-blue-600 text-sm text-center mt-2">
                {{ session('info') }}
            </div>
        @endif
    </div>

@push('scripts')
    <script src="{{ asset('js/otp.js') }}"></script>
    <script src="{{ asset('js/alerts.js') }}"></script>
@endpush
@endsection