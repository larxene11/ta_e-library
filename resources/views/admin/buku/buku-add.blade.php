@extends('layouts/dashboard-layout')
@section('body')
    <!-- BEGIN: Content -->
    <div class="content col-span-12">
        <div class="intro-y flex items-center -mt-10">
            <h2 class="text-xl font-medium">
                Tambah Data Buku
            </h2>
            <input type="hidden" value="0" id="package_id">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_book.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="intro-y box p-5">
                        <div>
                            <label for="kode_buku"
                                class="form-label">Kode Buku</label>
                            @error('kode_buku')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="kode_buku" name="kode_buku" type="text" class="form-control"
                                placeholder="Masukan Kode Buku" value="{{ old('kode_buku') }}">
                        </div>
                        <div>
                            <label for="judul"
                                class="form-label">Judul Buku</label>
                            @error('judul')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="judul" name="judul" type="text" class="form-control"
                                placeholder="Masukan Judul Buku" value="{{ old('judul') }}">
                        </div>
                        <div class="mt-3">
                            <label for="category_id" class="form-label mt-2">Kategori Buku</label>
                            @error('category_id')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <select name="category_id" id="category_id" data-placeholder="Pilih Kategori Buku"
                                class="tom-select w-full">
                                <option value="0">None</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id')==$item->id?'selected':null }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="pengarang"
                                class="form-label">Nama Pengarang</label>
                            @error('pengarang')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="pengarang" name="pengarang" type="text" class="form-control"
                                placeholder="Masukan Nama Pengarang" value="{{ old('pengarang') }}">
                        </div>
                        <div>
                            <label for="penerbit"
                                class="form-label">Penerbit</label>
                            @error('penerbit')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="penerbit" name="penerbit" type="text" class="form-control"
                                placeholder="Masukan Nama Penerbit" value="{{ old('penerbit') }}">
                        </div>
                        <div>
                            <label for="tahun_terbit"
                                class="form-label">Tahun Terbit</label>
                            @error('tahun_terbit')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="tahun_terbit" name="tahun_terbit" type="text" class="form-control"
                                placeholder="Masukan Tahun Terbit" value="{{ old('tahun_terbit') }}">
                        </div>
                        <div>
                            <label for="no_rak"
                                class="form-label">No Rak Buku</label>
                            @error('no_rak')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="no_rak" name="no_rak" type="text" class="form-control"
                                placeholder="Masukan No Rak Buku" value="{{ old('no_rak') }}">
                        </div>
                        <div>
                            <label for="dana"
                                class="form-label">Asal Pengadaan Buku</label>
                            @error('dana')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="dana" name="dana" type="text" class="form-control"
                                placeholder="Masukan Asal Pengadaan Buku" value="{{ old('dana') }}">
                        </div>
                        <div>
                            <label for="tahun"
                                class="form-label">Tahun Pengadaan Buku</label>
                            @error('tahun')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="tahun" name="tahun" type="text" class="form-control"
                                placeholder="Masukan Tahun Pengadaan Buku" value="{{ old('tahun') }}">
                        </div>
                        <div class="mt-3">
                            <label for="description" class="form-label">Description</label>
                            @error('description')
                                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                            @enderror
                            <textarea id="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" name="description" placeholder="Input Product Description">{{ old('description')??''}}</textarea>
                        </div>
                        <br>
                        <div class="upload__box mt-3">
                            @error('image')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <div class="upload__btn-box">
                                <label class="upload__btn btn btn-primary">
                                    <p>Choose An Image</p>
                                    <input type="file" name="image" id="img_upload" class="upload__inputfile" onchange="logoPreview()">
                                </label>
                            </div>
                            <div class="upload__img-wrap">
                                <img id="img_preview" class="upload__img-box" src="" alt="">
                            </div>
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_book.all') }}"
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
    <script>
        function logoPreview(){
            let inputImg=document.getElementById("img_upload");
            let imgPreview=document.getElementById("img_preview");   

            let imgReader=new FileReader();
            imgReader.readAsDataURL(inputImg.files[0]);
            console.log(inputImg.files[0]);
            imgReader.onload=function(e){
                imgPreview.setAttribute("src",e.target.result);
            }
        }
    </script>
@endsection
