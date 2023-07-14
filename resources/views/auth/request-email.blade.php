@extends('layouts.front-layout')
@section('body')
<!-- BEGIN: Content -->
    <!-- BEGIN: Change Password -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Request Reset Password
            </h2>
            <p>Please enter your email to request reset password</p>
        </div>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="p-5">
                <div class="mt-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input id="email" type="email" class="form-control" placeholder="Input text" name="email">
                </div>
                <button class="btn btn-primary mt-4">Send Email</button>
            </div>
        </form>
    </div>
    <!-- END: Change Password -->
<!-- END: Content -->
@endsection