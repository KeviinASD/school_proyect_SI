<nav>
    <ul>
        @guest
            <li><a href="/login">Login</a></li>
        @else
            <li><a href="/">Home</a></li>
            <li><a href="/logout">Logout</a></li>
        @endguest
    </ul>
</nav>