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
                    <div class="flex flex-col-reverse xl:flex-row">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 2xl:col-span-6">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <label for="update-profile-form-1" class="form-label">Display Name</label>
                                            <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="Kevin Spacey">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-2" class="form-label">Nearest MRT Station</label>
                                            <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="Kevin Spacey">
                                        </div>
                                        <div class="mt-3 2xl:mt-0">
                                            <label for="update-profile-form-3" class="form-label">Postal Code</label>
                                            <select id="update-profile-form-3" data-search="true" class="tom-select w-full">
                                                <option value="1">018906 - 1 STRAITS BOULEVARD SINGA...</option>
                                                <option value="2">018910 - 5A MARINA GARDENS DRIVE...</option>
                                                <option value="3">018915 - 100A CENTRAL BOULEVARD...</option>
                                                <option value="4">018925 - 21 PARK STREET MARINA...</option>
                                                <option value="5">018926 - 23 PARK STREET MARINA...</option>
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-4" class="form-label">Phone Number</label>
                                            <input id="update-profile-form-4" type="text" class="form-control" placeholder="Input text" value="65570828">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-5" class="form-label">Address</label>
                                            <textarea id="update-profile-form-5" class="form-control" placeholder="Adress">10 Anson Road, International Plaza, #10-11, 079903 Singapore, Singapore</textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <button type="" class="btn btn-primary w-20 mt-3">Save</button>
                        </div>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/profile-10.jpg">
                                    <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                </div>
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    <button class="btn btn-primary w-full">Change Photo</button>
                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection