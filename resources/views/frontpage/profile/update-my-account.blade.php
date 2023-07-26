@extends('layouts.front-layout')
@section('body')
    <div class="container mx-auto py-8">
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg px-4 py-6">
            <h2 class="text-2xl font-semibold mb-6">Update Profil</h2>
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-input w-full" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-input w-full" required>
                </div>
                <!-- Tambahkan field untuk informasi profil lainnya -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection