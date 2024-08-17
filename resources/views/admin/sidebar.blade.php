<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'adminIndex' ? 'active' : '' }}" href="{{ route('adminIndex') }}">
            Users <span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'adminResorts' ? 'active' : '' }}" href="{{ route('adminResorts') }}">
            Resorts
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'adminRooms' ? 'active' : '' }}" href="{{ route('adminRooms') }}">
            Rooms
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'adminReserved' ? 'active' : '' }}" href="{{ route('adminReserved') }}">
            Reserved
        </a>
    </li>
</ul>