<!DOCTYPE html>
<html lang="en">

<head>
    @include('auth.layout.head')
</head>

<body>
    <div data-bs-spy="scroll" data-bs-target="#navbar-scroll" data-bs-root-margin="0px 0px -40%"
        data-bs-smooth-scroll="true" tabindex="0">
        <!-- WRAPPER -->
        <div id="wrapper" class="theme-cyan">
            <div class="vertical-align-wrap">
                <div class="vertical-align-middle auth-main">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END WRAPPER -->
    </div>
    @stack('before-scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('after-scripts')
</body>

</html>
