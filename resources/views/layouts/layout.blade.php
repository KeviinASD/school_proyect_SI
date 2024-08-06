<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>
        @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                        <a href="{{ route('docentes.index') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 fill-current inline-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M160 64c0-35.3 28.7-64 64-64H576c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H336.8c-11.8-25.5-29.9-47.5-52.4-64H384V320c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v32h64V64L224 64v49.1C205.2 102.2 183.3 96 160 96V64zm0 64a96 96 0 1 1 0 192 96 96 0 1 1 0-192zM133.3 352h53.3C260.3 352 320 411.7 320 485.3c0 14.7-11.9 26.7-26.7 26.7H26.7C11.9 512 0 500.1 0 485.3C0 411.7 59.7 352 133.3 352z"/>
                            </svg>
                            <span class="ml-3">Docentes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tipoDocente.index') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 fill-current inline-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96 48 96C21.5 96 0 117.5 0 144L0 464c0 26.5 21.5 48 48 48l208 0 0-96c0-35.3 28.7-64 64-64s64 28.7 64 64l0 96 208 0c26.5 0 48-21.5 48-48l0-320c0-26.5-21.5-48-48-48L473.7 96 337.8 5.4zM96 192l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM96 320l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16c0-8.8-7.2-16-16-16z"/>
                            </svg>
                            <span class="ml-3">Tipo de Docente</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('fichaMatriculas.index') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 fill-current inline-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M528 160l0 256c0 8.8-7.2 16-16 16l-192 0c0-44.2-35.8-80-80-80l-64 0c-44.2 0-80 35.8-80 80l-32 0c-8.8 0-16-7.2-16-16l0-256 480 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM272 256a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm104-48c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0z"/>
                            </svg>
                            <span class="ml-3">Fichas de Matriculas</span>
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