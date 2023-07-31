@extends('layouts.dashboard-layout')
@section('body')
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update Profile
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Display Information
                    </h2>
                </div>
                <div class="p-5">
                    <form action="{{ route('profile.patch',['user' => auth()->user()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col-reverse xl:flex-row">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div>
                                            <label for="name" class="form-label">Name</label>
                                            <input id="name" type="text" name="name" class="form-control" placeholder="Input Your Name" value="{{ $user->name }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="nis_nip" class="form-label">NIP</label>
                                            <input id="nis_nip" type="text" name="nis_nip" class="form-control" placeholder="Input Your NIP" value="{{ $user->nis_nip }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-3" class="form-label">Email</label>
                                            <input id="email" type="text" name="email" class="form-control" placeholder="Input Your Email" value="{{ $user->email }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-4" class="form-label">Phone Number</label>
                                            <input id="tlp" type="text" name="tlp" class="form-control" placeholder="Input Your Phone Number" value="{{ $user->tlp }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-4" class="form-label">Position</label>
                                            <input id="jurusan_jabatan" type="text" name="jurusan_jabatan" class="form-control" placeholder="Input Your Position" value="{{ $user->jurusan_jabatan }}">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-5" class="form-label">Address</label>
                                            <textarea id="alamat" name="alamat" class="form-control" placeholder="Input Your Address">{{ $user->alamat }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-20 mt-3">Save</button>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md img-preview" src="{{ asset($user->images ? 'storage/' . $user->images->src : 'dist/images/user.jpeg')}}" alt="user photo">
                                        <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <label class="btn btn-primary w-full">Change Photo</label>
                                        <input type="file" name="image" id="img_upload" class="w-full h-full top-0 left-0 absolute opacity-0" onchange="userPreview()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection
@section('script')

<script>
    
function userPreview(){
    const image = document.querySelector('#img_upload');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
</script>
@endsection