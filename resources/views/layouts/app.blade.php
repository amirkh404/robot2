<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باشگاه مشتریان</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />

    <style>
        body {
            font-family: Vazir, sans-serif;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-white" 

    @if (session('success')) data-success="{{ session('success') }}" @endif
    @if (session('error')) data-error="{{ session('error') }}" @endif
>

<nav class="flex flex-col gap-4 p-4 bg-white shadow sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-center justify-between w-full sm:w-auto">
        <h1 class="text-xl font-bold text-indigo-700">باشگاه مشتریان</h1>

        <div class="flex gap-2 sm:hidden">
            @auth
                <form action="{{ route('logout') }}" method="post" class="inline">
                    @csrf
                    <button class="px-3 py-1 text-sm text-white bg-red-500 rounded-xl">خروج از حساب</button>
                </form>
            @else
                <a href="/register" class="px-3 py-1 text-sm text-white bg-indigo-600 rounded-xl">ثبت‌ نام</a>
                <a href="/login" class="px-3 py-1 text-sm text-white bg-indigo-600 rounded-xl">ورود</a>
                <form action="{{ route('assistant.index') }}" method="get" class="inline">
                    <button class="px-3 py-1 text-sm text-white bg-red-500 rounded-xl">ربات</button>
                </form>
            @endauth
        </div>
    </div>

    <form action="{{ route('products.search') }}" method="get" class="relative w-full sm:w-[350px]">
        <input type="text" name="q" autocomplete="off" placeholder="جستجو محصول..." 
               class="w-full py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <svg class="absolute w-5 h-5 text-indigo-600 -translate-y-1/2 pointer-events-none left-3 top-1/2" 
             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <div id="search-results" class="absolute z-50 hidden w-full mt-2 overflow-y-auto bg-white border border-gray-300 shadow-lg rounded-xl max-h-60"></div>
    </form>

    <div class="items-center hidden gap-2 sm:flex">
        @auth
            <form action="{{ route('logout') }}" method="post" class="inline">
                @csrf
                <button class="px-4 py-2 text-white transition-colors bg-red-500 rounded-xl hover:bg-indigo-700">
                    خروج از حساب
                </button>
            </form>
        @else
            <a href="/register" class="px-4 py-2 text-white transition-colors bg-indigo-600 rounded-xl hover:bg-indigo-700">
                ثبت‌نام
            </a>
            <a href="/login" class="px-4 py-2 text-white transition-colors bg-indigo-600 rounded-xl hover:bg-indigo-700">
                ورود
            </a>
        @endauth
    </div>
</nav>




    <main class="container flex-grow px-4 py-6 mx-auto">
        @yield('conetent')
    </main>

    <footer class="py-4 text-sm text-center text-gray-600 bg-white border-t backdrop-blur-sm">
        &copy; {{ date('Y') }} باشگاه مشتریان
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')


    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
</body>