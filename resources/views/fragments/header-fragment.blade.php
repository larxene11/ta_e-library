<nav class="bg-white">
    <div class="max-w-7xl md:flex md:justify-between mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex gap-2 items-center">
          <a href="{{ route('main') }}" class="text-black font-bold text-xl">
            <img alt="E-Library SMANDUTA" class="h-full w-10" src="{{ asset('dist/images/logo-asli.jpg') }}">
          </a>
          <h6 class="text-black align-content-center">E-Library SMANDUTA</h6>
        </div>
        <div class="md:hidden">
          <!-- Hamburger Icon -->
          <button id="mobile-menu-button" type="button" class="text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800" aria-label="Toggle menu">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:block">
        <div class="ml-10 md:mt-3 flex items-baseline space-x-4">
          <a href="#" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Home</a>
          <a href="#" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Catalog</a>
          <a href="{{ route('login') }}" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Sign In</a>
        </div>
      </div>
    </div>
</nav>