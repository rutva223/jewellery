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
                <a href="{{ route('home') }}">Home</a>
                <span class="delimiter"></span>{{ $cat_name }}
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
                                        @php
                                            $all_categories = AllCategories();
                                        @endphp
                                        @foreach ($all_categories as $cat)
                                            <li class="current">
                                                <a href="{{ route('catwiseproduct', $cat->name) }}">{{ $cat->name }}
                                                    <span class="count">{{ $cat->products->count() }}</span>
                                                </a>
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
                                            <input id="price-filter" name="price" value="0;{{$max_price}}" />
                                            <input type="hidden" value="{{ $max_price }}" id="max-price">
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
                            <div class="product-thumb-hover">
                                <ul class="products-list">
                                    @foreach ($products->take(3) as $p)
                                        <li class="product-item">
                                            <a href="{{ route('product_detail', $p->id) }}" class="product-image">
                                                @if (is_array($p->images) && count($p->images) > 0)
                                                    <img src="{{ $p->images[0] }}" width="600" height="600"
                                                            alt="Product Image" class="hover-image back">
                                                @else
                                                    <img src="{{ asset('front_end/media/product/1.jpg') }}" width="600"
                                                        height="600" alt="Default Image">
                                                @endif
                                            </a>
                                            <div class="product-content">
                                                <h2 class="product-title">
                                                    <a href="{{ route('product_detail', $p->id) }}">
                                                        {{ $p->product_name }}
                                                    </a>
                                                </h2>
                                                <span class="price">
                                                    <del aria-hidden="true"><span>₹{{ $p->product_price }}</span></del>
                                                    <ins><span>₹{{ $p->sell_price }}</span></ins>
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                        <div class="products-topbar clearfix">
                            <div class="products-topbar-right">
                                <div class="products-sort dropdown">
                                    <span class="sort-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="true" id="sorting-message">Default sorting</span>
                                    <ul class="sort-list dropdown-menu">
                                        <li class="active"><a href="#" data-sort="default">Default sorting</a></li>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('after-scripts')
    <script>
        $(document).ready(function() {
            // Set up CSRF for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var cat_id = "{{ $cat_id }}";

            // Function to load content via AJAX, including price filter values
            function loadContent(page, view_type, cat_id, price = 0, sort = 'default') {
                $.ajax({
                    url: "{{ route('get-grid-view') }}", // Adjust to your route
                    type: 'post',
                    data: {
                        page: page,
                        view_type: view_type,
                        cat_id: cat_id,
                        price: price,
                        sort: sort
                    },
                    success: function(response) {
                        $('#products-container').html(response.html); // Populate products
                        $('#pagination-container').html(response.pagination); // Update pagination
                    },
                    error: function() {
                        console.log('Error loading content.');
                    }
                });
            }

            // Initial content load on page load
            loadContent(1, 'layout-grid', cat_id);

            // Event listener for pagination click
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var view_type = $('.layout-toggle .active').attr('type');
                var sort = $('.sort-list .active a').data('sort');
                loadContent(page, view_type, cat_id, 0, sort); // Ensure filtered prices persist
            });

            // Event listener for layout toggle (grid/list view)
            $('.layout-toggle a').on('click', function(e) {
                e.preventDefault();
                $('.layout-toggle a').removeClass('active');
                $(this).addClass('active');
                var view_type = $('.layout-toggle .active').attr('type');
                var sort = $('.sort-list .active a').data('sort'); // Get current sort type
                loadContent(1, view_type, cat_id, 0, sort);
            });

            // Event listener for sorting
            $('.sort-list a').on('click', function(e) {
                e.preventDefault();
                $('.sort-list a').parent().removeClass('active');
                $(this).parent().addClass('active');

                var sort = $(this).data('sort'); // Get selected sort type
                var view_type = $('.layout-toggle .active').attr('type');
                loadContent(1, view_type, cat_id, 0, sort); // Reload content with selected sorting

                // Update sorting toggle text
                var sortText = $(this).text(); // Get the text of the selected sort option
                $('#sorting-message').text(sortText); // Reload content with selected sorting
            });

            $('#slider-range').on('click', function() {
                var price = $('#price-filter').val();
                var view_type = $('.layout-toggle .active').attr('type');
                var sort = $('.sort-list .active a').data('sort'); // Get current sort type

                loadContent(1, view_type, cat_id, price, sort);
            });
        });
    </script>
@endpush
