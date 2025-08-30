<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AvalAIService implements AIServiceInterface
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiUrl = "https://api.avalai.ir/v1/chat/completions";
        $this->apiKey = env('AVALAI_API_KEY');
    }

    /**
     * ارسال سوال متنی به AI
     */
    public function ask(string $question): ?string
    {
        try {
            $productResponse = Http::withoutVerifying()->get('https://ghabileh-style.com/api/products-torob/torob/');
            $products = $productResponse->successful() ? $productResponse->json()['data']: [] ;

            $searchTerm = mb_strtolower($question, 'UTF-8');

            $filteredProducts = collect($products)->filter(function ($p) use ($searchTerm) {
                return Str::contains(mb_strtolower($p['name'], 'UTF-8'), $searchTerm);
            });

            if ($filteredProducts->isEmpty()) {
                $filteredProducts = collect($products);
            }

            $sortedProducts = $filteredProducts->sortByDesc(function ($p) {
                return $p['availability'] === 'instock' ? 1 : 0;
            });

            $productSummary = "";
            foreach ($sortedProducts as $index => $p) {
                $status = $p['availability'] === 'instock' ? 'ناموجود' : 'موجود';
                $productSummary .= ($index+1) . ". نام: {$p['name']} | قیمت: {$p['price']} | وضعیت: {$status} | لینک: {$p['page_url']}\n";
            }


            $response = Http::withoutVerifying()
                ->withToken($this->apiKey)
                ->post($this->apiUrl, [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "شما یک دستیار هوشمند فروشگاه آنلاین هستید.
                            اطلاعات محصولات فروشگاه به شرح زیر است:
                            {$productSummary}

                            🎯 نقش شما:
                            1. معرفی و توضیح محصولات بر اساس اطلاعات موجود.
                            2. کمک به مشتری در انتخاب محصول مناسب (اندازه، رنگ، مدل، قیمت).
                            3. پاسخ به سوالات مربوط به خرید، روش پرداخت، ارسال و مرجوعی.
                            4. پیشنهاد محصول مشابه یا مکمل اگر مشتری چیزی در دسترس پیدا نکرد.
                            5. اگر سوالی خارج از فروشگاه پرسیده شد یا نتوانستید جواب دهید، مودبانه بگو:
برای دریافت پاسخ، می‌توانید در ساعات کاری ۹ تا ۱۷ با شماره‌های پشتیبانی ۰۹۱۲۳۴۵۶۷۸۹ یا ۰۹۱۲۳۴۵۶۷۹۰ تماس بگیرید.
                            6. وقتی کاربر درباره یک دسته کلی یا محصولی عمومی سوال پرسید (مثلاً: «ساحلی چی دارید؟»، «دامن موجود داری؟») فقط لیست نام محصول و لینک آن را بده.
                               -  فرمت دقیق پاسخ : < نام محصول | https://example.com/...>
                               - ❌ از هیچ علامت [ ] یا ( ) یا کلمه لینک استفاده نکن.
                               - ✅ فقط متن ساده: نام محصول | آدرس اینترنتی
                            7. وقتی کاربر بعدش درباره همون محصول خاص سوال جزئی پرسید (مثلاً: «قیمتش چنده؟»، «موجوده؟»، «رنگ‌هاش چی هست؟») جواب رو با قیمت، وضعیت و سایر جزئیات کامل بده.
                            8. هیچ‌وقت همه جزئیات محصول رو در مرحله اول نشون نده، فقط اسم + لینک.

                            📌 قوانین پاسخگویی:
                            - فقط بر اساس اطلاعات بالا پاسخ بده (اطلاعات جدید نساز).
                            - پاسخ‌ها باید کوتاه، دوستانه و مشتری‌مدار باشند.
                            - اگر سوالی خارج از فروشگاه پرسیده شد، مودبانه بگو فقط درباره محصولات و خدمات فروشگاه می‌توانی کمک کنی.
                            - در پایان پاسخ، اگر مناسب بود مشتری را تشویق کن به خرید (مثلاً: «این محصول الان موجوده، دوست دارید براتون ثبت کنم؟»).
                            - همیشه اول محصولات موجود را نمایش بده، سپس محصولات ناموجود را لیست کن.
                            "

                        ],
                        ['role' => 'user', 'content' => $question],
                    ],
                ]);

            if (!$response->successful()) {
                Log::error('AvalAI API ask error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            }

            $data = $response->json();
            return $data['choices'][0]['message']['content'] ?? null;

        } catch (\Exception $e) {
            Log::error('AIService ask exception', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * تحلیل تصویر با AI
     */
    public function analyzeImage(string $imagePath): ?string
    {
        try {
            $response = Http::withoutVerifying()
                ->withToken($this->apiKey)
                ->post($this->apiUrl, [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "شما دستیار فروشگاه پوشاک هستید. توضیح دقیق محصولات بر اساس تصویر بده."
                        ],
                        [
                            'role' => 'user',
                            'content' => [
                                ['type' => 'text', 'text' => 'این تصویر مربوط به چه محصولی است؟'],
                                ['type' => 'image_url', 'image_url' => asset($imagePath)]
                            ]
                        ]
                    ]
                ]);

            if (!$response->successful()) {
                Log::error('AvalAI API analyzeImage error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            }

            $data = $response->json();
            return $data['choices'][0]['message']['content'] ?? null;

        } catch (\Exception $e) {
            Log::error('AIService analyzeImage exception', ['message' => $e->getMessage()]);
            return null;
        }
    }
}
