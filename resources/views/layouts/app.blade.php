@php
    $theme = Session::get('login_theme') ?? 'light';
    if ($theme == 'light') {
        $path = asset('assets/images/white_theme.png');
    } elseif ($theme == 'dark') {
        $path = asset('assets/images/black_theme.png');
    } else {
        $path = asset('assets/images/white_theme.png');
    }
@endphp

<style>
    .nav-header .side-logo {
        max-width: 15% !important;
    }
</style>

<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Users panels">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.head_links', ['theme' => $theme])
</head>

<body data-theme-version="{{ $theme }}">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header ">
            <a href="#" class="brand-logo">
                {{-- @include('layouts.logo_file') --}}
                <img class="side-logo" src="{{ $path }}"
                    data-light="{{ asset('assets/images/black_theme.png') }}"
                    data-dark="{{ asset('assets/images/white_theme.png') }}" alt="User Profile Picture"
                    class="logo-image">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                    <svg width="20" height="20" viewBox="0 0 26 26" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="22" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                        <rect x="11" width="4" height="4" rx="2" fill="#2A353A" />
                        <rect x="22" width="4" height="4" rx="2" fill="#2A353A" />
                        <rect x="11" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                        <rect x="11" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                        <rect width="4" height="4" rx="2" fill="#2A353A" />
                        <rect y="11" width="4" height="4" rx="2" fill="#2A353A" />
                        <rect x="22" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                        <rect y="22" width="4" height="4" rx="2" fill="#2A353A" />
                    </svg>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            @include('layouts.header', ['theme' => $theme])
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu {{ $theme == 'light' ? 'metismenu-light' : 'metismenu-dark' }}" id="menu">
                    @include('layouts.sidebar', ['theme' => $theme])
                </ul>
            </div>
        </div>

        <div class="content-body default-height">
            <!-- row -->
            <div class="container-fluid">
                <!-- Row -->
                @yield('content')
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="body">

                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer outer-footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="" target="_blank">Blogs</a>
                    <?php echo date('Y'); ?></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
        @yield('modals')
        @stack('before-scripts')
        <!-- Javascript -->
        @include('layouts.scriptfile')

        @stack('after-scripts')
    </div>
</body>

</html>
