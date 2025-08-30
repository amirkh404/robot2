@extends('layouts.admin')

@section('title', 'افزودن امتیاز به کاربران')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow rounded-xl p-6">
    <h1 class="text-2xl font-bold mb-8 text-indigo-800 text-center">افزودن امتیاز یه کاربران</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    @foreach($users as $user)
        <div class="border border-gray-200 p-4 rounded rounded-xl mb-6 bg-gray-50">
            <div class="mb-2 text-lg font-semibold text-gray-800 flex justify-between items-center"> 
            <span>{{ $user->name }}</span>
            <span class="text-sm text-gray-600">امتیاز فعلی:{{ $user->total_points }}</span>
            </div>

            <form action="{{ route('admin.users.points', $user->id) }}" method="post" class="mt-2 flex gap-4 items-center">
                @csrf
                <input type="number" name="points" required placeholder="امتیاز" 
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-indigo-300">
                <input type="text" name="description" required placeholder="توضیح(اختیاری)" 
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-indigo-300">
                <button class="bg-indigo-600 text-white px-4 py-1 rounded hover:bg-indigo-700 transition w-full sm:w-auto"> ثبت</button>
                </form>    
        </div>
    @endforeach
</div>
@endsection