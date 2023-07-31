@extends('layouts.base-layout')
@section('base_head')
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
@endsection
@section('base_body')
    <div class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="{{ route('main') }}" class="-intro-x flex items-center pt-5">
                        <img alt="E-Library SMANDUTA" class="w-6" src="{{ asset('dist/images/logofooter.png') }}">
                        <span class="text-white text-lg ml-3"> E-Library SMANDUTA </span> 
                    </a>
                    <div class="my-auto">
                        <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/burunghantu.svg">
                        <div class="-intro-x text-white font-normal text-3xl leading-tight mt-10">
                            The more that you read, 
                            <br>the more things you will know.
                        </div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                                Sign In
                            </h2>
                            <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Enjoy your travel to E-Library SMANDUTA</div>
                            <div class="intro-x mt-8">
                                <div class="mt-4">
                                    <input type="email" name="email" class="intro-x login__input form-control py-3 px-4"
                                        placeholder="Email">
                                    @error('email')
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
                            </div>
                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                <a href="{{ route('password.email') }}">Forgot Password?</a> 
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button
                                    class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
    </div>
@endsection
