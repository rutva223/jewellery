<div class="products-list grid">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="products-entry clearfix product-wapper">
                    <div class="products-thumb">
                        <div class="product-lable">
                            <div class="hot">SAVE ₹{{ $product->discount }}</div>
                        </div>
                        <div class="product-thumb-hover">
                            <a href="{{ route('product_detail', $product->id) }}">
                                @if (is_array($product->images) && count($product->images) > 0)
                                    <img src="{{ $product->images[0] }}" width="600" height="600"
                                        alt="Product Image" class="post-image">
                                    @if (isset($product->images[1]))
                                        <img src="{{ $product->images[1] }}" width="600" height="600"
                                            alt="Product Image" class="hover-image back">
                                    @else
                                        <img src="{{ $product->images[0] }}" width="600" height="600"
                                            alt="Product Image" class="hover-image back">
                                    @endif
                                @else
                                    <img src="{{ asset('front_end/media/product/1.jpg') }}" width="600"
                                        height="600" alt="Default Image">
                                @endif
                            </a>
                        </div>
                        <div class="product-button">

                            @if (Session::has('login_id'))
                                @if (in_array($product->id, $cartItems))
                                    {{-- <div class="btn-add-to-cart" data-product-id="{{ $product->id }}"
                                        data-title="Add to cart">
                                        <a rel="nofollow" href="#" class="product-btn button">Add to
                                            cart</a>
                                    </div> --}}
                                    <div class="btn-view-cart" data-product-id="{{ $product->id }}"
                                        data-title="View cart">
                                        <a href="{{ route('view-cartlist') }}" class="added-to-cart product-btn"
                                            title="View cart"><i class="fa fa-shopping-cart"></i> View cart</a>
                                    </div>
                                @else
                                    <div class="btn-add-to-cart" data-product-id="{{ $product->id }}"
                                        data-title="Add to cart">
                                        <a rel="nofollow" href="#" class="product-btn button">Add to
                                            cart</a>
                                    </div>
                                @endif
                            @else
                                <div class="btn-add-to-cart active-login" data-title="Add to cart">
                                    <a rel="nofollow" class="product-btn button" href="#">Add to cart</a>
                                </div>
                            @endif
                            @if (Session::has('login_id'))
                                @if (in_array($product->id, $wishlistItems))
                                    <div class="btn-wishlist" data-title="Wishlist"
                                        data-product-id="{{ $product->id }}">
                                        <button
                                            class="product-btn wishlist-btn {{ in_array($product->id, $wishlistItems) ? ' added' : '' }} ">
                                        </button>
                                    </div>
                                @else
                                    <div class="btn-wishlist " data-title="Wishlist"
                                        data-product-id="{{ $product->id }}">
                                        <button class="product-btn wishlist-btn">
                                            <i class=" fa fa-heart-o"></i>
                                        </button>
                                    </div>
                                @endif
                            @else
                                <div class="btn-wishlist active-login" data-title="Wishlist">
                                    <button class="product-btn wishlist-btn">
                                        <i class= 'fa fa-heart'></i>
                                    </button>
                                </div>
                            @endif

                            <span class="product-quickview" data-title="Quick View">
                                <a href="{{ route('product_detail', $product->id) }}"
                                    class="quickview quickview-button">Quick
                                    View <i class="icon-search"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="products-content">
                        <div class="contents text-center">
                            <h3 class="product-title"><a
                                    href="{{ route('product_detail', $product->id) }}">{{ $product->product_name }}</a>
                            </h3>
                            <div class="price">
                                <del aria-hidden="true"><span>₹{{ $product->product_price }}</span></del>
                                <span class="price">₹{{ $product->sell_price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<nav class="pagination">
    <ul class="page-numbers">
        <!-- Previous Page Link -->
        @if ($products->onFirstPage())
            <li class="disabled"><span>&raquo;</span></li>
        @else
            <li><a class="prev page-numbers" href="{{ $products->previousPageUrl() }}">&raquo;</a></li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if ($page == $products->currentPage())
                <li><span class="page-numbers current">{{ $page }}</span></li>
            @else
                <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($products->hasMorePages())
            <li><a class="next page-numbers" href="{{ $products->nextPageUrl() }}">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</nav>
<script src="{{ asset('front_end/libs/slick/js/slick.min.js') }}"></script>

@push('after-script')
    <script>
        $(document).ready(function() {
            $('.wishlist-btn').on('click', function(e) {
                e.preventDefault();

                var id = $(this).data('product-id');
                var token = '{{ csrf_token() }}'; // CSRF token for security

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
                            Swal.fire('Deleted!', response.message, 'success');

                            // Optionally remove the row from the table
                            $('a[data-id="' + id + '"]').closest('.wishlist-item').remove();

                            updateWishlistCount();
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
@endpush
