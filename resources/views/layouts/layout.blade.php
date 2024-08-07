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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <x-navbar></x-navbar>
    <div class="pt-20 relative">
        <aside id="sidevar"
            class="fixed top-0 bottom-0 -translate-x-[300px] lg:translate-x-0 lg:flex h-full z-20 w-64 pt-20 flex-col flex-shrink-0 transition duration-300 ease-linear">
            <div
                class="p-3 border-r border-gray-200 min-h-0 flex flex-1 overflow-y-auto flex-col pt-6 divide-y bg-[#1A1D1F] h-full">
                <ul class="space-y-3 pb-6">
                    <!-- Existing Menu Items -->
                    <div class="text-gray-400 font-semibold">
                        MY DESK
                    </div>
                    <li>
                        <a href="{{ route('welcome') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            <span class="ml-3">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gradosYSecciones') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                </path>
                            </svg>
                            <span class="ml-3">Niveles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('notas.index') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-3">Notas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">

                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-3">Cursos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('alumnos.index') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">

                            <svg class="w-6 h-6 fill-current inline-block" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                            <span class="ml-3">Alumnos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('capacidades.index') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm6.905 9.97a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 1 0 1.06 1.06l1.72-1.72V18a.75.75 0 0 0 1.5 0v-4.19l1.72 1.72a.75.75 0 1 0 1.06-1.06l-3-3Z" clip-rule="evenodd" />
                                <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                            </svg>                              
                            <span class="ml-3">Capacidades</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('catedras.index') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd" />
                              </svg>                              
                            <span class="ml-3">Cátedras</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('asignaturas.index') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
                            </svg>                              
                            <span class="ml-3">Asignaturas</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('docentes.index') }}"class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 fill-current inline-block" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M160 64c0-35.3 28.7-64 64-64H576c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H336.8c-11.8-25.5-29.9-47.5-52.4-64H384V320c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v32h64V64L224 64v49.1C205.2 102.2 183.3 96 160 96V64zm0 64a96 96 0 1 1 0 192 96 96 0 1 1 0-192zM133.3 352h53.3C260.3 352 320 411.7 320 485.3c0 14.7-11.9 26.7-26.7 26.7H26.7C11.9 512 0 500.1 0 485.3C0 411.7 59.7 352 133.3 352z" />
                            </svg>
                            <span class="ml-3">Docentes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#272B30] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-3">Reportes</span>
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
                                <path d="M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9l0 28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5l0-24.6c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z"/>
                            </svg>
                            <span class="ml-3">Fichas de Matriculas</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('alumnosMatriculados.index') }}" class="text-base text-gray-400 font-normal rounded-lg flex items-center p-2 hover:bg-[#434343] hover:text-white group hover:scale-105 group transition duration-150 ease-in-out">
                            <svg class="w-6 h-6 fill-current inline-block" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M528 160l0 256c0 8.8-7.2 16-16 16l-192 0c0-44.2-35.8-80-80-80l-64 0c-44.2 0-80 35.8-80 80l-32 0c-8.8 0-16-7.2-16-16l0-256 480 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM272 256a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm104-48c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0z"/>
                            </svg>
                            <span class="ml-3">Alumnos Matriculados</span>
                        </a>
                    </li>
                </ul>
                <div class="space-y-2 pt-6">
                    <a href="{{ route('logout') }}"
                        class="text-base text-gray-400 font-normal rounded-lg hover:bg-[#272B30] flex items-center p-2 group hover:scale-105 group transition duration-150 ease-in-out">
                        <svg class="w-6 h-6 text-gray-400 flex-shrink-0 group-hover:text-white transition duration-75"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                clip-rule="evenodd"></path>
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