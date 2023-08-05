@extends('layouts/dashboard-layout')
@section('body')
    <!-- BEGIN: Content -->
    <div class="content col-span-12">
        <div class="intro-y flex items-center -mt-10">
            <h2 class="text-xl font-medium">
                Tambah Data Kunjungan
            </h2>
            <input type="hidden" value="0" id="package_id">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_kunjungan.patch',['kunjungan'=>$kunjungan]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="intro-y box p-5">
                        <div class="mt-3">
                            <label for="nis" class="form-label mt-2">NIS</label>
                            @error('nis')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="nis" name="nis" type="text" class="form-control"
                                placeholder="Masukan NIS Siswa" value="{{ $kunjungan->nis }}">
                        </div>
                        <div>
                            <label for="nama"
                                class="form-label">Nama Siswa</label>
                            @error('nama')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="nama" name="nama" type="text" class="form-control"
                                placeholder="Masukan Nama Siswa" value="{{ $kunjungan->nama }}">
                        </div>
                        <div>
                            <label for="nama"
                                class="form-label">Alasan Berkunjung</label>
                            @error('alasan_berkunjung')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="alasan_berkunjung" name="alasan_berkunjung" type="text" class="form-control"
                                placeholder="Masukan Alasan Berkunjung" value="{{ $kunjungan->alasan_berkunjung }}">
                        </div>
                        <div>
                            <label for="tgl_berkunjung"
                                class="form-label">Tanggal Berkunjung</label>
                            @error('tgl_berkunjung')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="tgl_berkunjung" name="tgl_berkunjung" type="date" class="form-control"
                                placeholder="Masukan Tanggal Berkunjung" value="{{ $kunjungan->tgl_berkunjung }}">
                        </div>                        
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_kunjungan.all') }}"
                                class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                            <button type="submit"
                                class="btn text-primary btn-primary w-24">Save</button>
                        </div>
                    </div>
                </form>
                <!-- END: Form Layout -->
            </div>
        </div>
    </div>
    <!-- END: Content -->
@endsection

@section('script')
    {{-- <script src="{{ asset('dist/js/view/manage-airport/airport.js') }}"></script> --}}
    
@endsection
