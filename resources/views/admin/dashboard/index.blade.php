@extends('layouts.dashboard-layout')

@section('body')
{{-- <h1 class="font-bold capitalize text-2xl">Welcome to {{auth()->user()->level??'Main'}} Dashboard</h1> --}}
<!-- BEGIN: Content -->
<div class="content">
    <div class="grid grid-cols-12 gap-6">
        
        <div class="col-span-12 p-4 text-center bg-cyan-900 border border-gray-200 rounded-lg shadow sm:p-8">
            <h5 class="mb-2 text-3xl font-bold text-white">Welcome to Dashboard {{ auth()->user()->name }}</h5>
            <div class="flex gap-2 text-center justify-center">
                <i data-lucide="calendar" class="text-white"></i>
                <p class="mb-5 text-base text-white sm:text-lg">{{ $today }}</p>
            </div>
            
        </div>


        <!-- BEGIN: General Report -->
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    General Report
                </h2>
                <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <a href="{{ route('manage_book.all') }}">
                                <div class="flex">
                                <i data-lucide="book" class="report-box__icon text-primary"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $books->count() }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Book</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <a href="{{ route('manage_pinjaman.all') }}">
                                <div class="flex">
                                    <i data-lucide="book-open" class="report-box__icon text-pending"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $pinjaman->count() }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Loan</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <a href="{{ route('manage_kunjungan.all') }}">
                                <div class="flex">
                                    <i data-lucide="monitor" class="report-box__icon text-warning"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $kunjungan->count() }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Visitor</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <a href="{{ route('manage_siswa.all') }}">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-success"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $user->count() }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Account</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: General Report -->
        {{-- <!-- BEGIN: Weekly Top Products -->
        <div class="col-span-12 mt-6">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Month Top Books
                </h2>
                <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <a class="btn btn-primary "> <i data-lucide="file-text" ></i> Export to PDF </a>
                </div>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="text-center whitespace-nowrap">BOOK CODE</th>
                            <th class="text-center whitespace-nowrap">TITLE</th>
                            <th class="text-center whitespace-nowrap">WRITER</th>
                            <th class="text-center whitespace-nowrap">STATUS</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookOfMonth->pinjaman as $index=>$item)
                        <tr class="intro-x">
                            <td class="text-center w-20">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->kode_buku }}</td>
                            <td class="text-center">{{ $item->judul }}</td>
                            <td class="text-center">{{ $item->pengarang }}</td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('manage_book.detail', ['book' => $item]) }}"> <i data-lucide="eye"
                                            class="w-4 h-4 mr-1"></i> Detail </a>
                                    <a class="flex items-center mr-3"
                                        href="{{ route('manage_book.update', ['book' => $item]) }}"> <i
                                            data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"
                                        onclick="deleteModalHandler({{ $index }})"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>
                                    <input type="hidden" id="delete_route_{{ $index }}"
                                        value="{{ route('manage_book.delete', ['book' => $item]) }}">
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="9">No Data</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END: Weekly Top Products --> --}}
    </div>
</div>
<!-- END: Content -->
@endsection