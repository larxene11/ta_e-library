@extends('layouts.dashboard-layout')
@section('body')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Profile Pegawai
        </h2>
    </div>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                    <img class="rounded-full" src="{{ asset($user->images ? 'storage/' . $user->images->src : 'dist/images/user.jpeg')}}" alt="user photo">
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{$user->name}}</div>
                    <div class="text-slate-500">{{$user->jurusan_jabatan}}</div>
                    <div class="text-slate-500">{{$user->nis_nip}}</div>
                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
                <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                    <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i> {{$user->email}} </div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="map-pin" class="w-4 h-4 mr-2"></i> {{$user->alamat}} </div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="phone" class="w-4 h-4 mr-2"></i> {{$user->tlp}} </div>
                </div>
            </div>
        </div>
        <div>
             <a href="{{ route('profile.update', ['user' =>$user]) }}" class="btn btn-lg btn-primary w-auto mr-1 mb-2 text-base">Update Data Profile</a>
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection