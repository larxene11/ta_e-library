@extends('layouts/dashboard-layout')
@section('body')
    <!-- BEGIN: Content -->
    <div class="content col-span-12">
        <div class="intro-y flex items-center -mt-10">
            <h2 class="text-xl font-medium">
                Tambah Data Kategori
            </h2>
            <input type="hidden" value="0" id="package_id">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_category.store') }}" method="POST">
                    @csrf
                    <div class="intro-y box p-5">
                        <div>
                            <label for="name" class="form-label">Category Name</label>
                            @error('name')
                                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                            @enderror
                            <input type="text" name="name" id="category_name" class="form-control" placeholder="Input Category Name" value="{{ old('name')??'' }}">
                        </div>
                        <div class="mt-3">
                            <label for="description" class="form-label">Description</label>
                            @error('description')
                                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                            @enderror
                            <textarea id="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" name="description" placeholder="Input Category Description">{{ old('description')??''}}</textarea>
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_category.all') }}"
                                class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                            <button type="submit"
                                class="btn text-primary btn-primary w-24">Save</button>
                        </div>
                    </div>
                </form>
                <!-- END: Form Layout -->
            </div>
        </div>
    </div>
    <!-- END: Content -->
@endsection
