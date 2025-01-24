@extends('front_end.app')
@section('content')

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
                                                <img src="{{ $p->images[0] }}" width="600" height="600" alt="Product Image" class="post-image">
                                                @if (isset($p->images[1]))
                                                    <img src="{{ $p->images[1] }}" width="600" height="600" alt="Product Image" class="hover-image back">
                                                @else
                                                    <img src="{{ $p->images[0] }}" width="600" height="600" alt="Product Image" class="hover-image back">
                                                @endif
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
                                            <ins><span>₹{{ $p->total }}</span></ins>
                                        </div>
                                        <div class="wishlist-item-time">Qty: {{ $p->quantity }} </div>
                                        <div class="wishlist-item-time">{{ $p->created_at ? $p->created_at->format('F j, Y') : \Carbon\Carbon::today()->format('F j, Y') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    });
</script>
@endpush
