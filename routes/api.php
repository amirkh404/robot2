<?php
use App\Http\Controllers\AI\ChatboxController;
use Illuminate\Support\Facades\Route;

Route::get('/test-api', function () {
    return response()->json(['status' => 'api.php is loaded']);
});

Route::prefix('chatbot')->group(function () {
    Route::get('/', [ChatboxController::class, 'index']);
    Route::post('/ask', [ChatboxController::class, 'ask']);
});
