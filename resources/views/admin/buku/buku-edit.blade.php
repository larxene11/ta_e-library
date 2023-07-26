@extends('layouts/dashboard-layout')
@section('body')
    <!-- BEGIN: Content -->
    <div class="content col-span-12">
        <div class="intro-y flex items-center -mt-10">
            <h2 class="text-xl font-medium">
                Edit Data Buku
            </h2>
            <input type="hidden" value="0" id="kode_buku">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_book.patch',['book'=>$book]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="deleted_images" name="deleted_images" value="{{ old('deleted_images') }}">
                        <div class="intro-y box p-5">
                            <div>
                                <label for="kode_buku"
                                    class="form-label">Kode Buku</label>
                                @error('kode_buku')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                                <input id="kode_buku" name="kode_buku" type="text" class="form-control"
                                    placeholder="Masukan Kode Buku" value="{{old('kode_buku')??$book->kode_buku}}">
                            </div>
                            <div>
                                <label for="judul"
                                    class="form-label">Judul Buku</label>
                                @error('judul')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                                <input id="judul" name="judul" type="text" class="form-control"
                                    placeholder="Masukan Judul Buku" value="{{old('judul')??$book->judul}}">
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
                                        <option value="{{$item->id}}" {{ $book->category_id==$item->id?'selected':null }}>{{$item->name}}</option>
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
                                    placeholder="Masukan Nama Pengarang" value="{{old('pengarang')??$book->pengarang}}">
                            </div>
                            <div>
                                <label for="penerbit"
                                    class="form-label">Penerbit</label>
                                @error('penerbit')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                                <input id="penerbit" name="penerbit" type="text" class="form-control"
                                    placeholder="Masukan Nama Penerbit" value="{{old('penerbit')??$book->penerbit}}">
                            </div>
                            <div>
                                <label for="tahun_terbit"
                                    class="form-label">Tahun Terbit</label>
                                @error('tahun_terbit')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                                <input id="tahun_terbit" name="tahun_terbit" type="text" class="form-control"
                                    placeholder="Masukan Tahun Terbit" value="{{old('tahun_terbit')??$book->tahun_terbit}}">
                            </div>
                            <div>
                                <label for="no_rak"
                                    class="form-label">No Rak Buku</label>
                                @error('no_rak')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                                <input id="no_rak" name="no_rak" type="text" class="form-control"
                                    placeholder="Masukan No Rak Buku" value="{{old('no_rak')??$book->no_rak}}">
                            </div>
                            <div>
                                <label for="dana"
                                    class="form-label">Asal Pengadaan Buku</label>
                                @error('dana')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                                <input id="dana" name="dana" type="text" class="form-control"
                                    placeholder="Masukan Asal Pengadaan Buku" value="{{old('dana')??$book->dana}}">
                            </div>
                            <div>
                                <label for="tahun"
                                    class="form-label">Tahun Pengadaan Buku</label>
                                @error('tahun')
                                    <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                                @enderror
                                <input id="tahun" name="tahun" type="text" class="form-control"
                                    placeholder="Masukan Tahun Pengadaan Buku" value="{{old('tahun')??$book->tahun}}">
                            </div>
                            <div class="mt-3">
                                <label for="description" class="form-label">Description</label>
                                @error('description')
                                    <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                                @enderror
                                <textarea id="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan Deskripsi Buku">{{ $book->description ?? old('description')}}</textarea>
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
                                    <img id="img_preview" class="upload__img-box" src="{{ isset($book->images->src)?asset('storage/'.$book->images->src):''}}"
                                     alt="{{ isset($book->images->alt)?$book->images->alt:''}}">
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
    </script>
    <script>
        // Mengambil elemen dengan class 'upload__img-close'
        var closeButtons = document.getElementsByClassName('upload__img-close');
    
        // Menambahkan event listener untuk setiap tombol 'upload__img-close'
        Array.from(closeButtons).forEach(function(button) {
            button.addEventListener('click', function() {
                var imageId = button.getAttribute('data-id');
                var deletedImagesInput = document.getElementById('deleted_images');
                var deletedImages = deletedImagesInput.value;
    
                // Menambahkan ID gambar yang akan dihapus ke nilai elemen 'deleted_images'
                if (deletedImages !== '') {
                    deletedImages += ',';
                }
                deletedImages += imageId;
                deletedImagesInput.value = deletedImages;
    
                // Menghapus elemen gambar dari tampilan
                button.parentNode.parentNode.remove();
            });
        });
    </script>
@endsection