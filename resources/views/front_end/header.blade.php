<header id="site-header" class="site-header header-v1 @if ($body == 'home') color-white @endif">
    <div class="header-mobile">
        <div class="section-padding">
            <div class="section-container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-left">
                        <div class="navbar-header">
                            <button type="button" id="show-megamenu" class="navbar-toggle"></button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 header-center">
                        <div class="site-logo">
                            <a href="index.html">
                                <img width="400" height="79" src="{{ asset('front_end/media/logo-white.png') }}"
                                    alt="Mojuri – Jewelry Store HTML Template" />
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-right">
                        <div class="mojuri-topcart dropdown">
                            <div class="dropdown mini-cart top-cart">
                                <div class="remove-cart-shadow"></div>
                                <a class="dropdown-toggle cart-icon" href="index.html#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="icons-cart"><i class="icon-large-paper-bag"></i><span
                                            class="cart-count">2</span></div>
                                </a>
                                <div class="dropdown-menu cart-popup">
                                    <div class="cart-empty-wrap">
                                        <ul class="cart-list">
                                            <li class="empty">
                                                <span>No products in the cart.</span>
                                                <a class="go-shop" href="shop-grid-left.html">GO TO SHOP<i
                                                        aria-hidden="true" class="arrow_right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cart-list-wrap">
                                        <ul class="cart-list ">
                                            <li class="mini-cart-item">
                                                <a href="index.html#" class="remove" title="Remove this item"><i
                                                        class="icon_close"></i></a>
                                                <a href="shop-details.html" class="product-image"><img width="600"
                                                        height="600"
                                                        src="{{ asset('front_end/media/product/3.jpg') }}"
                                                        alt=""></a>
                                                <a href="shop-details.html" class="product-name">Twin Hoops</a>
                                                <div class="quantity">Qty: 1</div>
                                                <div class="price">$150.00</div>
                                            </li>
                                            <li class="mini-cart-item">
                                                <a href="index.html#" class="remove" title="Remove this item"><i
                                                        class="icon_close"></i></a>
                                                <a href="shop-details.html" class="product-image"><img width="600"
                                                        height="600"
                                                        src="{{ asset('front_end/media/product/1.jpg') }}"
                                                        alt=""></a>
                                                <a href="shop-details.html" class="product-name">Medium Flat Hoops</a>
                                                <div class="quantity">Qty: 1</div>
                                                <div class="price">$100.00</div>
                                            </li>
                                        </ul>
                                        <div class="total-cart">
                                            <div class="title-total">Total: </div>
                                            <div class="total-price"><span>$250.00</span></div>
                                        </div>
                                        <div class="free-ship">
                                            <div class="title-ship">Buy <strong>$400</strong> more to enjoy <strong>FREE
                                                    Shipping</strong></div>
                                            <div class="total-percent">
                                                <div class="percent" style="width:20%"></div>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <a href="shop-cart.html" class="button btn view-cart btn-primary">View
                                                cart</a>
                                            <a href="shop-checkout.html" class="button btn checkout btn-default">Check
                                                out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-mobile-fixed">
            <!-- Shop -->
            <div class="shop-page">
                <a href="shop-grid-left.html"><i class="wpb-icon-shop"></i></a>
            </div>

            <!-- Login -->
            <div class="my-account">
                <div class="login-header">
                    <a href="page-my-account.html"><i class="wpb-icon-user"></i></a>
                </div>
            </div>

            <!-- Search -->
            <div class="search-box">
                <div class="search-toggle"><i class="wpb-icon-magnifying-glass"></i></div>
            </div>

            <!-- Wishlist -->
            <div class="wishlist-box">
                <a href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
            </div>
        </div>
    </div>

    <div class="header-desktop">
        <div class="header-wrapper">
            <div class="section-padding">
                <div class="section-container large p-l-r">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 header-left">
                            <div class="site-logo">
                                <a href="index.html">
                                    <img width="400" height="140"
                                        src="{{ asset('front_end/media/logo-white.png') }}"
                                        alt="Mojuri – Jewelry Store HTML Template" />
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-center header-center">
                            <div class="site-navigation">
                                <nav id="main-navigation">
                                    <ul id="menu-main-menu" class="menu">
                                        <li class="level-0 menu-item current-menu-item">
                                            <a href="{{ route('home') }}">Logo</a>
                                        </li>
                                        {{-- <li class="level-0 menu-item menu-item-has-children">
                                            <a href="shop-grid-left.html"><span class="menu-item-text">Shop</span></a>
                                            <ul class="sub-menu">
                                                <li class="level-1 menu-item menu-item-has-children">
                                                    <a href="shop-grid-left.html"><span class="menu-item-text">Shop -
                                                            Products</span></a>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <a href="shop-grid-left.html"><span
                                                                    class="menu-item-text">Shop Grid - Left
                                                                    Sidebar</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="shop-list-left.html"><span
                                                                    class="menu-item-text">Shop List - Left
                                                                    Sidebar</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="shop-grid-right.html"><span
                                                                    class="menu-item-text">Shop Grid - Right
                                                                    Sidebar</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="shop-list-right.html"><span
                                                                    class="menu-item-text">Shop List - Right
                                                                    Sidebar</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="shop-grid-fullwidth.html"><span
                                                                    class="menu-item-text">Shop Grid - No
                                                                    Sidebar</span></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="shop-details.html"><span class="menu-item-text">Shop
                                                            Details</span></a>
                                                </li>
                                                <li>
                                                    <a href="shop-cart.html"><span class="menu-item-text">Shop -
                                                            Cart</span></a>
                                                </li>
                                                <li>
                                                    <a href="shop-checkout.html"><span class="menu-item-text">Shop -
                                                            Checkout</span></a>
                                                </li>
                                                <li>
                                                    <a href="shop-wishlist.html"><span class="menu-item-text">Shop -
                                                            Wishlist</span></a>
                                                </li>


                                            </ul>
                                        </li> --}}
                                        @foreach (AllCategories() as $cat)
                                            <li class="level-0 menu-item">
                                                <a href="{{ route('catwiseproduct',$cat->name) }}"><span
                                                        class="menu-item-text">{{ $cat->name }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 header-right">
                            <div class="header-page-link">
                                <!-- Search -->
                                <div class="search-box">
                                    <div class="search-toggle"><i class="icon-search"></i></div>
                                </div>

                                <!-- Login -->
                                <div class="login-header icon">
                                    <a class="active-login" href="index.html#"><i class="icon-user"></i></a>
                                    <div class="form-login-register">
                                        <div class="box-form-login">
                                            <div class="active-login"></div>
                                            <div class="box-content">
                                                <div class="form-login active">
                                                    <form action="{{ route('user-login') }}" id="login_ajax" method="post" class="login">
                                                        @csrf
                                                        <h2>Sign in</h2>
                                                        <p class="status"></p>
                                                        <div class="content">
                                                            <div class="email">
                                                                <input type="email" required="required"
                                                                    class="input-text" name="email" id="email"
                                                                    placeholder="Your Email" />
                                                            </div>
                                                            <div class="password">
                                                                <input class="input-text" required="required"
                                                                    type="password" name="password" id="password"
                                                                    placeholder="Password" />
                                                            </div>
                                                            {{-- <div class="rememberme-lost">
                                                                <div class="lost_password">
                                                                    <a href="{{ route('forgot-pass') }}">
                                                                        Lost your password?
                                                                    </a>
                                                                </div>
                                                            </div> --}}
                                                            <div class="button-login">
                                                                <input type="submit" class="button" name="login"
                                                                    value="Login" />
                                                            </div>
                                                            <div class="button-next-reregister">Create An Account</div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="form-register">
                                                    <form action="{{ route('user-register') }}" method="post" class="register">
                                                        @csrf
                                                        <h2>REGISTER</h2>
                                                        <div class="content">
                                                            <div class="email">
                                                                <input type="email" class="input-text"
                                                                    placeholder="Email" name="email" id="reg_email"
                                                                    value="" />
                                                            </div>
                                                            <div class="password">
                                                                <input type="password" class="input-text"
                                                                    placeholder="Password" name="password"
                                                                    id="reg_password" />
                                                            </div>
                                                            <div class="button-register">
                                                                <input type="submit" class="button" name="register"
                                                                    value="Register" />
                                                            </div>
                                                            <div class="button-next-login">Already has an account</div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Wishlist -->
                                <div class="wishlist-box">
                                    <a href="shop-wishlist.html"><i class="icon-heart"></i></a>
                                    <span class="count-wishlist">1</span>
                                </div>

                                <!-- Cart -->
                                <div class="mojuri-topcart dropdown light">
                                    <div class="dropdown mini-cart top-cart">
                                        <div class="remove-cart-shadow"></div>
                                        <a class="dropdown-toggle cart-icon" href="index.html#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="icons-cart"><i class="icon-large-paper-bag"></i><span
                                                    class="cart-count">2</span></div>
                                        </a>
                                        <div class="dropdown-menu cart-popup">
                                            <div class="cart-empty-wrap">
                                                <ul class="cart-list">
                                                    <li class="empty">
                                                        <span>No products in the cart.</span>
                                                        <a class="go-shop" href="shop-grid-left.html">GO TO SHOP<i
                                                                aria-hidden="true" class="arrow_right"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="cart-list-wrap">
                                                <ul class="cart-list ">
                                                    <li class="mini-cart-item">
                                                        <a href="index.html#" class="remove"
                                                            title="Remove this item"><i class="icon_close"></i></a>
                                                        <a href="shop-details.html" class="product-image"><img
                                                                width="600" height="600"
                                                                src="{{ asset('front_end/media/product/3.jpg') }}"
                                                                alt=""></a>
                                                        <a href="shop-details.html" class="product-name">Twin
                                                            Hoops</a>
                                                        <div class="quantity">Qty: 1</div>
                                                        <div class="price">$150.00</div>
                                                    </li>
                                                    <li class="mini-cart-item">
                                                        <a href="index.html#" class="remove"
                                                            title="Remove this item"><i class="icon_close"></i></a>
                                                        <a href="shop-details.html" class="product-image"><img
                                                                width="600" height="600"
                                                                src="{{ asset('front_end/media/product/1.jpg') }}"
                                                                alt=""></a>
                                                        <a href="shop-details.html" class="product-name">Medium Flat
                                                            Hoops</a>
                                                        <div class="quantity">Qty: 1</div>
                                                        <div class="price">$100.00</div>
                                                    </li>
                                                </ul>
                                                <div class="total-cart">
                                                    <div class="title-total">Total: </div>
                                                    <div class="total-price"><span>$250.00</span></div>
                                                </div>
                                                <div class="free-ship">
                                                    <div class="title-ship">Buy <strong>$400</strong> more to enjoy
                                                        <strong>FREE Shipping</strong></div>
                                                    <div class="total-percent">
                                                        <div class="percent" style="width:20%"></div>
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <a href="shop-cart.html"
                                                        class="button btn view-cart btn-primary">View cart</a>
                                                    <a href="shop-checkout.html"
                                                        class="button btn checkout btn-default">Check out</a>
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
    </div>
</header>
