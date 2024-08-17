<ul class="navbar-nav mr-auto">
    <li class="nav-item {{ Route::currentRouteName() === 'indexpage' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('indexpage') }}">Home </a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() === 'aboutpage' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('aboutpage') }}">Resorts</a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() === 'contactpage' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('contactpage') }}">Contact</a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() === 'resortspage' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('resortspage') }}">About</a>
    </li>
</ul>