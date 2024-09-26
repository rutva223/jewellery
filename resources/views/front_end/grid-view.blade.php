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
                                    <img src="{{ $product->images[0] }}" width="600" height="600" alt="Product Image" class="post-image">
                                    @if (isset($product->images[1]))
                                        <img src="{{ $product->images[1] }}" width="600" height="600" alt="Product Image" class="hover-image back">
                                    @else
                                        <img src="{{ $product->images[0] }}" width="600" height="600" alt="Product Image" class="hover-image back">
                                    @endif
                                @else
                                    <img src="{{ asset('front_end/media/product/1.jpg') }}" width="600" height="600" alt="Default Image">
                                @endif
                            </a>
                        </div>
                        <div class="product-button">
                            <div class="btn-add-to-cart" data-title="Add to cart">
                                <a rel="nofollow" href="#" class="product-btn button">Add to cart</a>
                            </div>
                            <div class="btn-wishlist" data-title="Wishlist">
                                @if (Session::has('login_id'))
                                    @if (in_array($product->id, $wishlistItems))
                                    <button class="product-btn wishlist-btn" data-product-id="{{ $product->id }}">
                                        <i class="fa fa-heart filled-heart" aria-hidden="true"></i>
                                    </button>
                                @else
                                    <button class="product-btn wishlist-btn" data-product-id="{{ $product->id }}">
                                        <i class="fa fa-heart empty-heart" aria-hidden="true"></i>
                                    </button>
                                @endif
                                @else
                                    <button class="product-btn" id="loginModalTrigger">Add to wishlist</button>
                                @endif
                            </div>
                            <span class="product-quickview" data-title="Quick View">
                                <a href="#" class="quickview-button" data-id="{{ $product->id }}">Quick View <i
                                        class="icon-search"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="products-content">
                        <div class="contents text-center">
                            <div class="rating">
                                <div class="star star-0"></div><span class="count">(0 review)</span>
                            </div>
                            <h3 class="product-title"><a href="{{ route('product_detail', $product->id) }}">{{ $product->product_name }}</a></h3>
                            <del aria-hidden="true"><span>₹{{ $product->product_price }}</span></del>
                            <ins><span class="price">₹{{ $product->sell_price }}</span></ins>
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
        $('.wishlist-btn').on('click', function() {
            let productId = $(this).data('product-id');
            let heartIcon = $(this).find('i');

            $.ajax({
                url: '{{ route("add-wishlist") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // CSRF token for security
                    product_id: productId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Toggle heart icon on success
                        if (heartIcon.hasClass('empty-heart')) {
                            heartIcon.removeClass('empty-heart').addClass('filled-heart');
                        } else {
                            heartIcon.removeClass('filled-heart').addClass('empty-heart');
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>

@endpush
