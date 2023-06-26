@extends('layouts.dashboard-layout')

@section('body')
<h1 class="font-bold capitalize text-2xl">Welcome to {{auth()->user()->level??'Main'}} Dashboard</h1>
@endsection