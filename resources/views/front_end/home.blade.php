@extends('front_end.app')
@section('content')
    @php
        $all_categories = AllCategories();
    @endphp

    <div id="content" class="site-content" role="main">
        <section class="section m-b-70">
            <!-- Block Sliders -->
            <div class="block block-sliders auto-height color-white nav-center">
                <div class="slick-sliders" data-autoplay="true" data-dots="true" data-nav="true" data-columns4="1"
                    data-columns3="1" data-columns2="1" data-columns1="1" data-columns1440="1" data-columns="1">
                    <div class="item slick-slide">
                        <div class="item-content">
                            <div class="content-image">
                                <img width="1920" height="1080" src="{{ asset('front_end/media/slider/1-1.jpg') }}"
                                    alt="Image Slider">
                            </div>
                            <div class="item-info horizontal-start vertical-middle">
                                <div class="content">
                                    <h2 class="title-slider">Discover a <br>world of jewelry</h2>
                                    <a class="button-slider button button-white button-outline thick-border"
                                        href="shop-grid-left.html">Explore Bestseller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item slick-slide">
                        <div class="item-content">
                            <div class="content-image">
                                <img width="1920" height="1080" src="{{ asset('front_end/media/slider/1-2.jpg') }}"
                                    alt="Image Slider">
                            </div>
                            <div class="item-info horizontal-start vertical-middle">
                                <div class="content">
                                    <h2 class="title-slider">Discover the<br> Best of the Best</h2>
                                    <a class="button-slider button button-white button-outline thick-border"
                                        href="shop-grid-left.html">Explore Bestseller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item slick-slide">
                        <div class="item-content">
                            <div class="content-image">
                                <img width="1920" height="1080" src="{{ asset('front_end/media/slider/1-3.jpg') }}"
                                    alt="Image Slider">
                            </div>
                            <div class="item-info horizontal-start vertical-middle">
                                <div class="content">
                                    <h2 class="title-slider">Oh,<br> Hello Newness!</h2>
                                    <a class="button-slider button button-white button-outline thick-border"
                                        href="shop-grid-left.html">Explore Bestseller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <div class="card card-default">
            <div class="card-header">
                Laravel - Razorpay Payment Gateway Integration
            </div>
            <div class="card-body text-center">
                <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ env('RAZORPAY_KEY') }}"
                            data-amount="10000"
                            data-buttontext="Pay 100 INR"
                            data-name="GeekyAnts official"
                            data-description="Razorpay payment"
                            data-image="/images/logo-icon.png"
                            data-prefill.name="ABC"
                            data-prefill.email="abc@gmail.com"
                            data-theme.color="#ff7529">
                    </script>
                </form>
            </div>
        </div> --}}
        <section class="section section-padding m-b-70">
            <div class="section-container large">
                <!-- Block Banners (Layout 1) -->
                <div class="block block-banners layout-1 banners-effect">
                    <div class="block-widget-wrap small-space">
                        <div class="row">
                            <div class="section-column left sm-m-b">
                                <div class="block-widget-banner">
                                    <div class="bg-banner">
                                        <div class="banner-wrapper banners">
                                            <div class="banner-image">
                                                <a href="shop-grid-left.html">
                                                    <img width="630" height="457"
                                                        src="{{ asset('front_end/media/banner/banner-1-1.jpg') }}"
                                                        alt="Banner Image">
                                                </a>
                                            </div>
                                            <div class="banner-wrapper-infor">
                                                <div class="info">
                                                    <div class="content">
                                                        <h3 class="title-banner">New Arrivals</h3>
                                                        <a class="button" href="shop-grid-left.html">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-column center sm-m-b">
                                <div class="block-widget-banner">
                                    <div class="bg-banner">
                                        <div class="banner-wrapper banners">
                                            <div class="banner-image">
                                                <a href="shop-grid-left.html">
                                                    <img width="450" height="457"
                                                        src="{{ asset('front_end/media/banner/banner-1-2.jpg') }}"
                                                        alt="Banner Image">
                                                </a>
                                            </div>
                                            <div class="banner-wrapper-infor text-center">
                                                <div class="info">
                                                    <div class="content">
                                                        <h3 class="title-banner">Best Seller</h3>
                                                        <a class="button center" href="shop-grid-left.html">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="section-column right">
                                <div class="block-widget-banner">
                                    <div class="bg-banner">
                                        <div class="banner-wrapper banners">
                                            <div class="banner-image">
                                                <a href="shop-grid-left.html">
                                                    <img width="630" height="457"
                                                        src="{{ asset('front_end/media/banner/banner-1-3.jpg') }}"
                                                        alt="Banner Image">
                                                </a>
                                            </div>
                                            <div class="banner-wrapper-infor">
                                                <div class="info">
                                                    <div class="content">
                                                        <h3 class="title-banner">Clearance Sale</h3>
                                                        <a class="button" href="shop-grid-left.html">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-padding m-b-70">
            <div class="section-container">
                <!-- Block Product Categories -->
                <div class="block block-product-cats slider round-border">
                    <div class="block-widget-wrap">
                        <div class="block-title">
                            <h2>Top Categories</h2>
                        </div>
                        <div class="block-content">
                            <div class="product-cats-list slick-wrap">
                                <div class="slick-sliders content-category" data-dots="0" data-slidestoscroll="true"
                                    data-nav="1" data-columns4="2" data-columns3="3" data-columns2="3"
                                    data-columns1="5" data-columns1440="5" data-columns="5">
                                    @foreach ($all_categories as $cat)
                                        <div class="item item-product-cat slick-slide">
                                            <div class="item-product-cat-content">
                                                <a href="{{ route('catwiseproduct', $cat->name) }}">
                                                    <div class="item-image animation-horizontal">
                                                        <img width="258" height="258"
                                                            src="{{ asset('front_end/media/product/' . strtolower($cat->name)) }}.jpg"
                                                            alt="{{ $cat->name }}">
                                                    </div>
                                                </a>
                                                <div class="product-cat-content-info">
                                                    <h2 class="item-title">
                                                        <a
                                                            href="{{ route('catwiseproduct', $cat->name) }}">{{ $cat->name }}</a>
                                                    </h2>
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
        </section>

        <section class="section section-padding">
            <div class="section-container large">
                <!-- Block Banners (Layout 2) -->
                <div class="block block-banners layout-2 banners-effect">
                    <div class="block-widget-wrap">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="block-widget-banner m-b-15">
                                    <div class="bg-banner">
                                        <div class="banner-wrapper banners">
                                            <div class="banner-image">
                                                <a href="shop-grid-left.html">
                                                    <img width="856" height="496"
                                                        src="{{ asset('front_end/media/banner/banner-1-4.jpg') }}"
                                                        alt="Banner Image">
                                                </a>
                                            </div>
                                            <div class="banner-wrapper-infor">
                                                <div class="info">
                                                    <div class="content">
                                                        <h3 class="title-banner">Summer Collections</h3>
                                                        <div class="banner-image-description">
                                                            Freshwater pearl necklace and earrings
                                                        </div>
                                                        <a class="button button-outline thick-border border-white button-arrow"
                                                            href="shop-grid-left.html">Explore</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="block-widget-banner">
                                    <div class="bg-banner">
                                        <div class="banner-wrapper banners">
                                            <div class="banner-image">
                                                <a href="shop-grid-left.html">
                                                    <img width="856" height="496"
                                                        src="{{ asset('front_end/media/banner/banner-1-5.jpg') }}"
                                                        alt="Banner Image">
                                                </a>
                                            </div>
                                            <div class="banner-wrapper-infor">
                                                <div class="info">
                                                    <div class="content">
                                                        <h3 class="title-banner"> Make It Memorable</h3>
                                                        <div class="banner-image-description">
                                                            Freshwater pearl necklace and earrings
                                                        </div>
                                                        <a class="button button-outline thick-border border-white button-arrow"
                                                            href="shop-grid-left.html">Explore</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-padding m-b-70">
            <div class="section-container large">
                <!-- Block Products -->
                <div class="block block-products slider">
                    <div class="block-widget-wrap">
                        <div class="block-title">
                            <h2>Trending Products</h2>
                        </div>
                        <div class="block-content">
                            <div class="content-product-list slick-wrap">
                                <div class="slick-sliders products-list grid" data-slidestoscroll="true"
                                    data-dots="false" data-nav="1" data-columns4="1" data-columns3="2"
                                    data-columns2="2" data-columns1="3" data-columns1440="4" data-columns="4">
                                    @foreach ($products as $pro)
                                        <div class="item-product slick-slide">
                                            <div class="items">
                                                <div class="products-entry clearfix product-wapper">
                                                    <div class="products-thumb">
                                                        <div class="product-lable">
                                                            <div class="hot">SAVE ₹{{ $pro->discount }}</div>
                                                        </div>
                                                        <div class="product-thumb-hover">
                                                            <a href="{{ route('product_detail', $pro->id) }}">
                                                                @if (is_array($pro->images) && count($pro->images) > 0)
                                                                    <img src="{{ $pro->images[0] }}" width="600"
                                                                        height="600" alt="Product Image"
                                                                        class="post-image">
                                                                    @if (isset($pro->images[1]))
                                                                        <img src="{{ $pro->images[1] }}" width="600"
                                                                            height="600" alt="Product Image"
                                                                            class="hover-image back">
                                                                    @else
                                                                        <img src="{{ $pro->images[0] }}" width="600"
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
                                                                <div class="btn-add-to-cart"
                                                                    data-product-id="{{ $pro->id }}"
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
                                                                @if (in_array($pro->id, $wishlistItems))
                                                                    <div class="btn-wishlist" data-title="Wishlist"
                                                                        data-product-id="{{ $pro->id }}">
                                                                        <button class="product-btn wishlist-btn {{ in_array($pro->id, $wishlistItems) ? ' added' : '' }} ">
                                                                        </button>
                                                                    </div>
                                                                @else
                                                                    <div class="btn-wishlist " data-title="Wishlist"
                                                                        data-product-id="{{ $pro->id }}">
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
                                                                <a href="{{ route('product_detail', $pro->id) }}"
                                                                    class="quickview quickview-button">Quick
                                                                    View <i class="icon-search"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="products-content">
                                                        <div class="contents">
                                                            {{-- <div class="rating">
                                                                <div class="star star-0"></div><span class="count">(0
                                                                    review)</span>
                                                            </div> --}}
                                                            <h3 class="product-title"><a
                                                                    href="{{ route('product_detail', $pro->id) }}">{{ $pro->product_name }}</a>
                                                            </h3>
                                                            <span class="price">
                                                                <del
                                                                    aria-hidden="true"><span>₹{{ $pro->product_price }}</span></del>
                                                                <ins><span>₹{{ $pro->sell_price }}</span></ins>
                                                            </span>
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
        </section>



        <section class="section section-padding m-b-80">
            <div class="section-container">
                <!-- Block Newsletter (Layout 2) -->
                <div class="block block-newsletter layout-2 one-col">
                    <div class="block-widget-wrap">
                        <div class="newsletter-title-wrap">
                            <h2 class="newsletter-title">Latest From MoJuri!</h2>
                        </div>
                        <form action="{{ route('subscribe') }}" method="post" class="newsletter-form">
                            @csrf
                            <input type="email" name="email" value="" size="40"
                                placeholder="Email address">
                            <span class="btn-submit">
                                <input type="submit" value="SUBSCRIBE">
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-padding top-border p-t-10 p-b-10 m-b-0">
            <div class="section-container">
                <!-- Block Image -->
                <div class="block block-image slider">
                    <div class="block-widget-wrap">
                        <div class="slick-wrap">
                            <div class="slick-sliders" data-nav="0" data-columns4="1" data-columns3="2"
                                data-columns2="3" data-columns1="4" data-columns1440="4" data-columns="5">
                                <div class="item slick-slide">
                                    <div class="item-image animation-horizontal">
                                        <a href="index.html#">
                                            <img width="450" height="450"
                                                src="{{ asset('front_end/media/brand/1.jpg') }}" alt="Brand 1">
                                        </a>
                                    </div>
                                </div>
                                <div class="item slick-slide">
                                    <div class="item-image animation-horizontal">
                                        <a href="index.html#">
                                            <img width="450" height="450"
                                                src="{{ asset('front_end/media/brand/2.jpg') }}" alt="Brand 2">
                                        </a>
                                    </div>
                                </div>
                                <div class="item slick-slide">
                                    <div class="item-image animation-horizontal">
                                        <a href="index.html#">
                                            <img width="450" height="450"
                                                src="{{ asset('front_end/media/brand/3.jpg') }}" alt="Brand 3">
                                        </a>
                                    </div>
                                </div>
                                <div class="item slick-slide">
                                    <div class="item-image animation-horizontal">
                                        <a href="index.html#">
                                            <img width="450" height="450"
                                                src="{{ asset('front_end/media/brand/4.jpg') }}" alt="Brand 4">
                                        </a>
                                    </div>
                                </div>
                                <div class="item slick-slide">
                                    <div class="item-image animation-horizontal">
                                        <a href="index.html#">
                                            <img width="450" height="450"
                                                src="{{ asset('front_end/media/brand/5.jpg') }}" alt="Brand 5">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div><!-- #content -->
@endsection


@push('after-script')
@endpush
