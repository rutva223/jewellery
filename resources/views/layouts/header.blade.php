<div class="header-content">
    <nav class="navbar navbar-expand">
        <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left"></div>

            <ul class="navbar-nav header-right">
                {{-- <li class="nav-item dropdown notification_dropdown" onclick="clickPayButton()" style="cursor: pointer"
                    title="Click to Start Tour">
                    <a class="nav-link " style="display: inline-flex;">
                        <i id="introIcon" class="fa fa-refresh"></i>
                    </a>
                </li> --}}
                {{-- <li class="nav-item dropdown notification_dropdown" id="theme_changes" style="cursor: pointer">
                    <a class="nav-link nav-link1 ">
                        <i id="icon-light" class="fas fa-sun {{ $theme == 'light' ? 'd-none' : '' }} "></i>
                        <i id="icon-dark" class="fas fa-moon {{ $theme == 'dark' ? 'd-none' : '' }} "></i>
                    </a>
                </li> --}}

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
