@extends('layouts.base-layout')
@section('base_head')
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
@endsection
@section('base_body')
    @if (session()->has('alert'))
        @include('fragments.alert')
    @endif
    @if (session()->has('error'))
        @include('fragments.error')
    @endif
    @if (session()->has('success'))
        @include('fragments.success')
    @endif
<div class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="{{ route('main') }}" class="-intro-x flex items-center pt-5">
                    <img alt="E-Library SMANDUTA" class="w-6" src="{{ asset('dist/images/logofooter.png') }}">
                    <span class="text-white text-lg ml-3"> E-Library SMANDUTA </span> 
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/burunghantu.svg') }}">
                    <div class="-intro-x text-white font-normal text-3xl leading-tight mt-10">
                        The more that you read, 
                        <br>the more things you will know.
                    </div>
                </div>
            </div>
            <!-- END: Register Info -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="text-xl font-semibold mb-6">Change Password</h2>
                    <form action="{{ route('password.submitChange') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="current_password" class="block font-medium">Current Password</label>
                            <input type="password" id="current_password" name="current_password" class="form-input mt-2 w-full" required>
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block font-medium">New Password</label>
                            <input type="password" id="password" name="password" class="form-input mt-2 w-full" required>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="password_confirmation" class="block font-medium">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input mt-2 w-full" required>
                        </div>
                        <div>
                            <button class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
