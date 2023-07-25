@extends('layouts.front-layout')
@section('body')
    {{-- BANNER --}}
    <div class="lg:h-full w-full md:h-[500px] h-[500px] relative">
        <img src="{{ asset('dist/images/book1.jpg') }}" alt="" class="object-cover object-center w-full h-96">
        <div class="text-center text-white absolute top-[50%] left-[50%] -translate-x-[50%] w-full -translate-y-[50%]">
            <h1 class="uppercase lg:px-96 md:px-32 px-10 font-bold lg:text-6xl md:text-3xl text-xl"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Selamat Datang di Perpustakaan SMA Negeri 2 Kuta
            </h1>
            <h5 class="lg:text-xl md:text-lg text-base font-normal lg:mt-5 mt-2 md:px-32 px-10"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Membaca Adalah Jembatan Menuju Kesuksesan
            </h5>
        </div>
    </div>
    {{-- End BANNER --}}
    {{-- Search --}}
    <form action="" method="GET">
        <div class="flex md:px-80 md:pt-3 pt-1">
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Your Email</label>
            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-gray-100 " type="button">All categories <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
            </button>
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdown-button">
                @foreach($category as $item)
                <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 ">{{ $item->name }}</button>
                </li>
                @endforeach
                </ul>
            </div>
            <div class="relative w-full">
                <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300" placeholder="Masukan kata kunci yang ingin dicari" required>
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-cyan-700 rounded-r-lg border">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>
    {{-- End Search --}}
    {{-- Buku all --}}
    <div class="px-5 my-5">
        <h4 class="font-semibold lg:text-2xl mb-3 lg:text-left md:text-left text-center ">
            Buku yang baru ditambahkan
        </h4>
        <div class="grid lg:grid-cols-4 md:grid-cols-4 grid-cols-2 gap-4">
            @foreach ($books as $items)
                <div class="block">
                    <a href="#">
                        <div
                            class="rounded-lg border hover:shadow-lg transition duration-300 ease-linear hover:-translate-y-2 bg-white max-w-sm min-h-full">
                            <img class="rounded-t-lg lg:h-[200px] md:h-[100px] object-cover h-[100px] w-full object-center"
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
    </div>
    {{-- End Buku all --}}
@endsection