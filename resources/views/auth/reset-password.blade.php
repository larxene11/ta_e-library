@extends('layouts.dashboard-layout')
@section('body')
<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Change Password -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Change Password
            </h2>
        </div>
        <div class="p-5">
            <form action="{{ route('password-update')  }}" method="post">
                @csrf
                <div>
                    <label for="current_password" class="form-label">Old Password</label>
                    @error('current_password')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                    @enderror
                    <input id="current_password" type="password" name="current_password" class="form-control" placeholder="Input Old Password">
                </div>
                <div class="mt-3">
                    <label for="new_password" class="form-label">New Password</label>
                    @error('new_password')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                    @enderror
                    <input id="new_password" type="password" name="new_password" class="form-control" placeholder="Input New Password">
                </div>
                <div class="mt-3">
                    <label for="new_confirm_password" class="form-label">Confirm New Password</label>
                    @error('new_confirm_password')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                    @enderror
                    <input id="new_confirm_password" name="new_confirm_password" type="password" class="form-control" placeholder="Confirm New Password">
                </div>
                <button class="btn btn-primary mt-4">Change Password</button>
            </form>
        </div>
    </div>
    <!-- END: Change Password -->
</div>
@endsection
