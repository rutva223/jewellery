<div class="products-list grid">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="products-entry clearfix product-wapper">
                    <div class="products-thumb">
                        <div class="product-lable">
                            <div class="hot">Hot</div>
                        </div>
                        <div class="product-thumb-hover">
                            <a href="shop-details.html">
                                <img width="600" height="600" src="{{ asset('front_end/media/product/1.jpg') }}" class="post-image" alt="">
                                <img width="600" height="600" src="{{ asset('front_end/media/product/1-2.jpg') }}" class="hover-image back" alt="">
                            </a>
                        </div>
                        <div class="product-button">
                            <div class="btn-add-to-cart" data-title="Add to cart">
                                <a rel="nofollow" href="#" class="product-btn button">Add to cart</a>
                            </div>
                            <div class="btn-wishlist" data-title="Wishlist">
                                <button class="product-btn">Add to wishlist</button>
                            </div>
                            <div class="btn-compare" data-title="Compare">
                                <button class="product-btn">Compare</button>
                            </div>
                            <span class="product-quickview" data-title="Quick View">
                                <a href="#" class="quickview quickview-button">Quick View <i class="icon-search"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="products-content">
                        <div class="contents text-center">
                            <div class="rating">
                                <div class="star star-0"></div><span class="count">(0 review)</span>
                            </div>
                            <h3 class="product-title"><a href="shop-details.html">{{ $product->product_name }}</a></h3>
                            <span class="price">{{ $product->sell_price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <!-- Display pagination text -->
    <div class="col-lg-6">
        {{ $text_for_pagination }}
    </div>

    <!-- Display pagination links -->
    <div class="col-lg-6 d-flex justify-content-end">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>