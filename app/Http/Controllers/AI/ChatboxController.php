<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\Chatbox;
use Illuminate\Http\Request;
use App\Services\AI\AvalAIService;

class ChatboxController extends Controller
{
    protected AvalAIService $aiService;

    public function __construct(AvalAIService $aiService)
    {
        $this->aiService = $aiService;
    }
    public  function  index()
    {
        return response()->json(Chatbox::all());
    }

    public function ask(Request $request)
    {
        $question = $request->input('question');

        $allQuestions = Chatbox::all();
        $maxPercent = 0;
        $bestMatch = null;

        foreach ($allQuestions as $q) {
            similar_text(strtolower($q->question), strtolower($question), $percent);
            if ($percent > $maxPercent) {
                $maxPercent = $percent;
                $bestMatch = $q;
            }
        }

        if ($maxPercent > 50 && $bestMatch) {
            $answer = $bestMatch->answer;
        } else{
            $answer = $this->aiService->ask($question);
        }


        return response()->json(['answer' => $answer ]);

    }
}
