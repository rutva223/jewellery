<!DOCTYPE html>
<html lang="en">
    @php
        $all_categories = AllCategories();
    @endphp
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
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                $('.btn-add-to-cart').on('click', function(e) {
                    
                    e.preventDefault(); 
                    let productId = $(this).data('product-id');
                    var quantity = $('.qty').val(); // Get the updated 
                    $.ajax({
                        url: '/add-to-cart',  
                        type: 'POST',
                        data: {
                            product_id: productId,
                            quantity: quantity,

                            _token: $('meta[name="csrf-token"]').attr('content') 
                        },
                        success: function(response) {
                        console.log(response);
                        
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
            </script>
	</body>
</html>
