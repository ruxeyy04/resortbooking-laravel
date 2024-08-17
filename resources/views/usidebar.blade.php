<ul class="navbar-nav mr-auto">
    <li class="nav-item {{ Route::currentRouteName() === 'uindex' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('uindex') }}">Home </a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() === 'uresorts' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('uresorts') }}">Resorts</a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() === 'ucontact' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ucontact') }}">Contact</a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() === 'uabout' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('uabout') }}">About</a>
    </li>
</ul>