<!DOCTYPE html>
<html lang="en">
	@include('front_end.head_link')

	<body class="{{ $body }}">
		<div id="page" class="hfeed page-wrapper">
            @include('front_end.header')
			<div id="site-main" class="site-main">
				<div id="main-content" class="main-content">
					<div id="primary" class="content-area">
                        @yield('content')
					</div><!-- #primary -->
				</div><!-- #main-content -->
			</div>
			@include('front_end.footer')
	</body>
</html>
