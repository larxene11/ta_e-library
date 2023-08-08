@extends('layouts/dashboard-layout')
@section('body')
    <!-- BEGIN: Content -->
    <div class="content col-span-12">
        <div class="intro-y flex items-center -mt-10">
            <h2 class="text-xl font-medium">
                Tambah Data Pinjaman
            </h2>
            <input type="hidden" value="0" id="package_id">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_pinjaman.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="intro-y box p-5">
                        <div class="mt-3">
                            <label for="kode_buku" class="form-label mt-2">Kode Buku yang Dipinjam</label>
                            @error('kode_buku')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <select name="kode_buku" id="kode_buku" data-placeholder="Pilih Kode Buku yang Dipinjam"
                                class="tom-select w-full">
                                <option value="0">None</option>
                                @foreach ($books as $item)
                                    <option value="{{ $item->kode_buku }}">{{ $item->kode_buku }} {{ $item->judul }}</option>
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
                                <option value="0">None</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->nis_nip}}">{{ $item->nis_nip }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="imageContainer">
                            <img id="gambarUser" src="" alt="Gambar User" class="max-w-full hidden h-32 mt-5">
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_pinjaman.all') }}"
                                class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                            <button
                                class="btn btn-primary w-24">Save</button>
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
    // document.getElementById('nis').addEventListener('change', function() {
    //     const selectedNIS = this.value;
    //     if (selectedNIS) {
    //         loadImage(selectedNIS);
    //     }
    // });

    // function loadImage(nis) {
    //     // Buat permintaan Ajax ke server
    //     const xhr = new XMLHttpRequest();
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === XMLHttpRequest.DONE) {
    //             if (xhr.status === 200) {
    //                 const imageUrl = URL.createObjectURL(xhr.response);
    //                 document.getElementById('imageContainer').innerHTML = `<img src="${imageUrl}" alt="Gambar Profil">`;
    //             } else {
    //                 document.getElementById('imageContainer').innerHTML = '<p>Gambar Profil Tidak Tersedia</p>';
    //             }
    //         }
    //     };
    //     xhr.responseType = 'blob';
    //     xhr.open('GET', `/get-gambar/${nis}`);
    //     xhr.send();
    // }

    document.getElementById('nis').addEventListener('input', function() {
    var nis = this.value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/get-gambar/' + nis, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var gambarUser = document.getElementById('gambarUser');

            if (response.gambar) {
                gambarUser.src = response.gambar;
                gambarUser.style.display = 'block'; // Tampilkan elemen img
            } else {
                gambarUser.style.display = 'none'; // Sembunyikan elemen img
            }
        }
    };
    xhr.send();
});
</script>
@endsection
