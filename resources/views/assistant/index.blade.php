@extends('layouts.app')

@section('conetent')
<div class="container p-6 mx-auto">
    <h1 class="mb-6 text-2xl font-bold text-center">🤖 دستیار فروشگاه پوشاک</h1>

    <!-- فرم سوال تایپی -->
    <div class="p-6 mb-6 bg-white shadow-md rounded-2xl">
        <form id="askForm" class="flex flex-col space-y-4">
            <textarea
                name="question"
                id="question"
                rows="3"
                class="w-full p-3 border rounded-xl focus:ring focus:outline-none"
                placeholder="سوال خود را درباره محصولات فروشگاه تایپ کنید..."></textarea>

            <button type="submit"
                class="px-4 py-2 text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">
                ارسال سوال
            </button>
        </form>
    </div>

    <!-- فرم آپلود عکس -->
    <div class="p-6 mb-6 bg-white shadow-md rounded-2xl">
        <form id="imageForm" enctype="multipart/form-data" class="flex flex-col space-y-4">
            <input type="file" name="image" id="image" class="p-2 border rounded-xl">
            <button type="submit"
                class="px-4 py-2 text-white transition bg-green-600 rounded-xl hover:bg-green-700">
                آپلود تصویر
            </button>
        </form>
    </div>

    <!-- نمایش پاسخ ربات -->
    <div id="responseBox" class="hidden p-6 border bg-gray-50 rounded-2xl">
        <h2 class="mb-2 text-xl font-semibold">پاسخ دستیار:</h2>
        <p id="aiAnswer" class="mb-4 text-gray-700"></p>
    </div>
</div>

<!-- اسکریپت برای AJAX -->
<script>
document.getElementById("askForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    const question = document.getElementById("question").value;

    let response = await fetch("{{ route('assistant.ask') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ question })
    });

    let data = await response.json();
    showResponse(data);
});

document.getElementById("imageForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    let response = await fetch("{{ route('assistant.analyzeImage') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: formData
    });

    let data = await response.json();
    showResponse(data);
});

function showResponse(data) {
    document.getElementById("responseBox").classList.remove("hidden");
    document.getElementById("aiAnswer").innerText = data.answer || data.description;
}
</script>
@endsection
