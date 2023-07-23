@extends('layouts.dashboard-layout')
@section('body')
<!-- BEGIN: Content -->
<div class="content">
    <!-- END: Top Bar -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Detail Book
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box p-8">
                <div class="md:flex md:flex-row gap-5">
                    <div class="md:flex-shrink-0 basis-4/12 justify-center">              
                        <img class="featured-img" src="{{ asset($book->images->count() ? 'storage/' . $book->images->src : 'dist/images/default.jpg')}}" alt="{{ $book->judul }}">
                    </div>
                    <div class="md:flex-shrink-0 basis-5/12">
                        <div class="flex flex-row gap-2">
                            <label for="code" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Kode Buku</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->kode_buku }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="name" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Judul Buku</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->judul }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="category" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Kategori</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->category->name }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Nama Pengarang</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->pengarang }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Penerbit</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->penerbit }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Tahun Terbit</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->tahun_terbit }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="brand" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">No Rak Buku</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->no_rak }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="weight" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Tahun</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->tahun }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="price" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Pendanaan Buku</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->dana }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="price" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Ketersediaan Buku</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $book->status }}</p>
                        </div>
                    </div>
                    <div class="text-sm text-black mt-5 ml-2">
                        <p class="capitalize tracking-wide text-sm text-black font-semibold">Description</p>
                        <p>{{ $book->description }}</p>
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_book.all') }}"
                                class="btn btn-outline-secondary w-24 mr-1">Back</a>
                            <a href="#"
                                class="btn text-white btn-primary w-24">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection
@section('script')
<script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
<script>
    jQuery(document).ready(function () {
    bookImages();
});
@endsection