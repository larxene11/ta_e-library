<div class="fixed bg-slate-900 w-screen h-screen bg-opacity-50 z-[999999]" id="alert">
    <div class="absolute top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-5 py-10 shadow-md"
        role="alert">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                </svg></div>
            <div>
                <p class="font-bold">SUCCESS!</p>
                <p class="text-sm">{!! session()->get('success') !!}</p>
            </div>
        </div>
        <div class="flex justify-end pt-5">
            <button onclick="btn_close()" class="bg-red-600 rounded-sm p-3 py-1 font-medium text-white">Close</button>
        </div>
    </div>
</div>

<script>
    function btn_close() {
        document.getElementById("alert").style.display = "none";
    }
</script>
