<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">Vakasi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "Home") ? 'active' : '' }}"
                        href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "About") ? 'active' : '' }}"
                        href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "Posts") ? 'active' : '' }}"
                        href="/posts">Posts</a>
                </li>
            </ul> --}}

            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome, {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="dashboard">My Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"> Logout</button>
                            </form>
                        </div>
                    </li>
                @else

                    <li class="nav-item">
                        <a class="nav-link {{ ($title === "Login") ? 'active' : '' }}"
                            href="/login">Login</a>
                    </li>

                @endauth
            </ul>

        </div>
    </div>

</nav>
