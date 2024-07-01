<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>
        @yield('title')
    </title>
</head>

<body>
    <x-navbar></x-navbar>
    <div class="pt-20 relative">
        <aside id="sidevar" class="fixed top-0 bottom-0 -translate-x-[300px] lg:translate-x-0 lg:flex h-full z-20 w-64 pt-20 flex-col flex-shrink-0 transition duration-300 ease-linear">
            <div class="p-3 border-r border-gray-200 min-h-0 flex flex-1 overflow-y-auto flex-col pt-6 divide-y bg-[#232323] h-full">
                <ul class="space-y-3 pb-6">
                    <li>
                        <a href="{{ route('welcome') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            <span class="ml-3">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-3">Reportes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-3">Tablas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 fill-current inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                            </svg>
                            <span class="ml-3">Alumnos</span>
                        </a>
                    </li>
                </ul>
                <div class="space-y-2 pt-6">
                    <a href="{{ route('logout') }}" class="text-base text-gray-400 font-normal rounded-lg hover:bg-[#434343] flex items-center p-2 group hover:scale-105 group transition duration-150 ease-in-out">
                        <svg class="w-6 h-6 text-gray-400 flex-shrink-0 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap group-hover:text-white">Log Out</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>
    <div class="p-8 lg:pl-72 transition-all duration-300">
        @yield('content')
    </div>

    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>