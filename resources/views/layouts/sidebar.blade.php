<style>
    img.logo-image {
        margin-left: 15px;
        width: 200px;
    }

    @media (max-width: 1280px) {
        img.logo-image {
            margin-left: 0;
        }
    }

    #display_count_msg {
        position: absolute;
        top: 8px;
        right: 10px;
    }

    .bg-simple-c-green {
        background: #0ac282;
    }
</style>

<li class="{{ request()->is('dashboard') ? 'mm-active' : '' }}" id="intro_thired">
    <a class="" href="{{ route('dashboard') }}" aria-expanded="false">
        <i class="material-icons">dashboard</i>
        <span class="nav-text ">Dashboard</span>
    </a>
</li>

<li class="{{ request()->is('category/*') ? 'mm-active' : '' }}" id="intro_thired">
    <a class="" href="{{ route('category.index') }}" aria-expanded="false">
        <i class="material-icons">category</i>
        <span class="nav-text">Category</span>
    </a>
</li>

<li class="{{ request()->is('productss/*') ? 'mm-active' : '' }}" id="intro_thired">
    <a class="" href="{{ route('productss.index') }}" aria-expanded="false">
        <i class="material-icons">category</i>
        <span class="nav-text">Product</span>
    </a>
</li>

<li class="{{ request()->is('changes-password') ? 'mm-active' : '' }}" id="">
    <a class="" href="{{ route('changes-password') }}" aria-expanded="false">
        <i class="material-icons">published_with_changes</i>
        <span class="nav-text ">Chnages Password</span>
    </a>
</li>

<li class="">
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout(event);"
        aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="#fd5353" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
        <span class="nav-text">Logout<span>
    </a>
    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>


@push('after-scripts')
    <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>

    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Prevent the default action
            Swal.fire({
                title: 'Are you sure you want to logout?',
                text: 'You will need to log in again to continue.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
