@extends('layouts.front-layout')
@section('body')
    {{-- BANNER --}}
    <div class="lg:h-full w-full md:h-[500px] h-[500px] relative">
        <img src="{{ asset('dist/images/book1.jpg') }}" alt="" class="object-cover object-center w-full h-96">
        <div class="text-center text-white absolute top-[50%] left-[50%] -translate-x-[50%] w-full -translate-y-[50%]">
            <h2 class="uppercase lg:px-96 md:px-32 px-10 font-bold lg:text-6xl md:text-5xl text-3xl"
                style="text-shadow: 2px 2px 10px rgb(70, 70, 70);">Profile Setting
            </h2>
        </div>
    </div>
    {{-- End BANNER --}}
    <div class="max-w-xl mx-auto mt-8 mb-4">
        <form action="{{ route('manage-update.profile', ['user' => Auth::user()]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="flex">
                <div class="items-center justify-center mb-4">
                    <div class="w-40 h-40 bg-gray-300 overflow-hidden">
                        <img src="{{ asset(auth()->user()->images->count() ? 'storage/' . auth()->user()->images->src : 'dist/images/user.jpeg')}}" alt="user photo">
                    </div>
                    <div class="upload__box items-center mt-4">
                        <label for="upload__btn profile_picture" class="block text-gray-700 font-bold">Profile Picture</label>
                        <input type="file" name="image" id="img_upload" class="upload__inputfile form-input mt-1 w-full" accept="image/*">
                    </div>
                </div>
                <div class="flex-grow">
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                        <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your Name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your Email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Department</label>
                        <input type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your Departement" value="{{ Auth::user()->jurusan_jabatan }}" required>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">No Telephone</label>
                        <input type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Input Your No Telephone" value="{{ Auth::user()->tlp }}" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Input Your Address">{{ Auth::user()->alamat }}</textarea>
                    </div>
                    
                    <div class="mt-4">
                        <button class="px-4 py-2 bg-cyan-700 text-white rounded-md hover:bg-black">
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
    jQuery(document).ready(function () {
        ImgUpload();
    });

function ImgUpload() {
    var imgWrap = "";
    var imgArray = [];

    $(".upload__inputfile").each(function () {
        $(this).on("change", function (e) {
            imgWrap = $(this).closest(".upload__box").find(".upload__img-wrap");
            var maxLength = $(this).attr("data-max_length");

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            var iterator = 0;
            filesArr.forEach(function (f, index) {
                if (!f.type.match("image.*")) {
                    return;
                }

                if (imgArray.length > maxLength) {
                    return false;
                } else {
                    var len = 0;
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i] !== undefined) {
                            len++;
                        }
                    }
                    if (len > maxLength) {
                        return false;
                    } else {
                        imgArray.push(f);

                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var html =
                                "<div class='upload__img-box'><div style='background-image: url(" +
                                e.target.result +
                                ")' data-number='" +
                                $(".upload__img-close").length +
                                "' data-file='" +
                                f.name +
                                "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                            imgWrap.append(html);
                            iterator++;
                        };
                        reader.readAsDataURL(f);
                    }
                }
            });
        });
    });
    $("body").on("click", ".upload__img-close", function (e) {
        var file = $(this).parent().data("file");
        if (file.includes("storage")) {
            let deleted_images = $("#deleted_images").val();
            deleted_images += $(this).parent().data("id") + ",";
            $("#deleted_images").val(deleted_images);
            console.log($("#deleted_images").val());
        }
        for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
                imgArray.splice(i, 1);
                break;
            }
        }
        $(this).parent().parent().remove();
    });
}
</script>
@endsection
