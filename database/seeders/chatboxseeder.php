<?php

namespace Database\Seeders;

use App\Models\Chatbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class chatboxseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chatbox::insert([
            [
                'question' => 'چطور می‌توانم سفارش ثبت کنم؟',
                'answer' => 'برای ثبت سفارش، محصول مورد نظر را انتخاب کرده و پس از افزودن به سبد خرید، مراحل پرداخت را تکمیل کنید.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'مدت زمان ارسال سفارش چقدر است؟',
                'answer' => 'سفارش‌ها معمولاً بین ۲ تا ۵ روز کاری ارسال می‌شوند.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'آیا امکان تعویض یا مرجوعی کالا وجود دارد؟',
                'answer' => 'بله، تا ۷ روز پس از دریافت سفارش امکان مرجوعی یا تعویض کالا وجود دارد به شرطی که استفاده نشده باشد.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'روش‌های پرداخت به چه صورت است؟',
                'answer' => 'در حال حاضر امکان پرداخت آنلاین از طریق کارت‌های عضو شتاب وجود دارد.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'آیا محصولات اورجینال هستند؟',
                'answer' => 'بله، تمامی محصولات ما اصل و دارای ضمانت کیفیت هستند.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
//مشکل کدت اینجاست که از Chatbox::create() استفاده کردی ولی بهش یه آرایه چندتایی (nested array) دادی.
//
//🔹 create() فقط یک رکورد می‌سازه.
//برای چند رکورد باید از insert() استفاده کنی یا حلقه بزنی.
