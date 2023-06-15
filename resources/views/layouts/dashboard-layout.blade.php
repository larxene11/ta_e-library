@extends('layouts.base-layout')

@section('base_head')
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tiny.cloud/1/6fjd6rxh56kvz196ef63ti9bcq7vzntiwag1137qu07ckjx6/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
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
    <div class="py-5 md:py-0">
        <!-- BEGIN: Mobile Menu -->
        @include('fragments.dashboard-mobile-menu-fragment')
        <!-- END: Mobile Menu -->

        <!-- BEGIN: Top Bar -->
        @include('fragments.dashboard-topbar-fragment')
        <!-- END: Top Bar -->

        <div class="flex overflow-hidden">
            <!-- BEGIN: Side Menu -->
            @include('fragments.dashboard-sidebar-fragment')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                @yield('body')
            </div>
            <!-- END: Content -->
        </div>

        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <script>
            tinymce.init({
                selector: 'textarea#default-editor'
            });
        </script>
        <!-- END: JS Assets-->
    </div>
@endsection

@section('base_script')
    @yield('script')
@endsection
