@extends('layouts.base-layout')
@section('base_head')
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
@endsection
@section('base_body')
<div class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="E-Library SMANDUTA" class="w-6" src="{{ asset('dist/images/logo-asli.jpg') }}">
                    <span class="text-white text-lg ml-3"> E-Library SMANDUTA </span> 
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to 
                        <br>
                        sign up to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <form action="{{ route('attempt_register') }}" method="POST">
                        @csrf
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Register Account
                        </h2>
                        <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
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
                        <div class="mt-4">
                            <input type="password" name="password" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Password">
                            @error('password')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="password" name="password_confirm" class="intro-x login__input form-control py-3 px-4"
                                placeholder="Password Confirmation">
                            @error('password_confirm')
                                <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="intro-x flex items-center text-slate-600 dark:text-slate-500 mt-4 text-xs sm:text-sm">
                            <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                            <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
                            <a class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>. 
                        </div> --}}
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                            <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
    
    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <!-- END: JS Assets-->
</div>
@endsection
