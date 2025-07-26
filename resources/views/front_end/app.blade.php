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

<style>
    .added-to-cart-btn a,
    .btn-view-cart a.added-to-cart {
        background-color: #4CAF50 !important;
        color: white !important;
        transition: all 0.3s ease;
    }
    
    .added-to-cart-btn a:hover,
    .btn-view-cart a.added-to-cart:hover {
        background-color: #45a049 !important;
    }
    
    .cart-product-added {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background: rgba(76, 175, 80, 0.95);
        padding: 20px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        animation: fadeInUp 0.3s ease;
    }
    
    .cart-product-added .added-message {
        color: white;
        font-size: 16px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .cart-product-added .fa-check-circle {
        font-size: 20px;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate(-50%, -40%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }
    
    .btn-add-to-cart a.added {
        animation: pulse 0.5s ease;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>

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
                    button.html('<i class="fa fa-check"></i> Added to cart');
                    button.closest(".btn-add-to-cart").removeClass("btn-add-to-cart").addClass("added-to-cart-btn");
                    
                    // Replace the add to cart button with view cart button after a short delay
                    setTimeout(function() {
                        button.parent().html('<a href="{{ route('view-cartlist') }}" class="added-to-cart product-btn" title="View cart" tabindex="0"><i class="fa fa-shopping-cart"></i> View cart</a>');
                    }, 1000);
                    
                    $("body").append(
                        '<div class="cart-product-added"><div class="added-message"><i class="fa fa-check-circle"></i> Product was added to cart successfully!</div></div>'
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
            
            // Get quantity - check if there's a quantity input nearby (product detail page)
            var quantityInput = $(this).closest('.add-to-cart-wrap').find('.qty');
            var quantity = quantityInput.length > 0 ? quantityInput.val() : 1; // Default to 1 if no quantity input
            
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
