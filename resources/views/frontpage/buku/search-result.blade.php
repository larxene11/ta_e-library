@extends('layouts.front-layout')
@section('head')
@endsection
@section('body')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Search Results</h2>

    @if ($results->isEmpty())
        <p class="text-red-500">Data Buku tidak ditemukan.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($results as $book)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <img class="featured-img" src="{{ asset($book->images->count() ? 'storage/'. $book->images->first()->src : 'dist/images/default.jpg') }}" alt="{{ $book->judul }}">
                    <h3 class="text-xl font-semibold mb-2">{{ $book->judul }}</h3>
                    <p class="text-gray-600 mb-2">By: {{ $book->pengarang }}</p>
                    <p class="text-gray-600">{{ $book->category->name }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection