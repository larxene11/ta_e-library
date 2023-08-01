@extends('layouts.front-layout')
@section('body')
    {{-- BANNER --}}
    <div class="lg:h-full w-full md:h-[300px] h-[250px] relative">
        <img src="{{ asset('dist/images/book1.jpg') }}" alt="" class="object-cover object-center w-full md:h-[500px] h-auto">
        <div class="text-center text-white absolute top-[50%] left-[50%] -translate-x-[50%] w-full -translate-y-[50%]">
            <h2 class="uppercase lg:px-96 md:px-32 px-10 font-bold lg:text-6xl md:text-5xl text-3xl"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Detail Books
            </h2>
        </div>
    </div>
    {{-- End BANNER --}}
    {{-- Search --}}
    <form action="{{ route('buku-catalog') }}" method="GET">
        <div class="flex md:px-80 md:pt-3 pt-1">
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Category</label>
            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-gray-100 " type="button">All categories <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
            </button>
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdown-button">
                @foreach($category as $item)
                <li>
                    <a href="{{ route('buku-category', ['category' => $item]) }}" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 ">{{ $item->name }}</a>
                </li>
                @endforeach
                </ul>
            </div>
            <div class="relative w-full">
                <input type="text" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300" placeholder="Masukan kata kunci yang ingin dicari" required>
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
    <div class="px-5 mt-7 mb-5">
        <div class="md:flex md:flex-row gap-5">
            <div class="md:flex-shrink-0 basis-4/12 mb-2 justify-center">              
                <img class="md:ml-44 md:h-4/6 featured-img" src="{{ asset($books->images->count() ? 'storage/' . $books->images->src : 'dist/images/default.jpg')}}" alt="{{ $books->judul }}">
            </div>
            <div class="md:flex-shrink-0 basis-5/12">
                <div class="flex flex-row flex-none gap-2">
                    <label for="name" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Judul Buku</label>
                    <p class="basis-2/3 text-sm mb-2">: {{ $books->judul }}</p>
                </div>
                <div class="flex flex-row flex-none gap-2">
                    <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Nama Pengarang</label>
                    <p class="basis-2/3 text-sm mb-2">: {{ $books->pengarang }}</p>
                </div>
                <div class="text-sm text-black mb-2">
                    <p class="capitalize tracking-wide text-sm text-black font-semibold">Description</p>
                    <p>{{ $books->description }}</p>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <caption class="text-lg font-semibold text-left text-gray-900">
                            Buku dengan judul yang sama lainnya
                        </caption>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    KODE BUKU
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NO RAK
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    STATUS
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($relatedBooks as $items)
                                <tr class="border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $items->kode_buku }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $items->no_rak }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $items->status }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4">Tidak ada buku yang sejudul</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <h4 class="text-lg font-bold text-left text-gray-900">
                    Informasi lebih lengkap
                </h4>
                <div class="flex flex-row flex-none gap-2 pt-3">
                    <label for="category" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Kategori</label>
                    <p class="basis-2/3 text-sm mb-2">: {{ $books->category->name }}</p>
                </div>
                <div class="flex flex-row flex-none gap-2">
                    <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Penerbit</label>
                    <p class="basis-2/3 text-sm mb-2">: {{ $books->penerbit }}</p>
                </div>
                <div class="flex flex-row flex-none gap-2">
                    <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Tahun Terbit</label>
                    <p class="basis-2/3 text-sm mb-2">: {{ $books->tahun_terbit }}</p>
                </div>
                <div class="flex flex-row flex-none gap-2">
                    <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">No Rak Buku</label>
                    <p class="basis-2/3 text-sm mb-2">: {{ $books->no_rak }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection