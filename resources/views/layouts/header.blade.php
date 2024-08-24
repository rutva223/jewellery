<div class="header-content">
    <nav class="navbar navbar-expand">
        <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left"></div>

            <ul class="navbar-nav header-right">
                <li class="nav-item dropdown notification_dropdown" style="font-size: 16px;">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout(event);"
                        aria-expanded="false">
                        <span class="nav-text">Logout<span>
                                <i class="fa fa-power-off"></i>
                    </a>
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>


            </ul>
        </div>
    </nav>
</div>
