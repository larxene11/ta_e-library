@extends('layouts.front-layout')
@section('head')
@endsection
@section('body')
<div class="container mx-auto py-6">
    {{-- BANNER --}}
    <div class="lg:h-full w-full md:h-[500px] h-[500px] relative">
        <img src="{{ asset('dist/images/book1.jpg') }}" alt="" class="object-cover object-center w-full h-96">
        <div class="text-center text-white absolute top-[50%] left-[50%] -translate-x-[50%] w-full -translate-y-[50%]">
            <h2 class="uppercase lg:px-96 md:px-32 px-10 font-bold lg:text-6xl md:text-5xl text-3xl"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Hasil Pencarian
            </h2>
        </div>
    </div>
    {{-- End BANNER --}}
    {{-- Tombol Search --}}
        <div class="flex justify-center pb-10 mt-1 md:mt-3 mb-8">
            <form action="{{ route('buku-search') }}" method="GET">
                <input type="text" placeholder="Cari buku" class="border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pnb-blue focus:border-transparent">
                <a type="submit" class="bg-slate-500 text-white px-4 py-2 rounded-r-md">Cari</a>
            </form>
        </div>
    {{-- End Tombol Search --}}

    @if ($results->isEmpty())
        <p class="text-red-500 text-center">Data Buku tidak ditemukan.</p>
    @else
        <div class="grid lg:grid-cols-4 md:grid-cols-4 grid-cols-2 gap-4">
            @foreach ($books as $items)
                <div class="block">
                    <a href="#">
                        <div
                            class="rounded-lg border hover:shadow-lg transition duration-300 ease-linear hover:-translate-y-2 bg-white max-w-sm min-h-full">
                            <img class="rounded-t-lg lg:h-[200px] md:h-[100px] h-[100px] w-full object-center"
                                src="{{ asset('storage/' . $items->images->first()->thumb) }}" alt="{{ $items->name }}" />
                            <div class="lg:p-3 md:p-3 p-2">
                                <h5 class="text-gray-900 lg:text-lg md:text-sm text-xs font-semibold">{{ $items->judul }}
                                </h5>
                                <p
                                    class="text-gray-700 font-medium bg-gray-100 rounded-md px-2 w-fit text-xs md:text-sm mb-4">
                                    {{ $items->category->name }}
                                </p>
                                <p class="text-gray-700 font-medium lg:text-base text-sm">
                                    {{ $items->pengarang }} </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection