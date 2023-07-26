<nav class="bg-cyan-700">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="{{ route('main') }}" class="flex items-center">
      <img src="{{ asset('dist/images/logofooter.png') }}" class="h-8 mr-3" alt="Logo Website" />
      <span class="self-center text-xl font-semibold whitespace-nowrap text-white">E-Library SMANDUTA</span>
  </a>
  <div class="flex items-center md:order-2">
      <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="{{ asset('dist/images/user.jpeg') }}" alt="user photo">
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow " id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 ">{{ auth()->user()->name}}</span>
          <span class="block text-sm  text-gray-500 truncate ">{{ auth()->user()->jurusan_jabatan}}</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="{{ route('my-account') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Profile</a>
          </li>
          <li>
            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Sign out</a>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div class="items-end justify-between hidden md:pl-[500px] w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg bg-cyan-700 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-cyan-700">
      <li>
        <a href="{{ route('main') }}" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-white md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 ">Home</a>
      </li>
      <li>
        <a href="{{ route('buku-catalog') }}" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-white md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 ">Catalog</a>
      </li>
      <li>
        <a href="#" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-white md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 ">History</a>
      </li>
    </ul>
  </div>
  </div>
</nav>
