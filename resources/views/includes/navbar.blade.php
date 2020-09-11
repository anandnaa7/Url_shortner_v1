  <nav class=" navbar navbar-expand navbar-gray navbar-light">
     <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Url Shortner</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @if (Route::has('login'))
            @auth
                <a class="nav-link"href="#">
                    <h5>{{Auth::user()->first_name." ".Auth::user()->last_name }}</h5>
                </a>
                <a class="nav-link"href="{{ route('logout') }}">
                    <span class="badge badge-warning ">Logout</span>
                </a>
            @else
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
            <div class="dropdown-menu">
            <a href="#" class="dropdown-item dropdown-footer">Logout</a>
            </div>
        @endif
    </ul>
  </nav>

