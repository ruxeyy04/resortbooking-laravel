<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'inchargeIndex' ? 'active' : '' }}" href="{{ route('inchargeIndex') }}">
            Users <span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'inchargeResorts' ? 'active' : '' }}" href="{{ route('inchargeResorts') }}">
            Resorts
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'inchargeRooms' ? 'active' : '' }}" href="{{ route('inchargeRooms') }}">
            Rooms
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'inchargeReserved' ? 'active' : '' }}" href="{{ route('inchargeReserved') }}">
            Reserved
        </a>
    </li>
</ul>