@extends('layouts.front-layout')
@section('body')
<main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section class="min-h-screen mb-32">
      <div class="relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl" style="background-image: url('dist/images/book1.jpg')">
        <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-60"></span>
        <div class="container z-10">
          <div class="flex flex-wrap justify-center -mx-3">
            <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
              <h1 class="mt-12 mb-2 text-white">Amankan Akun Anda</h1>
              <p class="text-white">Ubah password anda secara berskala</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
          <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
            <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                <h5 class="font-bold">Change Password</h5>
              </div>
              <div class="flex-auto p-6">
                <form action="{{ route('password-update.main') }}" method="post">
                  @csrf
                  <label class="mb-2 ml-1 cursor-pointer select-none text-sm font-bold text-slate-700" for="old_password"> Old Password</label>
                    @error('current_password')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                    @enderror
                  <div class="mb-4">
                    <input type="password" id="current_password" name="current_password" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Old Password" aria-label="old_password" aria-describedby="email-addon" />
                  </div>
                  <label class="mb-2 ml-1 cursor-pointer select-none text-sm font-bold text-slate-700" for="new_password"> New Password</label>
                    @error('new_password')
                          <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                    @enderror
                  <div class="mb-4">
                    <input type="password" id="new_password" name="new_password" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="New Password" aria-label="new_password" aria-describedby="email-addon" />
                  </div>
                  <label class="mb-2 ml-1 cursor-pointer select-none text-sm font-bold text-slate-700" for="new_password_confirm">Konfirmasi Password Baru</label>
                  <div class="mb-4">
                    <input type="password" id="new_confirm_password" name="new_confirm_password" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Konfirmasi Paswword" aria-label="new_password_confirm" aria-describedby="password-addon" />
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Ubah Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection