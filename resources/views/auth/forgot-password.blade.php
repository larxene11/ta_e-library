@extends('layouts.front-layout')
@section('body')
<!-- BEGIN: Content -->
    <!-- BEGIN: Change Password -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Change Password
            </h2>
        </div>
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <div class="p-5">
                <input type="hidden" name="token" value="{{ request()->token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                <div class="mt-3">
                    <label for="password" class="form-label">New Password</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Input text">
                </div>
                <div class="mt-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input id="password_confirm" name="password_confirm" type="password" class="form-control" placeholder="Input text">
                </div>
                <button class="btn btn-primary mt-4">Change Password</button>
            </div>
        </form>
    </div>
    <!-- END: Change Password -->
<!-- END: Content -->
@endsection