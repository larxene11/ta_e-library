@extends('layouts/dashboard-layout')
@section('body')
<!-- BEGIN: Content -->
    <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            Data List Kunjungan
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <a href="{{ route('manage_kunjungan.create') }}" class="btn btn-primary shadow-md mr-2">Tambah Kunjungan</a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-preview" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                        </ul>
                    </div>
                </div>
                <div class="hidden md:block mx-auto text-slate-500"></div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <form action="{{ route('manage_kunjungan.all') }}" method="get">
                        <div class="flex justify-center items-center">
                            <div class="flex">
                                <input type="text" name="search" class="form-control w-56 box pr-10" style="border-top-right-radius: 0!important;
                                    border-bottom-right-radius: 0!important;" placeholder="Search...">
                                <button type="submit" class="bg-[#2d2d2d]" style="border-top-right-radius: 0.25rem!important;
                                    border-bottom-right-radius: 0.25rem!important;"><i class="w-4 h-4 mx-3 text-white rounded-sm"  data-lucide="search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="text-center whitespace-nowrap">NIS</th>
                            <th class="text-center whitespace-nowrap">NAMA</th>
                            <th class="text-center whitespace-nowrap">ALASAN BERKUNJUNG</th>
                            <th class="text-center whitespace-nowrap">TANGGAL BERKUNJUNG</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kunjungan as $index=>$item)
                        <tr class="intro-x">
                            <td class="text-center w-20">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->nis }}</td>
                            <td class="text-center">{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->alasan_berkunjung }}</td>
                            <td class="text-center">{{ $item->tgl_berkunjung }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('manage_kunjungan.update', ['kunjungan' => $item]) }}"> <i
                                            data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"
                                        onclick="deleteModalHandler({{ $index }})"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>
                                    <input type="hidden" id="delete_route_{{ $index }}"
                                        value="{{ route('manage_kunjungan.delete', ['kunjungan' => $item]) }}">
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
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
     <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            {{ $kunjungan->links('fragments.pagination') }}
        </nav>
    </div>
    <!-- END: Pagination -->
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">
                        Do you really want to delete these records? 
                        <br>
                        This process cannot be undone.
                    </div>
                </div>
                <div class="px-5 pb-8 flex justify-center items-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <form id="deleteItem" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="" id="delete_route_input">
                        <button type="submit" class="flex items-center btn btn-danger w-24 text-danger"><i
                                data-lucide="trash-2"
                                class="w-4 h-4 mr-1"></i>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content -->
<!-- Modal Export PDF -->
<div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-10"> 
                <h3 class="mb-4 text-xl font-medium text-gray-900 ">Choose Date</h3>
                <form class="space-y-6" action="{{ route('exportPDF.kunjungan') }}" method="GET">
                    <div class="space-y-6">
                        <div>
                            <label for="tglawal"
                                class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Awal</label>
                            <input type="date" name="tglawal" id="tglawal"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "required>
                        </div>
                        <div>
                            <label for="tglakhir"
                                class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Akhir</label>
                            <input type="date" name="tglakhir" id="tglakhir"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                required>
                        </div>
                    <button class="btn btn-primary w-24">Export</button>
                </form>
            </div>
        </div>
    </div>
</div> 
<!-- End Modal -->
@endsection
@section('script')
    <script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
@endsection