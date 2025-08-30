@extends('layouts.app')

@section('conetent')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 py-4">
    @foreach($products as $product)
        <div class="group relative bg-white rounded-2xl overflow-hidden cursor-pointer">

            @if($product->discount_percent)
                <div class="absolute top-5 left-0 bg-red-500 text-white text-sm px-6 py-3 z-10
                rounded-tr-full rounded-br-full font-bold">
                    {{ $product->discount_percent }} درصد
                </div>
            @endif


            <div class="overflow-hidden rounded-2xl">
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}"
            class="w-full h-70 object-cover transform transition-transform duration-300 group-hover:scale-105">
        </div>
        <div class="p-4 text-right space-y-0.5">
                <div class="flex items-start justify-between">
                    <div class="text-sm text-gray-400">
                        {{ $product->category }}
                    </div>

                    <div class="text-left h-[20px] flex flex-col justify-between">
                    @if($product->discount_price)
                        <div class="text-xs text-gray-400 line-through">
                            {{ number_format($product->original_price) }}
                        </div>

                        <div class="text-base font-extrabold text-indigo-600">
                            {{ number_format($product->discount_price) }}
                        </div>
                    @else
                        <div class="text-base font-extrabold text-indigo-600">
                            {{ number_format($product->original_price) }}
                        </div>
                    @endif
                    <div class="text-xs text-gray-500">تومان</div>
                </div>
            </div>
            <!-- چون انگار title توی div جدا و خارج از flex نوشته شده واینکه  div  ویژگی block  داره باعث میشه خط بعد بیفته -->
            <div class="font-semibold text-gray-800 mb-2 leading-snug break-words">{{ $product->title }}</div>
            </div>
        </div>
    @endforeach
</div>

{{--ربات چت--}}

<div class="fixed bottom-5 right-5 z-50">
    <button id="chatToggle"
        class="bg-indigo-600 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center hover:bg-indigo-700 transition">
        💬
    </button>

    <div id="chatBox" class="hidden w-[350px] flex-col fixed inset-x-4 bg-white rounded-2xl shadow-xl bottom-4 top-4 overflow-hidden">
        <div class="bg-indigo-600 text-white px-4 py-4 flex justify-between items-center">
            <span class="font-bold">پشتیبانی فروشگاه</span>
            <button id="chatClose" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
        </div>
        <div id="chatMessages" class="flex-1 p-3 overflow-y-auto text-sm space-y-3">
            <div class="bg-indigo-100 text-indigo-800 p-2 rounded-lg self-start w-fit mr-auto">سلام 👋 چطور می‌تونم کمکتون کنم؟</div>
        </div>

        <div class="p-2 border-t flex">
            <input id="chatInput" type="text" placeholder="پیام خود را بنویسید..."
                   class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <button id="sendBtn"
                    class="ml-2 mr-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">ارسال
            </button>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
<script>
    const chatToggle = document.getElementById('chatToggle');
    const chatBox = document.getElementById('chatBox');
    const chatClose = document.getElementById('chatClose');
    const sendBtn = document.getElementById('sendBtn');
    const chatInput = document.getElementById('chatInput');
    const chatMessages = document.getElementById('chatMessages');

    // باز و بسته کردن چت
    chatToggle.addEventListener("click", () => {
        chatToggle.classList.add('hidden');
        chatBox.classList.remove('hidden');
        chatBox.classList.add('flex');
    });
    chatClose.addEventListener("click", () => {
        chatBox.classList.add('hidden');
        chatBox.classList.remove('flex');
        chatToggle.classList.remove('hidden');
    });

    // تابع ارسال پیام
    function sendMessage() {
        const msg = chatInput.value.trim();
        if(!msg) return;

        // پیام کاربر
        const userMsg = document.createElement("div");
        userMsg.textContent = msg;
        userMsg.className = "bg-gray-200 text-gray-800 p-2 rounded-lg self-end w-fit ml-auto max-w-[200px] break-words";
        chatMessages.appendChild(userMsg);
        chatInput.value = "";
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // لودر پیام ربات
        const loader = document.createElement("div");
        loader.className = "bg-indigo-100 text-indigo-800 p-2 rounded-lg self-start w-fit mr-auto max-w-[200px] break-words flex items-center";
        loader.innerHTML = "در حال پاسخ دادن... <span class='ml-2 animate-pulse'>⏳</span>";
        chatMessages.appendChild(loader);
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // ارسال به سرور
        fetch("/api/chatbot/ask", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"},
            body: JSON.stringify({ question: msg })
        })
            .then(res => res.json())
            .then(data => {
                loader.remove(); // حذف لودر
                const reply = document.createElement("div");
                reply.textContent = data.answer;
                reply.className = "bg-indigo-100 text-indigo-800 p-2 rounded-lg self-start w-fit mr-auto max-w-[200px] break-words";
                chatMessages.appendChild(reply);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(err => {
                loader.remove(); // حذف لودر
                const errorReply = document.createElement("div");
                errorReply.textContent = "خطا در ارتباط با سرور 😔";
                errorReply.className = 'bg-red-100 text-red-800 p-2 rounded-lg self-start w-fit mr-auto max-w-[200px] break-words';
                chatMessages.appendChild(errorReply);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    }

    // ارسال با دکمه
    sendBtn.addEventListener("click", sendMessage);

    // ارسال با Enter
    chatInput.addEventListener("keypress", function(e) {
        if(e.key === "Enter" && !e.shiftKey){
            e.preventDefault();
            sendMessage();
        }
    });

</script>
@endpush
@endsection

<!-- یادت باشه که دستور php artisan storage:link
 این دستور فولدر public/storage رو به storage/app/public لینک می‌کنه. -->
{{--<!-- برای زوم این کردن در عکس های ادیتور کلیک و بری زوم اوت ctrl را نگه دار و بعد از آن کلیک کن -->--}}
{{--کلاس leading-none باعث میشه فاصله بالا و پایین کم بشه--}}
{{--mr-auto → مطمئن میشه که پیام به سمت چپ بچسبه--}}
{{--w-fit لازمه--}}
