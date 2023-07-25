<nav class="bg-cyan-700">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
    <a href="{{ route('main') }}" class="flex items-center">
        <img src="{{ asset('dist/images/logofooter.png') }}" class="h-10 mr-2" alt="Logo Website" />
        <span class="self-center text-xl font-semibold whitespace-nowrap text-white">E-Library SMANDUTA</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg bg-cyan-700 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-cyan-700">
        <li>
          <a href="#" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-white md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 ">Home</a>
        </li>
        <li>
          <a href="#" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-white md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 ">Catalog</a>
        </li>
        <li>
          <a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-white md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 ">Sign In</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
