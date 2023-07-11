@extends('layouts.base-layout')

@section('base_head')
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/appMy.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @yield('head')
@endsection

@section('base_body')
    <div class="font-poppins">
        <!-- BEGIN: Navbar -->
        @include('fragments.header-fragment')
        <!-- END: Navbar -->
        <!-- BEGIN: Body -->
        <div class="">
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