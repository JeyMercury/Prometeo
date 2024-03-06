
        {{-- top bar  --}}
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">{{ config('app.name') }}</li>
        </ul>
    </div>

    <div class="top-bar-right">
        <ul class="menu">
            <ul class="dropdown menu" data-dropdown-menu>
                <li>
                    <a href="#">{{ $user_auth->username }}</a>
                    <ul class="menu">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </ul>
    </div>
</div>
