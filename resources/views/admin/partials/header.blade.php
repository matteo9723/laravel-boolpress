<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid justify-content-between ">
            <div>

                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Vai al sito</a>

                        @auth
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.index') }}">Dashboard</a>
                            <a class="nav-link " aria-current="page" href="{{ route('admin.posts.index') }}">Elenco post</a>
                            <a class="nav-link" href="{{ route('admin.posts.create') }}">Crea nuovo post</a>
                        @endauth

                        </div>
                    </div>
            </div>
            <div>
                <div class="navbar-nav">
                    @auth
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endguest
                </div>
            </div>

        </div>
      </nav>
</header>
