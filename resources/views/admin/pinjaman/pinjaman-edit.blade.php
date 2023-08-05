@extends('layouts/dashboard-layout')
@section('body')
    <!-- BEGIN: Content -->
    <div class="content col-span-12">
        <div class="intro-y flex items-center -mt-10">
            <h2 class="text-xl font-medium">
                Edit Data Pinjaman
            </h2>
            <input type="hidden" value="0" id="pinjaman_id">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_pinjaman.patch',['pinjaman'=>$pinjaman]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="deleted_images" name="deleted_images">
                    <div class="intro-y box p-5">
                        <div class="mt-3">
                            <label for="kode_buku" class="form-label mt-2">Kode Buku yang Dipinjam</label>
                            @error('kode_buku')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <select name="kode_buku" id="kode_buku" data-placeholder="Pilih Kode Buku yang Dipinjam"
                                class="tom-select w-full">
                                @foreach ($books as $item)
                                    <option value="{{ $item->kode_buku }}"{{ $pinjaman->kode_buku==$item->kode_buku?'selected':null }}>{{ $item->kode_buku }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="nis" class="form-label mt-2">NIS</label>
                            @error('nis')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <select name="nis" id="nis" data-placeholder="Pilih NIS Siswa"
                                class="tom-select w-full">
                                @foreach ($users as $item)
                                    <option value="{{ $item->nis_nip}}" {{ $pinjaman->nis==$item->nis_nip?'selected':null }}>{{ $item->nis_nip }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tgl_pinjaman"
                                class="form-label">Tanggal Peminjaman</label>
                            @error('tgl_pinjaman')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="tgl_pinjaman" name="tgl_pinjaman" type="date" class="form-control"
                                placeholder="Masukan Tanggal Peminjaman" value="{{ old('tgl_pinjaman')?? $pinjaman->tgl_pinjaman }}">
                        </div>
                        <div>
                            <label for="tgl_pengembalian"
                                class="form-label">Tanggal Pengembalian</label>
                            @error('tgl_pengembalian')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="tgl_pengembalian" name="tgl_pengembalian" type="date" class="form-control"
                                placeholder="Masukan Tanggal Pengembalian" value="{{ old('tgl_pengembalian')?? $pinjaman->tgl_pengembalian }}">
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_pinjaman.all') }}"
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
    <script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
    {{-- <script>

        function trigger_file_input() {
            $('#service_image').trigger('click');
        }

        function previewImage(inputEl, imageEl) {
            const image = document.querySelector(inputEl)
            const imagePreview = document.querySelector(imageEl);
            const fileImage = new FileReader();
            fileImage.readAsDataURL(image.files[0]);
            fileImage.onload = function(e) {
                imagePreview.src = e.target.result;
            }

            return [image, imagePreview];
        }
    </script> --}}
@endsection