<!DOCTYPE html>
<html lang="en">
@php
    $all_categories = AllCategories();
    $user_id = Session::has('login_id');
    $wishlistCount = App\Models\Wishlist::where('user_id', $user_id)->count();
    $CartCount = App\Models\Cart::where('user_id', $user_id)->count();
@endphp

@include('front_end.head_link')

<body class="{{ $body }}">
    <div id="page" class="hfeed page-wrapper">
        @include('front_end.header', compact('all_categories', 'wishlistCount', 'CartCount'))
        <div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    @yield('content')
                </div><!-- #primary -->
            </div><!-- #main-content -->
        </div>
        @include('front_end.footer')
</body>


<script>
    $(document).ready(function() {
        var isLoggedIn = @json(Session::has('login_id')); // Pass login status as a JavaScript variable

        // Function to handle adding to cart
        function addToCart(productId, quantity, button) {
            $.ajax({
                url: "{{ route('addToCart') }}",
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    updateCartCount();

                    // Update cart list
                    var cartListHtml = '';
                    response.carts.forEach(function(cart) {
                        var imageUrl = JSON.parse(cart.image)[0]; // Adjust image parsing as needed
                        cartListHtml += `
                            <li class="mini-cart-item">
                                <a href="#" class="remove cart-remove" title="Remove this item" data-product-id="${cart.product_id}"><i class="icon_close"></i></a>
                                <a href="shop-details.html" class="product-image"><img width="600" height="600" src="${imageUrl}" alt=""></a>
                                <a href="shop-details.html" class="product-name">${cart.product_name}</a>
                                <div class="quantity">Qty: ${cart.quantity}</div>
                                <div class="price">₹${cart.total}</div>
                            </li>
                        `;
                    });
                    $('.cart-list').html(cartListHtml);

                    // Update total price
                    $('.total-price span').text('₹' + response.total_amount);

                    // Show success message and view cart button
                    button.removeClass("loading").addClass("added");
                    button.closest("div").append(
                        '<a href="{{ route('view-cartlist') }}" class="added-to-cart product-btn" title="View cart" tabindex="0">View cart</a>'
                    );
                    $("body").append(
                        '<div class="cart-product-added"><div class="added-message">Product was added to cart successfully!</div></div>'
                    );
                    setTimeout(function() {
                        $(".cart-product-added").remove();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log error for debugging
                }
            });
        }

        function updateCartCount() {
            $.ajax({
                url: '{{ route('count-cart') }}', // Create a route to return the updated wishlist count
                type: 'GET',
                success: function(data) {
                    $('.cart-count').text(data.count); // Update the wishlist count in the header
                },
                error: function() {
                    alert('Failed to update wishlist count.');
                }
            });
        }

        // Click handler for the "Add to Cart" button
        $(document).on("click", ".btn-add-to-cart", function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var quantity = $('.qty').val(); // Get the quantity
            var button = $(this).find("a"); // Get the specific button clicked

            // Check if user is logged in (based on the value from Blade)
            if (isLoggedIn) {
                // If logged in, proceed to add the item to the cart
                addToCart(productId, quantity, button);
            } else {
                // If not logged in, show login form
                $(".form-login-register").addClass("active");

                // Event handler for the login button
                $(".active-login").off("click").on("click", function(e) {
                    e.preventDefault();

                    isLoggedIn = true; // Set logged-in state to true
                    $(".form-login-register").removeClass("active"); // Hide the login modal
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var isLoggedIn = @json(Session::has('login_id')); // Pass login status as a JavaScript variable

        $(document).on("click", ".btn-wishlist", function(e) {
            e.preventDefault();
            var heartIcon = $(this).find('i');
            var productId = $(this).data('product-id');

            // Check if the user is logged in
            if (isLoggedIn) {
                // User is logged in, proceed to add to wishlist
                $.ajax({
                    url: '{{ route('add-wishlist') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        product_id: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            // Toggle heart icon on success
                            if (heartIcon.hasClass('empty-heart')) {
                                heartIcon.removeClass('empty-heart').addClass(
                                    'filled-heart');
                            } else {
                                heartIcon.removeClass('filled-heart').addClass(
                                    'empty-heart');
                            }
                            updateWishlistCount();
                            $("body").append(
                                '<div class="cart-product-added"><div class="added-message">Product was added to Wishlist successfully!</div></div>'
                            );
                        } else {
                            // alert('Failed to add to wishlist. Please try again.');
                            $("body").append(
                                '<div class="cart-product-added"><div class="added-message">Product already in your wishlist!</div></div>'
                            );
                        }
                    },
                    error: function() {
                        $("body").append(
                            '<div class="cart-product-added"><div class="added-message">Something went wrong!</div></div>'
                        );
                    }
                });
            } else {
                // User is not logged in, show login form
                $(".form-login-register").addClass("active");
                // Optionally, you can also attach a click event to the login button here
                // so that after a successful login, the product can be added to the wishlist
                $(".active-login").off("click").on("click", function(e) {
                    e.preventDefault();
                });
            }
        });

        function updateWishlistCount() {
            $.ajax({
                url: '{{ route('count-wishlist') }}', // Create a route to return the updated wishlist count
                type: 'GET',
                success: function(data) {
                    $('.count-wishlist').text(data
                    .count); // Update the wishlist count in the header
                },
                error: function() {
                    alert('Failed to update wishlist count.');
                }
            });
        }
    });
</script>

</html>
