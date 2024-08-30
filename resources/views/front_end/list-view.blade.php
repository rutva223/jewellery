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
                            <a href="shop-details.html">
                                <img width="600" height="600" src="{{ asset('front_end/media/product/1.jpg') }}" class="post-image" alt="">
                                <img width="600" height="600" src="{{ asset('front_end/media/product/1.jpg') }}" class="hover-image back" alt="">
                            </a>
                        </div>
                        <span class="product-quickview" data-title="Quick View">
                            <a href="#" class="quickview quickview-button">Quick View <i class="icon-search"></i></a>
                        </span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="products-content">
                        <h3 class="product-title"><a href="shop-details.html">{{ $product->product_name }}</a></h3>
                        <span class="price">{{ $product->sell_price }}</span>
                        <div class="rating">
                            <div class="star star-5"></div>
                            <div class="review-count">
                                (1<span> review</span>)
                            </div>
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
                        </div>
                        <div class="product-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis…
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
