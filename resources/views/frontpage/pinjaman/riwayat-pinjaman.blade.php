@extends('layouts.front-layout')
@section('body')
    {{-- BANNER --}}
    <div class="lg:h-full w-full md:h-[300px] h-[250px] relative">
        <img src="{{ asset('dist/images/book1.jpg') }}" alt="" class="object-cover object-center w-full md:h-[500px] h-auto">
        <div class="text-center text-white absolute top-[50%] left-[50%] -translate-x-[50%] w-full -translate-y-[50%]">
            <h2 class="uppercase lg:px-96 md:px-32 px-10 font-bold lg:text-6xl md:text-5xl text-3xl"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Loans History
            </h2>
        </div>
    </div>
    {{-- End BANNER --}}
    <div class="px-5 my-5">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    {{ auth()->user()->name}}
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">{{ auth()->user()->nis_nip}}</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Kode Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Pinjam
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Kembali
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Denda
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loanHistory as $items)
                        <tr class="border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $items->kode_buku }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $items->tgl_pinjaman }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $items->tgl_pengembalian }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $items->denda }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4">Tidak ada pinjaman yang anda lakukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection