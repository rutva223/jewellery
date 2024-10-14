@extends('front_end.app')
@section('content')
    <div id="title" class="page-title">
        <div class="section-container">
            <div class="content-title-heading">
                <h1 class="text-title-heading">
                    {{ $product->product_name }}
                </h1>
            </div>
            <div class="breadcrumbs">
                <a href="{{ route('home') }}">Home</a><span class="delimiter"></span><a
                    href="{{ route('catwiseproduct', $product->category->name) }}">Shop</a><span
                    class="delimiter"></span>{{ $product->product_name }}
            </div>
        </div>
    </div>
    <div id="content" class="site-content" role="main">
        <div class="shop-details zoom" data-product_layout_thumb="scroll" data-zoom_scroll="true"
            data-zoom_contain_lens="true" data-zoomtype="inner" data-lenssize="200" data-lensshape="square"
            data-lensborder="" data-bordersize="2" data-bordercolour="#f9b61e" data-popup="false">
            <div class="product-top-info">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="row">
                            <div class="product-images col-lg-7 col-md-12 col-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="content-thumbnail-scroll">
                                            <div class="image-thumbnail slick-carousel slick-vertical"
                                                data-asnavfor=".image-additional" data-centermode="true"
                                                data-focusonselect="true" data-columns4="5" data-columns3="4"
                                                data-columns2="4" data-columns1="4" data-columns="4" data-nav="true"
                                                data-vertical="&quot;true&quot;" data-verticalswiping="&quot;true&quot;">
                                                @if (is_array($product->images) && count($product->images) > 0)
                                                    @foreach ($product->images as $image)
                                                        <div class="img-item slick-slide">
                                                            <span class="img-thumbnail-scroll">
                                                                <img width="600" height="600" src="{{ $image }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="img-item slick-slide">
                                                        <span class="img-thumbnail-scroll">
                                                            <img width="600" height="600"
                                                                src="{{ asset('front_end/media/product/1-2.jpg') }}"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="product-lable">
                                            <div class="hot">SAVE ₹{{ $product->discount }}</div>
                                        </div>
                                        <div class="scroll-image main-image">
                                            <div class="image-additional slick-carousel" data-asnavfor=".image-thumbnail"
                                                data-fade="true" data-columns4="1" data-columns3="1" data-columns2="1"
                                                data-columns1="1" data-columns="1" data-nav="true">
                                                @if (is_array($product->images) && count($product->images) > 0)
                                                    @foreach ($product->images as $image)
                                                        <div class="img-item slick-slide">
                                                            <img width="900" height="900" src="{{ $image }}"
                                                                alt="{{ $product->product_name }}"
                                                                title="{{ $product->product_name }}">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="img-item slick-slide">
                                                        <img width="900" height="900"
                                                            src="{{ asset('front_end/media/product/1.jpg') }}"
                                                            alt="Default Product Image" title="Default Product Image">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-info col-lg-5 col-md-12 col-12 ">
                                <h1 class="title">{{ $product->product_name }}</h1>
                                <span class="price">
                                    <del aria-hidden="true"><span>₹{{ $product->product_price }}</span></del>
                                    <ins><span>₹{{ $product->sell_price }}</span></ins>
                                </span>
                                <div class="description">
                                    {!! $product->description !!}
                                </div>
                                <div class="buttons">
                                    <div class="add-to-cart-wrap">
                                        <div class="quantity">
                                            <button type="button" class="plus">+</button>
                                            <input type="number" class="qty" step="1" min="0"
                                                max="" name="quantity" value="1" title="Qty" size="4"
                                                placeholder="" inputmode="numeric" autocomplete="off">
                                            <button type="button" class="minus">-</button>
                                        </div>

                                        @if (Session::has('login_id'))
                                            <div class="btn-add-to-cart" data-product-id="{{ $product->id }}"
                                                data-title="Add to cart">
                                                <a rel="nofollow" tabindex="0" href="#">Add to
                                                    cart</a>
                                            </div>
                                        @else
                                            <div class="btn-add-to-cart active-login" data-title="Add to cart">
                                                <a rel="nofollow" tabindex="0" href="#">Add to
                                                    cart</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="btn-quick-buy" data-title="Wishlist">

                                        <a href="{{ route('checkout') }}" class="button alt product-btn" name="checkout_place_order" value="Place order">  <button class="product-btn">Buy It Now</button></a>

                                    </div>
                                    @if (Session::has('login_id'))
                                        @if (in_array($product->id, $wishlistItems))
                                            <div class="btn-wishlist" data-title="Wishlist">
                                                <button class="product-btn wishlist-btn"
                                                    data-product-id="{{ $product->id }}">Add to wishlist
                                                    {{-- <i class="{{ in_array($product->id, $wishlistItems) ? 'fa fa-heart' : 'fa fa-heart-o' }}"></i> --}}
                                                </button>
                                            </div>
                                        @else
                                        <div class="btn-wishlist" data-title="Wishlist">

                                            <button class="product-btn wishlist-btn"
                                                data-product-id="{{ $product->id }}">Add to wishlist
                                                {{-- <i class="{{ in_array($product->id, $wishlistItems) ? 'fa fa-heart' : 'fa fa-heart-o' }}"></i> --}}
                                            </button>
                                        </div>
                                        @endif
                                    @else
                                    <div class=" active-login btn-wishlist" data-title="Wishlist">

                                        <button class="product-btn">Add to wishlist</button>
                                    </div>
                                    @endif

                                </div>
                                <div class="product-meta">
                                    <span class="posted-in">Category: <a
                                            href="{{ route('catwiseproduct', $product->category->name) }}"
                                            rel="tag">{{ $product->category->name }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-tabs">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="product-tabs-wrap">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="shop-details.html#description"
                                        role="tab">Description</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error
                                        sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                                        ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                                    </p>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                                        quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                                        sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                                        quaerat voluptatem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-related">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="block block-products slider">
                            <div class="block-title">
                                <h2>Related Products</h2>
                            </div>
                            <div class="block-content">
                                <div class="content-product-list slick-wrap">
                                    <div class="slick-sliders products-list grid" data-slidestoscroll="true"
                                        data-dots="false" data-nav="1" data-columns4="1" data-columns3="2"
                                        data-columns2="3" data-columns1="3" data-columns1440="4" data-columns="4">
                                        @foreach ($product->category->products as $key => $value)
                                            <div class="item-product slick-slide">
                                                <div class="items">
                                                    <div class="products-entry clearfix product-wapper">
                                                        <div class="products-thumb">
                                                            <div class="product-lable">
                                                                <div class="hot">SAVE ₹{{ $value->discount }}</div>
                                                            </div>
                                                            @php
                                                                $images = $value->images;
                                                            @endphp
                                                            <div class="product-thumb-hover">
                                                                <a href="{{ route('product_detail', $product->id) }}">
                                                                    @if (is_array($images) && count($images) > 0)
                                                                        <img src="{{ $images[0] }}" width="600"
                                                                            height="600" alt="Product Image"
                                                                            class="post-image">
                                                                        @if (isset($images[1]))
                                                                            <img src="{{ $images[1] }}" width="600"
                                                                                height="600" alt="Product Image"
                                                                                class="hover-image back">
                                                                        @else
                                                                            <img src="{{ $images[0] }}" width="600"
                                                                                height="600" alt="Product Image"
                                                                                class="hover-image back">
                                                                        @endif
                                                                    @else
                                                                        <img src="{{ asset('front_end/media/product/1.jpg') }}"
                                                                            width="600" height="600"
                                                                            alt="Default Image">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="product-button">

                                                                @if (Session::has('login_id'))
                                                                    <div class="btn-add-to-cart" data-product-id="{{ $product->id }}"
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
                                                                        href="{{ route('product_detail', $value->id) }}">{{ $value->product_name }}</a>
                                                                </h3>
                                                            </div>
                                                            <div class="price">
                                                                <del
                                                                    aria-hidden="true"><span>₹{{ $value->product_price }}</span></del>
                                                                <ins><span>₹{{ $value->sell_price }}</span></ins>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.wishlist-btn').on('click', function() {
            let productId = $(this).data('product-id');
            let heartIcon = $(this).find('i');

            $.ajax({
                url: '{{ route('add-wishlist') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for security
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
                        updateWishlistCount();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
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
