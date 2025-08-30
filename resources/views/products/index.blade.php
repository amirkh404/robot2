@extends('layouts.app')

@section('conetent') {{-- دقت کن: تایپ صحیحش content هست --}}
    @if($products->isEmpty())
        <div class="text-center text-gray-500 text-lg py-12">محصولی یافت نشد.</div>
    @else
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

                    <div class="text-left leading-right h-[20px] flex flex-col justify-between">
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
            <div class="font-semibold text-gray-800 mb-2 leading-snug break-words">{{ $product->title }}</div>
            </div>            
        </div>            @endforeach
        </div>
    @endif
@endsection
