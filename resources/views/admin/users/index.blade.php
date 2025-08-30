@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-12 bg-white/80 shadow-md rounded-lg p-6 mb-24">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700 text-center">لیست کاربران</h2>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg" dir="rtl">
        <thead class="bg-gray-100 text-center">
            <tr>
                <td class="px-4 py-2 border">نام</td>
                <td class="px-4 py-2 border">ایمیل</td>
                <td class="px-4 py-2 border">شماره تلفن</td>
                <td class="px-4 py-2 border">امتیاز</td>
                <td class="px-4 py-2 border">تاریخ ثبت نام</td>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="text-center">
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border">{{ $user->phone }}</td>
                    <td class="px-4 py-2 border">{{ $user->total_points }}</td>
                    <td class="px-4 py-2 border">{{ (new \Hekmatinasser\Verta\Verta($user->created_at))->format('Y/m/d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">هیچ کاربری ثبت نام نکرده</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-8 flex justify-center">
        {{ $users->links() }}
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/alert.js') }}"></script>
@endpush

@endsection

<!-- یادت باشه که دستور php artisan storage:link
 این دستور فولدر public/storage رو به storage/app/public لینک می‌کنه. -->
<!-- برای زوم این کردن در عکس های ادیتور کلیک و بری زوم اوت ctrl را نگه دار و بعد از آن کلیک کن -->

