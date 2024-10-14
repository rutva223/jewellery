<div class="products-list list">
    @foreach ($products as $product)
        <div class="products-entry clearfix product-wapper">
            <div class="row">
                <div class="col-md-4">
                    <div class="products-thumb">
                        <div class="product-lable">
                            <div class="hot">Hot</div>
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
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="products-content">
                        <h3 class="product-title"><a href="shop-details.html">{{ $product->product_name }}</a></h3>
                        <span class="price">
                            <del aria-hidden="true"><span>₹{{ $product->product_price }}</span></del>
                            <ins><span class="price">₹{{ $product->sell_price }}</span></ins>
                        </span>
                        <div class="product-button">

                            @if (Session::has('login_id'))
                            <div class="btn-add-to-cart"
                                data-product-id="{{ $product->id }}"
                                data-title="Add to cart">
                                <a rel="nofollow" href="#" class="product-btn button">Add to
                                    cart</a>
                            </div>
                        @else
                            <div class="btn-add-to-cart active-login" data-title="Add to cart">
                                <a rel="nofollow" class="product-btn button" href="#">Add to
                                    cart</a>
                            </div>
                        @endif
                            @if (Session::has('login_id'))
                            @if (in_array($product->id, $wishlistItems))
                                <div class="btn-wishlist" data-title="Wishlist"
                                    data-product-id="{{ $product->id }}">
                                    <button class="product-btn  {{ in_array($product->id, $wishlistItems) ? ' added' : '' }} ">
                                    </button>
                                </div>
                            @else
                                <div class="btn-wishlist " data-title="Wishlist"
                                    data-product-id="{{ $product->id }}">
                                    <button class="product-btn ">
                                        <i class=" fa fa-heart-o"></i>
                                    </button>
                                </div>
                            @endif
                        @else
                            <div class="btn-wishlist active-login" data-title="Wishlist">
                                <button class="product-btn ">
                                    <i class= 'fa fa-heart'></i>
                                </button>
                            </div>
                        @endif
                            <div class="btn-compare" data-title="Compare">
                                <button class="product-btn">Compare</button>
                            </div>
                        </div>
                        <div class="product-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis…
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
