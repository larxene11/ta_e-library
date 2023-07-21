@extends('layouts.front-layout')
@section('body')
    @if (session()->has('alert'))
        @include('fragments.alert')
    @endif
    @if (session()->has('error'))
        @include('fragments.error')
    @endif
    @if (session()->has('success'))
        @include('fragments.success')
    @endif

    {{-- BANNER --}}
    <div class="lg:h-full w-full md:h-[500px] h-[500px] relative">
        <img src="{{ asset('dist/images/book1.jpg') }}" alt="" class="object-cover object-center w-full h-96">
        <div class="text-center text-white absolute top-[50%] left-[50%] -translate-x-[50%] w-full -translate-y-[50%]">
            <h1 class="uppercase lg:px-96 md:px-32 px-10 font-bold lg:text-6xl md:text-5xl text-3xl"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Selamat Datang di Perpustakaan SMA Negeri 2 Kuta
            </h1>
            <h5 class="lg:text-xl md:text-lg text-base font-normal lg:mt-5 mt-2 md:px-32 px-10"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Membaca Adalah Jembatan Menuju Kesuksesan
            </h5>
        </div>
    </div>
    {{-- End BANNER --}}
    {{-- Tombol Search --}}
        <div class="flex justify-center pb-10 mt-3 mb-8">
            <form action="{{ route('buku-search') }}" method="GET">
                <input type="text" placeholder="Cari buku" class="border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pnb-blue focus:border-transparent">
                <button type="submit" class="bg-slate-500 text-white px-4 py-2 rounded-r-md">Cari</button>
            </form>
        </div>
    {{-- End Tombol Search --}}
    {{-- Categories --}}
    <div class="flex flex-wrap w-full justify-center items-center md:gap-2 lg:gap-4 gap-4">
        @foreach ($category->take(5) as $data)
            <a href="#">
                <div
                    class="lg:w-[150px] md:w-[110px] lg:h-32 md:h-24 w-28 min-h-[100px] flex flex-col rounded-md shadow border border-slate-300 hover:border-yellow-400 hover:shadow-yellow-400 duration-300 hover:-translate-y-1 hover:shadow-md transition ease-linear text-center justify-center items-center lg:py-3 md:py-3 md:px-1 py-2 px-1">
                    <img src="{{ asset('dist/images/default.jpg') }}" alt="icon-categories"
                        class="lg:w-12 md:w-7 w-8 mx-auto">
                    <h5 class="lg:text-sm text-xs font-medium mt-2">{{ $data->name }}</h5>
                </div>
            </a>
        @endforeach
        <a href="#">
            <div
                class="lg:w-[150px] md:w-[110px] lg:h-32 md:h-24 w-28 min-h-[100px] flex flex-col rounded-md shadow border border-slate-300 hover:border-yellow-400 hover:shadow-yellow-400 duration-300 hover:-translate-y-1 hover:shadow-md transition ease-linear text-center justify-center items-center lg:py-3 md:py-3 md:px-1 py-2 px-1">
                <img src="{{ asset('dist/images/default.jpg') }}" alt="icon-categories"
                    class="lg:w-12 md:w-7 w-8 mx-auto">
                <h5 class="lg:text-sm text-xs font-medium mt-2">See more..</h5>
            </div>
        </a>
    </div>
    {{-- End Categories --}}
    {{-- Buku all --}}
    <div class="px-5 mt-5">
        <h3 class="font-semibold lg:text-2xl mb-5 lg:text-left md:text-left text-center ">
            Buku yang baru ditambahkan
        </h3>
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
    </div>
    {{-- End Buku all --}}
@endsection