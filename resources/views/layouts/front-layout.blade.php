@extends('layouts.base-layout')

@section('base_head')
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/appMy.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @yield('head')
@endsection

@section('base_body')
    @if (session()->has('status'))
    @include('fragments.alert')
    @endif
    @if (session()->has('status'))
    @include('fragments.error')
    @endif
    @if (session()->has('status'))
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
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script>
        // Ambil elemen tombol hamburger dan menu
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
      
        // Tambahkan event listener untuk tombol hamburger
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden'); // Tampilkan/sembunyikan menu saat tombol diklik
        });
    </script>
    <script>
        // Ambil elemen-elemen yang dibutuhkan
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
      
        // Tambahkan event listener untuk tombol User Menu
        userMenuButton.addEventListener('click', function() {
          userMenu.classList.toggle('hidden'); // Tampilkan/sembunyikan menu saat tombol diklik
        });
      
        // Menutup menu ketika user mengklik di luar menu
        document.addEventListener('click', function(event) {
          const targetElement = event.target;
          if (!userMenu.contains(targetElement) && targetElement !== userMenuButton) {
            userMenu.classList.add('hidden');
          }
        });
    </script>
@endsection