@extends('front_end.app')
@section('content')

<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
                Wishlist
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
                @if (count($products) > 0)
                    <table class="wishlist-items">
                        <tbody>
                            @foreach ($products as $p)
                                <tr class="wishlist-item">
                                    <td class="wishlist-item-remove">
                                        <a href="javascript:void(0);" class="remove-from-wishlist" data-id="{{ $p->id }}">
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
                                            <del aria-hidden="true"><span>₹{{ $p->product->product_price }}</span></del>
                                            <ins><span>₹{{ $p->product->sell_price }}</span></ins>
                                        </div>
                                        <div class="wishlist-item-time">{{ $p->created_at ? $p->created_at->format('F j, Y') : \Carbon\Carbon::today()->format('F j, Y') }}</div>
                                    </td>
                                    <td class="wishlist-item-actions">
                                        <div class="wishlist-item-stock">
                                            In stock
                                        </div>
                                        <div class="wishlist-item-add">
                                            <div class="btn-add-to-cart" data-title="Add to cart">
                                                <a rel="nofollow" href="#" class="product-btn">Add to cart</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center">There are no products on the wishlist!</div>
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
        $('.remove-from-wishlist').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var token = '{{ csrf_token() }}'; // CSRF token for security

            $.ajax({
                url: "{{ route('remove-wishlist') }}",
                type: 'POST',
                data: {
                    "_token": token,
                    "id": id,
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        // Optionally remove the row from the table
                        $('a[data-id="'+id+'"]').closest('.wishlist-item').remove();

                        updateWishlistCount();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    alert('An error occurred while removing the item.');
                }
            });
        });

        function updateWishlistCount() {
            $.ajax({
                url: '{{ route('count-wishlist') }}', // Create a route to return the updated wishlist count
                type: 'GET',
                success: function(data) {
                    $('.count-wishlist').text(data.count);  // Update the wishlist count in the header
                },
                error: function() {
                    alert('Failed to update wishlist count.');
                }
            });
        }
    });
</script>
@endpush
