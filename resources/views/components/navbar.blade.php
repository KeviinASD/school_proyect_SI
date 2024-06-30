<nav class="fixed w-full border-b border-gray-200 py-4 px-4 lg:px-8 z-40">
    <div class="flex justify-between items-center">
        <div class="flex items-center justify-center gap-1">
            <img src="{{ asset('img/icono.jpg') }}" alt="" class="rounded-xl w-10">
            <p class="text-[#232323] font-bold text-2xl">Headstart</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="" class="block rounded-full bg-gray-100 p-2">
                <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />  <path d="M13.73 21a2 2 0 0 1-3.46 0" /></svg>
            </a>
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/user.jpg') }}" alt="" class="w-10 rounded-full">
                <div>
                    <h1 class="font-semibold">Ivana la Rana</h1>
                    <p class=" text-gray-400">Admin</p>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- <ul>
        @guest
            <li><a href="/login">Login</a></li>
        @else
            <li><a href="/">Home</a></li>
            <li><a href="/logout">Logout</a></li>
        @endguest
    </ul> -->