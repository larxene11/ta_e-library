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
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <form action="{{ route('password.update') }}" method="post">
                        @csrf
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Reset Password
                        </h2>
                        <div class="p-5">
                            <input type="hidden" name="token" value="{{ request()->token }}">
                            <input type="hidden" name="email" value="{{ request()->email }}">
                            <div class="mt-3">
                                <label for="password" class="form-label">New Password</label>
                                <input id="password" type="password" name="password" class="form-control" placeholder="Input New Password">
                            </div>
                            <div class="mt-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input id="password_confirm" name="password_confirm" type="password" class="form-control" placeholder="Input Password Confirm">
                            </div>
                            <button class="btn btn-primary mt-4">Reset Password</button>
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