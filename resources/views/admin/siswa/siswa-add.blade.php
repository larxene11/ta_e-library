@extends('layouts/dashboard-layout')
@section('body')
    <!-- BEGIN: Content -->
    <div class="content col-span-12">
        <div class="intro-y flex items-center -mt-10">
            <h2 class="text-xl font-medium">
                Tambah Data Siswa
            </h2>
            <input type="hidden" value="0" id="package_id">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('attempt_register') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="intro-y box p-5">
                        <div class="mt-4">
                            <input type="text" name="nis_nip" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Input Nomor Induk Siswa">
                            @error('nis_nip')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="text" name="name" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Full Name">
                            @error('name')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="email" name="email" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Email">
                            @error('email')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="text" name="tlp" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Phone Number (+62xxxxxxxx)">
                            @error('tlp')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="text" name="alamat" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Address">
                            @error('alamat')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="text" name="jurusan_jabatan" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Jurusan">
                            @error('jurusan_jabatan')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
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
