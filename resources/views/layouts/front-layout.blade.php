@extends('layouts.base-layout')

@section('base_head')
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/appMy.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @yield('head')
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
    <div class="font-poppins">
        <!-- BEGIN: Navbar -->
        @guest
            @include('fragments.header-fragment')
        @else
            @include('fragments.header-auth-fragment')
        @endguest
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