@extends('front_end.app')
@section('content')

<link rel="stylesheet" href="{{ asset('front_end/assets/css/cart-custom.css') }}">

<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
            Cart
            </h1>
        </div>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a>
            <span class="delimiter"></span> Shopping Cart
        </div>
    </div>
</div>

<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="shop-wishlist">
                @if (count($cart) > 0)
                    <table class="wishlist-items">
                        <tbody>
                            @foreach ($cart as $p)
                                <tr class="wishlist-item">
                                    <td class="wishlist-item-remove">
                                        <a href="javascript:void(0);" class="remove-from-cart" data-id="{{ $p->id }}">
                                            <span></span>
                                        </a>
                                    </td>
                                    <td class="wishlist-item-image">
                                        <a href="{{ route('product_detail', $p->id) }}">
                                            @if (is_array($p->images) && count($p->images) > 0)
                                                <img src="{{ $p->images[0] }}" width="600" height="600" alt="Product Image">
                                            @else
                                                <img src="{{ asset('front_end/media/product/1.jpg') }}" width="600" height="600" alt="Default Image">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="wishlist-item-info">
                                        <div class="wishlist-item-name">
                                            <a href="{{ route('product_detail', $p->id) }}">{{ $p->product->product_name }}</a>
                                        </div>
                                        <div class="wishlist-item-price">
                                            <ins><span class="unit-price" data-id="{{ $p->id }}">₹{{ $p->price }}</span></ins>
                                        </div>
                                        <div class="wishlist-item-quantity" style="margin: 10px 0;">
                                            <button type="button" class="qty-minus" data-id="{{ $p->id }}" style="width: 25px; height: 25px; border: 1px solid #ddd; background: #fff; cursor: pointer; line-height: 1;">-</button>
                                            <input type="text" class="qty-input" data-id="{{ $p->id }}" value="{{ $p->quantity }}" style="width: 40px; height: 25px; text-align: center; border: 1px solid #ddd; margin: 0 5px;" readonly>
                                            <button type="button" class="qty-plus" data-id="{{ $p->id }}" style="width: 25px; height: 25px; border: 1px solid #ddd; background: #fff; cursor: pointer; line-height: 1;">+</button>
                                        </div>
                                        <div class="wishlist-item-subtotal">
                                            Subtotal: <span class="item-total" data-id="{{ $p->id }}" data-price="{{ $p->price }}">₹{{ $p->total }}</span>
                                        </div>
                                        <div class="wishlist-item-time">{{ $p->created_at ? $p->created_at->format('F j, Y') : \Carbon\Carbon::today()->format('F j, Y') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cart-actions">
                        <div class="cart-totals">
                            <h3>Total: ₹<span id="cart-total">{{ $cart->sum('total') }}</span></h3>
                            <a href="{{ route('checkout', ['id' => 'cart']) }}" class="button btn checkout">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center">There are no products on the cartlist!</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('after-scripts')
<script>
    $(document).ready(function(){
        $('.remove-from-cart').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var token = '{{ csrf_token() }}'; // CSRF token for security

            $.ajax({
                url: "{{ route('delete.to.cart') }}",
                type: 'POST',
                data: {
                    "_token": token,
                    "id": id,
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Optionally remove the row from the table
                        $('a[data-id="'+id+'"]').closest('.wishlist-item').remove();

                        updateWishlistCount();
                        updateCartTotal();
                    } else {
                        $("body").append(
                            '<div class="cart-product-added"><div class="added-message">Product was added to Cart successfully!</div></div>'
                        );
                    }
                },
                error: function(response) {
                    alert('An error occurred while removing the item.');
                }
            });
        });

        function updateWishlistCount() {
            $.ajax({
                url: '{{ route('count-cart') }}', // Create a route to return the updated wishlist count
                type: 'GET',
                success: function(data) {
                    $('.cart-count').text(data.count);  // Update the wishlist count in the header
                },
                error: function() {
                    alert('Failed to update cart count.');
                }
            });
        }

        function updateCartTotal() {
            var total = 0;
            $('.item-total').each(function() {
                var itemTotal = $(this).text().replace('₹', '');
                total += parseFloat(itemTotal) || 0;
            });
            $('#cart-total').text(total.toFixed(2));
            
            // Hide checkout button if cart is empty
            if ($('.wishlist-item').length === 0) {
                $('.cart-actions').hide();
                $('.shop-wishlist').html('<div class="text-center">There are no products on the cartlist!</div>');
            }
        }

        // Quantity controls
        $('.qty-minus').on('click', function() {
            var id = $(this).data('id');
            var input = $('.qty-input[data-id="' + id + '"]');
            var currentVal = parseInt(input.val());
            
            if (currentVal > 1) {
                input.val(currentVal - 1);
                updateQuantity(id, currentVal - 1);
            }
        });

        $('.qty-plus').on('click', function() {
            var id = $(this).data('id');
            var input = $('.qty-input[data-id="' + id + '"]');
            var currentVal = parseInt(input.val());
            
            input.val(currentVal + 1);
            updateQuantity(id, currentVal + 1);
        });

        function updateQuantity(cartId, quantity) {
            $.ajax({
                url: '{{ route("update.cart.quantity") }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": cartId,
                    "quantity": quantity
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Update item total
                        var price = $('.item-total[data-id="' + cartId + '"]').data('price');
                        var newTotal = (price * quantity).toFixed(2);
                        $('.item-total[data-id="' + cartId + '"]').text('₹' + newTotal);
                        
                        // Update cart total
                        updateCartTotal();
                    } else {
                        alert('Error updating quantity');
                    }
                },
                error: function() {
                    alert('Error updating quantity');
                }
            });
        }
    });
</script>
@endpush
