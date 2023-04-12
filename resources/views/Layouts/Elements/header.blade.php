
        {{-- top bar  --}}
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">{{ config('app.name') }}</li>
            @canor('VER_USUARIOS|EDITAR_USUARIOS|ELIMINAR_USUARIOS')
                <li class="">
                    {{Html::link(route('users.index'), __('general.header.usuarios'))}}
                </li>
            @endcanor
            @canor('VER_PERMISOS|EDITAR_PERMISOS_USUARIO')
                <li class="">
                    {{Html::link(route('permisos.index'), __('general.header.permisos'))}}
                </li>
            @endcanor
            <li class="">
                {{Html::link(route('eventos.calendario'), __('general.header.calendario'))}}
            </li>
            @canor('VER_ESTADISTICAS')
                <li class="">
                    {{Html::link(route('estadisticas.index'), __('general.header.estadisticas'))}}
                </li>
            @endcanor
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
