@extends('layouts.dashboard-layout')

@section('body')
    <h2 class="text-2xl">Selamat Datang di Halaman Dashboard {{auth()->user()->level??'Main'}}</h2>
@endsection