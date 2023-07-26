@extends('layouts.front-layout')
@section('body')
<div class="container mx-auto py-8">
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Tampilkan profil user -->
        <div class="bg-white shadow-lg rounded-lg p-6 w-64">
            <img src="{{ $user->profile_picture }}" alt="Profile Picture" class="w-24 h-24 rounded-full mx-auto mb-4">
            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
            <!-- Informasi profil lainnya bisa ditambahkan di sini -->
        </div>
        <a href="#" class="text-blue-500 hover:text-blue-600 underline">Edit Profil</a>
    </div>
</div>
@endsection
