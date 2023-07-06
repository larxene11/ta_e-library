@extends('layouts.base-layout')

@section('base_head')
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/appMy.css') }}" />
    <script src="https://cdn.tiny.cloud/1/6fjd6rxh56kvz196ef63ti9bcq7vzntiwag1137qu07ckjx6/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    @yield('head')
@endsection

@section('base_body')
    <div class="font-poppins">
        <!-- BEGIN: Navbar -->
        @include('fragments.header-fragment')
        <!-- END: Navbar -->
        <!-- BEGIN: Body -->
        <div class="lg:pt-20 pt-16">
            @yield('body')
        </div>
        <!-- END: Body -->
        <!-- BEGIN: Footer -->
        @include('fragments.footer-fragment')
        <!-- END: Footer -->
    </div>
@endsection

@section('base_script')
    @yield('script')
@endsection