<?php

namespace App\Services\AI;

interface AIServiceInterface
{
    public function ask(string $question): ?string;
    public function analyzeImage(string $imagePath): ?string;
}
