<style>
    .navbar-border{
        border-bottom: 3px solid #007bff;
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top bg-white navbar-border py-3">
  <div class="container-fluid px-5">
    
    <a href="{{route('home')}}"style="color:#007bff;">Job Friends</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

            <li class="nav-item mx-3">
                <a class="nav-link active" aria-current="page" href="{{route('shop')}}">Shop</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link active" aria-current="page" href="{{route('chat')}}">Chat</a>
            </li>
        </ul>
        
        <form class="d-flex mx-3" role="search" action="{{route('search')}}" method="GET">
            <input class="form-control me-2" type="search" name="search"placeholder="Search" aria-label="Search" required>
            <button class="btn btn-primary" type="submit" style="color:white;">Search</button>
        </form>
        <a class="nav-link" href="{{route('notification')}}">
            <img src="{{ asset('img/notif.png') }}" alt="Profile" class="profile-logo me-2" style="height: 35px;">
        </a>
        <a class="nav-link" href="{{route('user')}}">
            <img src="{{ asset('img/profile.png') }}" alt="Profile" class="profile-logo me-2" style="height: 35px;">
        </a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li>
                <a class="btn btn-light" href="set-locale/en">ENG</a>
                <a class="btn btn-light" href="set-locale/id">ID</a>
            </li>
        </ul>
        
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
  </div>
</nav>