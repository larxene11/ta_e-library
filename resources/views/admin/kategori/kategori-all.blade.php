@extends('layouts/dashboard-layout')
@section('body')
<!-- BEGIN: Content -->
<h2 class="intro-y text-lg font-medium mt-10">
    All Category
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('manage_category.create') }}" class="btn btn-primary shadow-md mr-2">Add New Category</a>
        <div class="hidden md:block mx-auto text-slate-500"></div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <form action="{{ route('manage_book.all') }}" method="get">
                        <div class="flex justify-center items-center">
                            @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}"> 
                            @endif
                            <div class="flex">
                                <input type="text" name="search" class="form-control w-56 box pr-10" style="border-top-right-radius: 0!important;
                                    border-bottom-right-radius: 0!important;" placeholder="Search...">
                                <button type="submit" class="bg-[#2d2d2d]" style="border-top-right-radius: 0.25rem!important;
                                    border-bottom-right-radius: 0.25rem!important;"><i class="w-4 h-4 mx-3 text-white rounded-sm"  data-lucide="search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-nowrap">NO.</th>
                    <th class="text-center whitespace-nowrap">NAME</th>
                    <th class="text-center whitespace-nowrap">DESCRIPTION</th>
                    <th class="text-center whitespace-nowrap">BOOKS QTY</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index=>$item)
                 <tr class="intro-x">
                    <td class="text-center w-20"> {{ $loop->iteration }} </td>
                    <td class="text-center w-44">{{ $item->name }}</td>
                    <td class="text-center">{{ Str::words(html_entity_decode(strip_tags($item->description)), 30, '...') }}</td>
                    <td class="text-center">{{ $item->books->count() }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{ route('manage_category.update',['category'=>$item]) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                            <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" onclick="deleteModalHandler({{$index}})"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            <input type="hidden" id="delete_route_{{$index}}" value="{{ route('manage_category.delete',['category'=>$item]) }}">
                        </div>
                    </td>
                </tr>   
                @empty
                <tr>
                    <td class="text-center text-muted" colspan="5">No Data</td>
                </tr>
                @endforelse
                
                
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
     <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            {{ $categories->links('fragments.pagination') }}
        </nav>
    </div>
    <!-- END: Pagination -->
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">
                        Do you really want to delete these records? 
                        <br>
                        This process cannot be undone.
                    </div>
                </div>
                <div class="px-5 pb-8 flex justify-center items-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <form id="deleteItem" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="" id="delete_route_input">
                        <button type="submit" class="btn btn-danger w-24">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('dist/js/view/manage-category/category.js') }}"></script> 
@endsection