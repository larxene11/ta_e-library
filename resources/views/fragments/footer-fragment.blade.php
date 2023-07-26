<footer class="bg-cyan-700 rounded-t-lg shadow">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ route('main') }}" class="flex items-center mb-4 sm:mb-0">
                <img src="{{ asset('dist/images/logofooter.png') }}" class="h-14 mr-3" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Library SMANDUTA</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                @guest
                    <li>
                        <a href="#" class="mr-4 text-white hover:underline md:mr-6 ">Home</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 text-white hover:underline md:mr-6">Catalog</a>
                    </li>
                @else
                    <li>
                        <a href="#" class="mr-4 text-white hover:underline md:mr-6 ">Home</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 text-white hover:underline md:mr-6">Catalog</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 text-white hover:underline md:mr-6">Riwayat</a>
                    </li>
                @endguest
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-300 sm:text-center">© 2023 <a href="https://sman2kuta.sch.id/" class="hover:underline">SMANDUTA™</a>. All Rights Reserved.</span>
    </div>
</footer>

