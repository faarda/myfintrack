    <nav>
        <div class="logo"><img src="{{asset('images/logo.png')}}" alt=""></div>
        <span class="hamburger" id="toggle-nav"></span>

        <ul class="nav animated fadeIn" id="nav">
            @auth
                <li>
                    <a href="{{'dashboard'}}" class="nav-item @if(request()->is('dashboard')) active @endif">Dashboard</a>
                </li>
                <li>
                    <a href="{{'spendings'}}" class="nav-item @if(request()->is('spendings')) active @endif">Spendings</a>
                </li>
                <li>
                    <a href="{{"earnings"}}" class="nav-item @if(request()->is('earnings')) active @endif">Earnings</a>
                </li>
                <li class="nav-user dropdown" id="dropdown">
                    <div class="user-img">
                        <img src="../images/user-icon.png" alt="">
                    </div>
                    <span class="name">{{ explode(" ", Auth::user()->name)[0]}}</span>
                    <span data-feather="chevron-down" class="drop-icon"></span>

                    <div class="dropdown-main" id="dropdown-main">
                        <ul class="dropdown-list">
                            <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </li>
            @else
                <li>
                    <a href="/" class="nav-item @if(request()->is('/')) active @endif">Home</a>
                </li>
                <li>
                    <a href="contact" class="nav-item @if(request()->is('contact')) active @endif">Contact</a>
                </li>
{{--                 <li>
                    <a href="faq" class="nav-item @if(request()->is('faq')) active @endif">FAQ</a>
                </li>
                <li>
                    <a href="blog" class="nav-item @if(request()->is('blog')) active @endif">Blog</a>
                </li> --}}
                <li>
                    <a href="{{route('login')}}" class="nav-item @if(request()->is('login')) active @endif">Login</a>
                </li>
                <li>
                    <a href="{{route('register')}}" class="nav-item @if(request()->is('register')) active @endif">Sign Up</a>
                </li>
                <li>
                    <a href="" class="btn btn-outline btn-sm">Download App</a>
                </li>
            @endauth
        </ul>
    </nav>