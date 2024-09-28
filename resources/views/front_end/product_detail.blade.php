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
                                                @if(is_array($product->images) && count($product->images) > 0)
                                                    @foreach($product->images as $image)
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
                                                            <img width="600" height="600" src="{{ asset('front_end/media/product/1-2.jpg') }}"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="scroll-image main-image">
                                            <div class="image-additional slick-carousel" data-asnavfor=".image-thumbnail"
                                                data-fade="true" data-columns4="1" data-columns3="1" data-columns2="1"
                                                data-columns1="1" data-columns="1" data-nav="true">
                                                @if(is_array($product->images) && count($product->images) > 0)
                                                    @foreach($product->images as $image)
                                                        <div class="img-item slick-slide">
                                                            <img width="900" height="900" src="{{ $image }}"
                                                                alt="{{ $product->product_name }}" title="{{ $product->product_name }}">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="img-item slick-slide">
                                                        <img width="900" height="900" src="{{ asset('front_end/media/product/1.jpg') }}"
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
                                    <del aria-hidden="true"><span>{{ $product->product_price }}</span></del>
                                    <ins><span>{{ $product->sell_price }}</span></ins>
                                </span>
                                <div class="rating">
                                    <div class="star star-5"></div>
                                    <div class="review-count">
                                        (3<span> reviews</span>)
                                    </div>
                                </div>
                                <div class="description">
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <div class="buttons">
                                    <div class="add-to-cart-wrap">
                                        <div class="quantity">
                                            <button type="button" class="plus">+</button>
                                            <input type="number" class="qty" step="1" min="0"
                                                max="" name="quantity" value="1" title="Qty"
                                                size="4" placeholder="" inputmode="numeric" autocomplete="off">
                                            <button type="button" class="minus">-</button>
                                        </div>
                                        <div class="btn-add-to-cart" data-product-id="{{ $product->id }}">
                                            <a href="#" tabindex="0">Add to cart</a>
                                        </div>
                                    </div>
                                    <div class="btn-quick-buy" data-title="Wishlist">
                                        <button class="product-btn">Buy It Now</button>
                                    </div>
                                    <div class="btn-wishlist" data-title="Wishlist">
                                        <button class="product-btn">Add to wishlist</button>
                                    </div>
                                </div>
                                <div class="product-meta">
                                    <span class="posted-in">Category: <a
                                            href="{{ route('catwiseproduct', $product->category->name) }}"
                                            rel="tag">{{ $product->category->name }}</a></span>
                                </div>
                                <div class="social-share">
                                    <a href="shop-details.html#" title="Facebook" class="share-facebook"
                                        target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
                                    <a href="shop-details.html#" title="Twitter" class="share-twitter"><i
                                            class="fa fa-twitter"></i>Twitter</a>
                                    <a href="shop-details.html#" title="Pinterest" class="share-pinterest"><i
                                            class="fa fa-pinterest"></i>Pinterest</a>
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
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="shop-details.html#additional-information"
                                        role="tab">Additional information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="shop-details.html#reviews"
                                        role="tab">Reviews (1)</a>
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
                                <div class="tab-pane fade" id="additional-information" role="tabpanel">
                                    <table class="product-attributes">
                                        <tbody>
                                            <tr class="attribute-item">
                                                <th class="attribute-label">Color</th>
                                                <td class="attribute-value">Antique, Chestnut, Grullo</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div id="reviews" class="product-reviews">
                                        <div id="comments">
                                            <h2 class="reviews-title">1 review for <span>Bora Armchair</span></h2>
                                            <ol class="comment-list">
                                                <li class="review">
                                                    <div class="content-comment-container">
                                                        <div class="comment-container">
                                                            <img src="media/user.jpg" class="avatar" height="60"
                                                                width="60" alt="">
                                                            <div class="comment-text">
                                                                <div class="rating small">
                                                                    <div class="star star-5"></div>
                                                                </div>
                                                                <div class="review-author">Peter Capidal</div>
                                                                <div class="review-time">January 12, 2023</div>
                                                            </div>
                                                        </div>
                                                        <div class="description">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                                fringilla augue nec est tristique auctor. Donec non est at
                                                                libero vulputate rutrum. Morbi ornare lectus quis justo
                                                                gravida semper. Nulla tellus mi, vulputate adipiscing cursus
                                                                eu, suscipit id nulla.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div>
                                        <div id="review-form">
                                            <div id="respond" class="comment-respond">
                                                <span id="reply-title" class="comment-reply-title">Add a review</span>
                                                <form action="shop-details.html" method="post" id="comment-form"
                                                    class="comment-form">
                                                    <p class="comment-notes">
                                                        <span id="email-notes">Your email address will not be
                                                            published.</span> Required fields are marked <span
                                                            class="required">*</span>
                                                    </p>
                                                    <div class="comment-form-rating">
                                                        <label for="rating">Your rating</label>
                                                        <p class="stars">
                                                            <span>
                                                                <a class="star-1" href="shop-details.html#">1</a><a
                                                                    class="star-2" href="shop-details.html#">2</a><a
                                                                    class="star-3" href="shop-details.html#">3</a><a
                                                                    class="star-4" href="shop-details.html#">4</a><a
                                                                    class="star-5" href="shop-details.html#">5</a>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <p class="comment-form-comment">
                                                        <textarea id="comment" name="comment" placeholder="Your Reviews *" cols="45" rows="8"
                                                            aria-required="true" required=""></textarea>
                                                    </p>
                                                    <div class="content-info-reviews">
                                                        <p class="comment-form-author">
                                                            <input id="author" name="author" placeholder="Name *"
                                                                type="text" value="" size="30"
                                                                aria-required="true" required="">
                                                        </p>
                                                        <p class="comment-form-email">
                                                            <input id="email" name="email" placeholder="Email *"
                                                                type="email" value="" size="30"
                                                                aria-required="true" required="">
                                                        </p>
                                                        <p class="form-submit">
                                                            <input name="submit" type="submit" id="submit"
                                                                class="submit" value="Submit">
                                                        </p>
                                                    </div>
                                                </form><!-- #respond -->
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
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
                                                                <div class="hot">Hot</div>
                                                            </div>
                                                            @php
                                                                // Decode the JSON string into an array of full URLs
                                                                $images = $value->images; // This uses the accessor to get the full URLs
                                                            @endphp


                                                            <div class="product-thumb-hover">
                                                                <a href="{{ route('product_detail', $product->id) }}">
                                                                    @if (is_array($images) && count($images) > 0)
                                                                        <img src="{{ $images[0] }}"
                                                                            width="600" height="600"
                                                                            alt="Product Image" class="post-image">
                                                                        @if (isset($images[1]))
                                                                            <img src="{{ $images[1] }}"
                                                                                width="600" height="600"
                                                                                alt="Product Image"
                                                                                class="hover-image back">
                                                                        @else
                                                                            <img src="{{ $images[0] }}"
                                                                                width="600" height="600"
                                                                                alt="Product Image"
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
                                                                <div class="btn-add-to-cart" data-title="Add to cart" data-product-id="{{ $product->id }}">
                                                                    <a rel="nofollow" href="#"  
                                                                        class="product-btn button">Add to cart</a>
                                                                </div>
                                                                <div class="btn-wishlist" data-title="Wishlist">
                                                                    <button class="product-btn">Add to wishlist</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="products-content">
                                                            <div class="contents text-center">
                                                                <h3 class="product-title"><a href="{{ route('product_detail', $value->id) }}">{{ $value->product_name }}</a></h3>
                                                                <div class="rating">
                                                                    <div class="star star-5"></div>
                                                                </div>
                                                                <span class="price">{{ $value->sell_price }}</span>
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
