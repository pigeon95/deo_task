<ul class="navbar-nav ml-auto">
    @if(Auth::check())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">@lang('theme::main.logout')</a>
                <form id="logout-form"
                      action="{{ url('/logout') }}"
                      method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ url('/login') }}" class="nav-link">@lang('theme::main.login')</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/register') }}" class="nav-link">@lang('theme::main.register')</a>
        </li>
    @endif
</ul>