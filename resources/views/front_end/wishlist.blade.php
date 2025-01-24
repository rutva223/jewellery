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
                <span class="delimiter"></span> Wishlist view
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
                                            <a href="javascript:void(0);" class="remove-from-wishlist"
                                                data-id="{{ $p->id }}">
                                                <span></span>
                                            </a>
                                        </td>
                                        <td class="wishlist-item-image">
                                            <div class="product-thumb-hover">
                                                <a href="{{ route('product_detail', $p->product_id) }}">
                                                    @if (isset($p->product->images[0]))
                                                        <img src="{{ $p->product->images[0] }}" width="600"
                                                            height="600" alt="Product Image" class="post-image">
                                                    @else
                                                        <img src="{{ asset('front_end/media/product/1.jpg') }}"
                                                            width="600" height="600" alt="Default Image">
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td class="wishlist-item-info">
                                            <div class="wishlist-item-name">
                                                <a
                                                    href="{{ route('product_detail', $p->product_id) }}">{{ !empty($p->product) ? $p->product->product_name : '' }}</a>
                                            </div>
                                            <div class="wishlist-item-price">
                                                <del
                                                    aria-hidden="true"><span>₹{{ !empty($p->product) ? $p->product->product_price : '' }}</span></del>
                                                <ins><span>₹{{ !empty($p->product) ? $p->product->sell_price : '' }}</span></ins>
                                            </div>
                                            <div class="wishlist-item-time">
                                                {{ $p->created_at ? $p->created_at->format('F j, Y') : \Carbon\Carbon::today()->format('F j, Y') }}
                                            </div>
                                        </td>
                                        <td class="wishlist-item-actions">
                                            <div class="wishlist-item-add">
                                                @if (Session::has('login_id'))
                                                    <div class="btn-add-to-cart" data-product-id="{{ $p->product_id }}"
                                                        data-title="Add to cart">
                                                        <a rel="nofollow" href="#" class="product-btn">Add to
                                                            cart</a>
                                                    </div>
                                                @else
                                                    <div class="btn-add-to-cart active-login" data-title="Add to cart">
                                                        <a rel="nofollow" href="#" class="product-btn">Add to
                                                            cart</a>
                                                    </div>
                                                @endif
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@push('after-scripts')
<script>
    $(document).ready(function() {
        $('.remove-from-wishlist').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var token = '{{ csrf_token() }}'; // CSRF token for security

            // Show confirmation alert before removing the item
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to remove this item from your wishlist?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, proceed with AJAX request
                    $.ajax({
                        url: "{{ route('remove-wishlist') }}",
                        type: 'POST',
                        data: {
                            "_token": token,
                            "id": id,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                // Optionally remove the row from the table
                                $('a[data-id="' + id + '"]').closest('.wishlist-item').remove();

                                updateWishlistCount();

                                // Show success alert after a brief delay
                                setTimeout(function() {
                                    Swal.fire('Deleted!', response.message, 'success');
                                }, 500);
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function(response) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while removing the item.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        function updateWishlistCount() {
            $.ajax({
                url: '{{ route('count-wishlist') }}', // Create a route to return the updated wishlist count
                type: 'GET',
                success: function(data) {
                    $('.count-wishlist').text(data.count); // Update the wishlist count in the header
                },
                error: function() {
                    alert('Failed to update wishlist count.');
                }
            });
        }
    });
</script>

@endpush
