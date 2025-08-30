<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باشگاه مشتریان | ورود</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                        }
                    },
                    boxShadow: {
                        'form': '0 8px 32px rgba(99, 102, 241, 0.2)',
                    }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    <style>
        body { 
            font-family: Vazir, sans-serif;
        }
        .form-container {
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.8);
        }
        .input-focus:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.3);
        }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">


<div class="w-full max-w-md form-container rounded-2xl transition-all duration-300 shadow-lg">
    <div class="bg-gradient-to-l from-primary-500 to-primary-600 p-6 text-center">
    <h1 class="text-2xl font-bold text-white">
        @yield('title', 'باشگاه مشتریان')
    </h1>
    <p class="text-primary-100 mt-2 text-sm">
        @yield('subtitle', 'به خانواده ما بپیوندید')
    </p>
    </div>

    <div class="p-8">
        @yield('conetent')
    </div>

    <div class="border-t border-gray-400 p-4 text-center text-sm text-gray-600">
        @yield('footer', 'فروشگاه پوشاک ما | تمام حقوق محفوظ است')
    </div>
</div>

@stack('scripts')
</body>
</html>