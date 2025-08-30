<?php

use App\Http\Controllers\AI\ChatboxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Routing\Attributes\Middleware;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\AI\AIController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;

// انگار اون بخش مثلا /products/search میتون هر چیزی باشه

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/ajax-search', [ProductController::class, 'searchAjax'])->name('searchAjax');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users', [UserController::class, 'index2'])->name('users.users');
    Route::post('/users/{user}/points', [PointController::class, 'addPoints'])->name('users.points');
});
Route::middleware('auth')->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'showForm'])->name('two-factor.form');
    Route::post('/two-factor/send', [TwoFactorController::class, 'resend'])->name('two-factor.send');
    Route::post('/two-factor/verify', [TwoFactorController::class, 'verifyCode'])->name('two-factor.verify');
});
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/assistant', function () {
    return view('/assistant.index');
})->name('assistant.index');

//Route::post('/assistant/ask', [AIController::class, 'ask'])->name('chatbot.ask');;
Route::post('/assistant/analyze-image', [AIController::class, 'analyzeImage'])->name('assistant.analyzeImage');
//Route::post('/chatbot/ask', [ChatboxController::class, 'ask'])->name('chatbot.ask');


