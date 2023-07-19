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
      <div class="ml-10 md:mt-1 flex items-baseline space-x-4">
        <a href="#" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Home</a>
        <a href="#" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">Catalog</a>
        <a href="#" class="text-black hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">History</a>
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
          <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
              aria-expanded="false" data-tw-toggle="dropdown">
              <img alt="Midone - HTML Admin Template" src="/image/icon/avatar.png">
          </div>
          <div class="dropdown-menu w-56">
              <ul class="dropdown-content bg-primary text-white">
                  <li class="p-2">
                      <div class="font-medium">{{ auth()->user()->name ??'Username'}}</div>
                      <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500 capitalize">{{auth()->user()->level??'user'}}
                      </div>
                  </li>
                  <li>
                      <hr class="dropdown-divider border-white/[0.08]">
                  </li>
                  <li>
                      <a href="{{ route('profile.detail') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="user"
                              class="w-4 h-4 mr-2"></i> Profile </a>
                  </li>
                  <li>
                      <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock"
                              class="w-4 h-4 mr-2"></i> Reset Password </a>
                  </li>
                  <li>
                      <hr class="dropdown-divider border-white/[0.08]">
                  </li>
                  <li>
                      <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right"
                              class="w-4 h-4 mr-2"></i> Logout </a>
                  </li>
              </ul>
          </div>
      </div>
  <!-- END: Account Menu -->
      </div>
    </div>
  </div>
</nav>