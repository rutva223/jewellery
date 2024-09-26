@extends('front_end.app')
@section('content')
    <style>
        .price-range-slider {
            width: 100%;
            float: left;
            padding: 10px 20px;

            .range-value {
                margin: 0;

                input {
                    width: 100%;
                    background: none;
                    color: #000;
                    font-size: 16px;
                    font-weight: initial;
                    box-shadow: none;
                    border: none;
                    margin: 20px 0 20px 0;
                }
            }

            .range-bar {
                border: none;
                background: #000;
                height: 3px;
                width: 96%;
                margin-left: 8px;

                .ui-slider-range {
                    background: #06b9c0;
                }

                .ui-slider-handle {
                    border: none;
                    border-radius: 25px;
                    background: #fff;
                    border: 2px solid #06b9c0;
                    height: 17px;
                    width: 17px;
                    top: -0.52em;
                    cursor: pointer;
                }

                .ui-slider-handle+span {
                    background: #06b9c0;
                }
            }
        }
    </style>
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
                                        @php
                                            $all_categories = AllCategories();
                                        @endphp
                                        @foreach ($all_categories as $cat)
                                            <li class="current">
                                                <a href="{{ route('catwiseproduct', $cat->name) }}">{{ $cat->name }}
                                                    <span class="count">{{ $all_categories->count() }}</span></a>
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
                                            <input id="price-filter" name="price" readonly />
                                        </div>
                                        <div class="layout-slider-settings"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-widget product-price-widget">
                            <div class="pro-itm has-children">
                                <a href="javascript:;" class="acnav-label"> {{ __('price') }} </a>
                                <div class="pro-itm-inner acnav-list">
                                    <div class="price-select d-flex">   
                                        <div class="select-col">
                                            <p>
                                                {{ __('min price') }} : <span class="min_price_select"
                                                    price="0">₹ {{ 0 }}</span>
                                            </p>
                                        </div>
                                        <div class="select-col">
                                            <p>{{ __('max price') }} : <span class="max_price_select"
                                                    price="100">₹100 </span> </p>
                                        </div>
                                    </div>
                                    <div id="range-slider">
                                        <div id="slider-range" class="slider-range" min_price="0"
                                            max_price="100" price_step="1"
                                            currency="₹"></div>
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
                                    <ul class="sort-list dropdown-menu">
                                        <li class="active"><a href="#" data-sort="default">Default sorting</a></li>
                                        <li><a href="#" data-sort="popularity">Sort by popularity</a></li>
                                        <li><a href="#" data-sort="rating">Sort by average rating</a></li>
                                        <li><a href="#" data-sort="latest">Sort by latest</a></li>
                                        <li><a href="#" data-sort="price_low_high">Sort by price: low to high</a></li>
                                        <li><a href="#" data-sort="price_high_low">Sort by price: high to low</a></li>
                                    </ul>

                                </div>
                                <ul class="layout-toggle nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="layout-grid nav-link active" data-toggle="tab" href="#layout-grid"
                                            type="layout-grid" role="tab" cat-id="{{ $cat_id }}"><span
                                                class="icon-column"><span
                                                    class="layer first"><span></span><span></span><span></span></span><span
                                                    class="layer middle"><span></span><span></span><span></span></span><span
                                                    class="layer last"><span></span><span></span><span></span></span></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="layout-list nav-link" data-toggle="tab" href="#layout-list"
                                            role="tab" type="layout-list" cat-id="{{ $cat_id }}"><span
                                                class="icon-column"><span
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!-- Ion Range Slider JS -->
<script src="https://cdn.jsdelivr.net/npm/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
@push('after-scripts')
    <!-- Ion Range Slider CSS -->

    <script>
        $(function() {
            $("#slider-range").slider({
                range: true, // Enable range selection
                min: 0, // Minimum value
                max: 100, // Maximum value
                values: [0, 100], // Initial values
                slide: function(event, ui) {
                    // Show the selected range values while sliding
                    $("#price-filter").val(ui.values[0] + " - " + ui.values[1]);
                }
            });
            // Set the initial range display
            $("#price-filter").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider(
                "values", 1));
        });

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // Function to load content via AJAX
            function loadContent(page, view_type, cat_id, priceRange = null) {
                $.ajax({
                    url: "{{ route('get-grid-view') }}",
                    type: 'post',
                    data: {
                        page: page,
                        view_type: view_type,
                        cat_id: cat_id,
                        price_range: priceRange // Send the price range to the server
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

            var cat_id = "{{ $cat_id }}";
            // Load the initial content on page load
            loadContent(1, 'layout-grid', cat_id);

            // Event listener for pagination click
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var view_type = $('.layout-toggle .active').attr('type');
                var cat_id = $('.layout-toggle .active').attr('cat-id');
                loadContent(page, view_type, cat_id);
            });

            // Event listener for layout toggle
            $('.layout-toggle a').on('click', function(e) {
                e.preventDefault();
                $('.layout-toggle a').removeClass('active');
                $(this).addClass('active');

                var type = $(this).attr('type');
                var cat_id = $(this).attr('cat-id');
                loadContent(1, type, cat_id); // Load the first page of the selected view type
            });
        });
    </script>
@endpush
