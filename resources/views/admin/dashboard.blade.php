@extends('layouts.admin')

@section('title', 'داشبورد مدیریت')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <a href="{{ route('admin.users.index') }}" class="block p-6 bg-white rounded-lg shadow hover:bg-indigo-50 transition">
        <h2 class="text-xl font-semibold text-indigo-700">لیست کاربران</h2>
        <p class="text-gray-600 text-sm mb-2">نمایش همه کاربران و اطلاعات آن ها</p>
    </a>

    <a href="{{ route('admin.users.users') }}" class="block p-6 bg-white rounded-lg shadow hover:bg-indigo-50 transition">
        <h2 class="text-xl font-semibold text-indigo-700">امتیازدهی دستی</h2>
        <p class="text-gray-600 text-sm mb-2">افزودن امتیاز به کاربران</p>
    </a>

    <a  class="block p-6 bg-white rounded-lg shadow hover:bg-indigo-50 transition">
        <h2 class="text-xl font-semibold text-indigo-700">لیست جوایز</h2>
        <p class="text-gray-600 text-sm mb-2">مشاهده و مدیریت جوایز</p>
    </a>
</div>
@endsection