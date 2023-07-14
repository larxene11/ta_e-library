<nav class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex gap-2 items-center">
                <a href="{{ route('main') }}" class="text-black font-bold text-xl">
                    <img alt="E-Library SMANDUTA" class="h-full w-10" src="{{ asset('dist/images/logo-asli.jpg') }}">
                </a>
                <h6 class="text-black align-content-center">E-Library SMANDUTA</h6>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="#" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="#" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Catalog</a>
                    <a href="{{ route('login') }}" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Sign Up</a>
                    <a href="{{ route('password.request') }}" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Reset Password</a>
                </div>
            </div>
        </div>
    </div>
</nav>