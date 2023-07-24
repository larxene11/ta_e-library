@extends('layouts/dashboard-layout')
@section('body')
<!-- BEGIN: Content -->
    <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            Data List Pinjaman
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <a href="{{ route('manage_pinjaman.create') }}" class="btn btn-primary shadow-md mr-2">Tambah Pinjaman</a>
                <a href="{{ route('manage_kembali.save') }}" class="btn btn-primary shadow-md mr-2">Kembali Buku</a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="#" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div> --}}
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="text-center whitespace-nowrap">NIS</th>
                            <th class="text-center whitespace-nowrap">KODE BUKU</th>
                            <th class="text-center whitespace-nowrap">TANGGAL PINJAMAN</th>
                            <th class="text-center whitespace-nowrap">TANGGAL PENGEMBALIAN</th>
                            <th class="text-center whitespace-nowrap">DENDA</th>
                            <th class="text-center whitespace-nowrap">STATUS</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pinjaman as $index=>$item)
                        <tr class="intro-x">
                            <td class="text-center w-20">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->nis }}</td>
                            <td class="text-center">{{ $item->kode_buku }}</td>
                            <td class="text-center">{{ $item->tgl_pinjaman }}</td>
                            <td class="text-center">{{ $item->tgl_pengembalian }}</td>
                            <td class="text-center">{{ $item->denda }}</td>
                            <td class="text-center">{{ $item->status_pengembalian }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('manage_pinjaman.update', ['pinjaman' => $item]) }}"> <i
                                            data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"
                                        onclick="deleteModalHandler({{ $index }})"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>
                                    <input type="hidden" id="delete_route_{{ $index }}"
                                        value="{{ route('manage_pinjaman.delete', ['pinjaman' => $item]) }}">
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
            {{-- {{ $pinjaman->links('fragments.pagination') }} --}}
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
@endsection
@section('script')
    <script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
@endsection