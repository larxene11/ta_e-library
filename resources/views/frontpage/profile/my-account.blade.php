@extends('layouts.front-layout')
@section('body')
    {{-- BANNER --}}
    <div class="lg:h-full w-full md:h-[300px] h-[250px] relative">
        <img src="{{ asset('dist/images/book1.jpg') }}" alt="" class="object-cover object-center w-full h-96">
        <div class="text-center text-white absolute top-[50%] left-[50%] -translate-x-[50%] w-full -translate-y-[50%]">
            <h2 class="uppercase lg:px-96 md:px-32 px-10 font-bold lg:text-6xl md:text-5xl text-3xl"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Profile Setting
            </h2>
        </div>
    </div>
    {{-- End BANNER --}}
    <div class="max-w-xl mx-auto mt-8 mb-4">
        <form action="{{ route('manage-update.profile', ['user' => auth()->user()]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex">
                <div class="items-center justify-center mr-6 mb-4">
                    <div class="w-40 h-40 bg-gray-300 overflow-hidden">
                        <img src="{{ asset($user->images ? 'storage/' . $user->images->src : 'dist/images/user.jpeg')}}" alt="user photo" class="img-preview">
                    </div>
                    <div class="bg-cyan-700 p-1 text-center rounded-md mt-4">
                        <label for="img_upload" class="text-white font-bold">
                            <span class="text-sm">Change Picture</span>
                            <input type="file" name="image" id="img_upload" class="opacity-0 absolute" onchange="userPreview()" accept="image/*">
                        </label>
                    </div>
                </div>
                <div class="flex-grow">
                    <div class="mb-6">
                        <label for="nis_nip" class="block mb-2 text-sm font-medium text-gray-900 ">NIS</label>
                        <input type="text" id="nis_nip" name="nis_nip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your Name" value="{{old('nis_nip')??$user->nis_nip}}" required>
                    </div>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your Name" value="{{old('name')??$user->name}}" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your Email" value="{{old('email')??$user->email}}" required>
                    </div>
                    <div class="mb-6">
                        <label for="jurusan_jabatan" class="block mb-2 text-sm font-medium text-gray-900 ">Department</label>
                        <input type="text" id="jurusan_jabatan" name="jurusan_jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your Departement" value="{{old('jurusan_jabatan')??$user->jurusan_jabatan}}" required>
                    </div>
                    <div class="mb-6">
                        <label for="tlp" class="block mb-2 text-sm font-medium text-gray-900 ">No Telephone</label>
                        <input type="text" id="tlp" name="tlp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your No Telephone" value="{{old('tlp')??$user->tlp}}" required>
                    </div>
                    <div class="mb-6">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                        <textarea id="alamat" name="alamat" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Input Your Address">{{old('alamat')??$user->alamat}}</textarea>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-cyan-700 text-white rounded-md hover:bg-black">
                            Update Profile
                        </button>
                    </div>    
                </div>
            </div>
        </form>
    </div>
    
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
