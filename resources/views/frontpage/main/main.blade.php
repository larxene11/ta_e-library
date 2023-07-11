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
    {{-- BANNER --}}
    {{-- Tombol Search --}}
    <div class="flex justify-center pb-10 mt-3 mb-8">
        <form action="{{ route('buku-search') }}" method="GET">
            <input type="text" placeholder="Cari buku" class="border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pnb-blue focus:border-transparent">
            <button type="submit" class="bg-slate-500 text-white px-4 py-2 rounded-r-md">Cari</button>
        </form>
    </div>
@endsection