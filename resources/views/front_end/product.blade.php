@extends('front_end.app')
@section('content')
    <div id="title" class="page-title">
        <div class="section-container">
            <div class="content-title-heading">
                <h1 class="text-title-heading">
                    {{ $cat_name }}
                </h1>
            </div>
            <div class="breadcrumbs">
                <a href="{{ route('home') }}">Home</a><span class="delimiter"></span><a
                    href="shop-grid-left.html">Shop</a><span class="delimiter"></span>{{ $cat_name }}
            </div>
        </div>
    </div>
    <div id="content" class="site-content" role="main">
        <div class="section-padding">
            <div class="section-container p-l-r">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-12 sidebar left-sidebar md-b-50 p-t-10">
                        <!-- Block Product Categories -->
                        <div class="block block-product-cats">
                            <div class="block-title">
                                <h2>Categories</h2>
                            </div>
                            <div class="block-content">
                                <div class="product-cats-list">
                                    <ul>
                                        {{-- <li class="current">
                                            <a href="shop-grid-left.html">Bracelets <span class="count">9</span></a>
                                        </li> --}}
                                        @foreach ($categories as $cat)
                                            <li class="current">
                                                <a href="{{ route('catwiseproduct', $cat->name) }}">{{ $cat->name }}
                                                    <span class="count">{{ $categories->count() }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Block Product Filter -->
                        <div class="block block-product-filter">
                            <div class="block-title">
                                <h2>Price</h2>
                            </div>
                            <div class="block-content">
                                <div id="slider-range" class="price-filter-wrap">
                                    <div class="filter-item price-filter">
                                        <div class="layout-slider">
                                            <input id="price-filter" name="price" value="0;100" />
                                        </div>
                                        <div class="layout-slider-settings"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Block Products -->
                        <div class="block block-products">
                            <div class="block-title">
                                <h2>Feature Product</h2>
                            </div>
                            <div class="block-content">
                                <ul class="products-list">
                                    <li class="product-item">
                                        <a href="shop-details.html" class="product-image">
                                            <img src="{{ asset('front_end/media/product/1.jpg') }}">
                                        </a>
                                        <div class="product-content">
                                            <h2 class="product-title">
                                                <a href="shop-details.html">
                                                    Medium Flat Hoops
                                                </a>
                                            </h2>
                                            <div class="rating">
                                                <div class="star star-5"></div>
                                            </div>
                                            <span class="price">
                                                <del aria-hidden="true"><span>$150.00</span></del>
                                                <ins><span>$100.00</span></ins>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="product-item">
                                        <a href="shop-details.html" class="product-image">
                                            <img src="{{ asset('front_end/media/product/2.jpg') }}">
                                        </a>
                                        <div class="product-content">
                                            <h2 class="product-title">
                                                <a href="shop-details.html">
                                                    Bold Pearl Hoop Earrings
                                                </a>
                                            </h2>
                                            <div class="rating">
                                                <div class="star star-0"></div>
                                            </div>
                                            <span class="price">$120.00</span>
                                        </div>
                                    </li>
                                    <li class="product-item">
                                        <a href="shop-details.html" class="product-image">
                                            <img src="{{ asset('front_end/media/product/3.jpg') }}">
                                        </a>
                                        <div class="product-content">
                                            <h2 class="product-title">
                                                <a href="shop-details.html">
                                                    Twin Hoops
                                                </a>
                                            </h2>
                                            <div class="rating">
                                                <div class="star star-4"></div>
                                            </div>
                                            <span class="price">
                                                <del aria-hidden="true"><span>$200.00</span></del>
                                                <ins><span>$180.00</span></ins>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                        <div class="products-topbar clearfix">
                            {{-- <div class="products-topbar-left">
                                <div class="products-count">
                                    Showing all 21 results
                                </div>
                            </div> --}}
                            <div class="products-topbar-right">
                                <div class="products-sort dropdown">
                                    <span class="sort-toggle dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="true">Default sorting</span>
                                    <ul class="sort-list dropdown-menu" x-placement="bottom-start">
                                        <li class="active"><a href="shop-grid-left.html#">Default sorting</a></li>
                                        <li><a href="shop-grid-left.html#">Sort by popularity</a></li>
                                        <li><a href="shop-grid-left.html#">Sort by average rating</a></li>
                                        <li><a href="shop-grid-left.html#">Sort by latest</a></li>
                                        <li><a href="shop-grid-left.html#">Sort by price: low to high</a></li>
                                        <li><a href="shop-grid-left.html#">Sort by price: high to low</a></li>
                                    </ul>
                                </div>
                                <ul class="layout-toggle nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="layout-grid nav-link active" data-toggle="tab" href="#layout-grid"
                                            type="layout-grid" role="tab"><span class="icon-column"><span
                                                    class="layer first"><span></span><span></span><span></span></span><span
                                                    class="layer middle"><span></span><span></span><span></span></span><span
                                                    class="layer last"><span></span><span></span><span></span></span></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="layout-list nav-link" data-toggle="tab" href="#layout-list"
                                            role="tab" type="layout-list"><span class="icon-column"><span
                                                    class="layer first"><span></span><span></span></span><span
                                                    class="layer middle"><span></span><span></span></span><span
                                                    class="layer last"><span></span><span></span></span></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="layout-view" role="tabpanel">

                                <div id="products-container">
                                    @include('front_end.grid-view', [
                                        'products' => $products,
                                        'text_for_pagination' => $text_for_pagination,
                                    ])
                                </div>

                                {{-- <div id="pagination-container">
                                    @include('front_end.pagination', ['products' => $products])
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($all_products as $product)
        <div class="quickview-popup quickview-popup_{{ $product->id }}">
            <div class="quickview-container">
                <a href="index.html#" class="quickview-close"></a>
                <div class="quickview-notices-wrapper"></div>
                <div class="product single-product product-type-simple">
                    <div class="product-detail">
                        <div class="row">
                            <div class="img-quickview">
                                <div class="product-images-slider">
                                    <div id="quickview-slick-carousel">
                                        <div class="images">
                                            <div class="scroll-image">
                                                <div class="slick-wrap">
                                                    <div class="slick-sliders image-additional" data-dots="true"
                                                        data-columns4="1" data-columns3="1" data-columns2="1"
                                                        data-columns1="1" data-columns="1" data-nav="true">
                                                        <div class="img-thumbnail slick-slide">
                                                            <a href="#" class="image-scroll" title="">
                                                                <img width="900" height="900"
                                                                    src="{{ asset('front_end/media/product/1.jpg') }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <div class="img-thumbnail slick-slide">
                                                            <a href="#" class="image-scroll" title="">
                                                                <img width="900" height="900"
                                                                    src="{{ asset('front_end/media/product/1.jpg') }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="quickview-single-info">
                                <div class="product-content-detail entry-summary">
                                    <h1 class="product-title entry-title">{{ $product->product_name }}</h1>
                                    <div class="price-single">
                                        <div class="price">
                                            <del><span>{{ $product->sell_price }}</span></del>
                                            <span>{{ $product->sell_price }}</span>
                                        </div>
                                    </div>
                                    <div class="product-rating">
                                        <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                            <span style="width:80%">Rated <strong class="rating">4.00</strong> out of 5
                                                based on <span class="rating">1</span> customer rating</span>
                                        </div>
                                        <a href="index.html#" class="review-link">(<span class="count">1</span> customer
                                            review)</a>
                                    </div>
                                    <div class="description">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                    <form class="cart" method="post" enctype="multipart/form-data">
                                        <div class="quantity-button">
                                            <div class="quantity">
                                                <button type="button" class="plus">+</button>
                                                <input type="number" class="input-text qty text" step="1"
                                                    min="1" max="" name="quantity" value="1"
                                                    title="Qty" size="4" placeholder="" inputmode="numeric"
                                                    autocomplete="off">
                                                <button type="button" class="minus">-</button>
                                            </div>
                                            <button type="submit" class="single-add-to-cart-button button alt">Add to
                                                cart</button>
                                        </div>
                                        <button class="button quick-buy">Buy It Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    @endforeach
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.quickview-button', function(e) {
                e.preventDefault();

                var productId = $(this).data('id');

                // Show the quick view popup
                $('.quickview-popup_' + productId).addClass('active');

            });


            // Handle Quick View close button click
            $(document).on('click', '.quickview-close', function(e) {
                e.preventDefault();
                $('.quickview-popup').hide();
            });


            // Function to load content via AJAX
            function loadContent(page, view_type) {
                $.ajax({
                    url: "{{ route('get-grid-view') }}",
                    type: 'post',
                    data: {
                        page: page,
                        view_type: view_type
                    },
                    success: function(response) {
                        $('#products-container').html(response.html);
                        $('#pagination-container').html(response.pagination);
                    },
                    error: function() {
                        console.log('Error loading content.');
                    }
                });
            }

            // Load the initial content on page load
            loadContent(1, 'layout-grid');

            // Event listener for pagination click
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var view_type = $('.layout-toggle .active').attr('type');
                loadContent(page, view_type);
            });

            // Event listener for layout toggle
            $('.layout-toggle a').on('click', function(e) {
                e.preventDefault();
                $('.layout-toggle a').removeClass('active');
                $(this).addClass('active');

                var type = $(this).attr('type');
                loadContent(1, type); // Load the first page of the selected view type
            });
        });
    </script>
@endpush
