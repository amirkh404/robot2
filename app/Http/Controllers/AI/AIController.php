<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AI\AIServiceInterface;

class AIController extends Controller
{
    protected AIServiceInterface $aiService;

    public function __construct(AIServiceInterface $aiService)
    {
        $this->aiService = $aiService;
    }

    public function ask(Request $request)
    {
        $question = $request->input('question');

        $answer = $this->aiService->ask($question);

        if (!$answer) {
            return response()->json([
                'error' => 'مشکلی در ارتباط با سرویس هوش مصنوعی پیش آمد.'
            ], 500);
        }

        return response()->json([
            'question' => $question,
            'answer' => $answer]);
    }

    public function analyzeImage(Request $request)
    {
        $image = $request->file('image')->store('uploads');

        $description = $this->aiService->analyzeImage($image);

        if (!$description) {
            return response()->json([
                'error' => 'مشکلی در پردازش تصویر رخ داد.'
            ], 500);
        }

        return response()->json(['description' => $description]);
    }
}
