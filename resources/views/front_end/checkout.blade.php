@extends('front_end.app')
@section('content')
    <div id="title" class="page-title">
        <div class="section-container">
            <div class="content-title-heading">
                <h1 class="text-title-heading">
                    Checkout
                </h1>
            </div>
            <div class="breadcrumbs">
                <a href="index.html">Home</a><span class="delimiter"></span><a href="shop-grid-left.html">Shop</a><span
                    class="delimiter"></span>Checkout
            </div>
        </div>
    </div>

    <div id="content" class="site-content" role="main">
        <div class="section-padding">
            <div class="section-container p-l-r">
                <div class="shop-checkout">
                    <form name="checkout" method="post" class="checkout" action="" autocomplete="off">
                        <div class="row">
                            <div class="col-xl-8 col-lg-7 col-md-12 col-12">
                                <div class="customer-details">
                                    <div class="billing-fields">
                                        <h3>Personal Details</h3>
                                        <div class="billing-fields-wrapper">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="form-row form-row-first validate-required">
                                                        <label>Company Name <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_company" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row form-row-first validate-required">
                                                        <label>First name <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_first_name" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row form-row-last validate-required">
                                                        <label>Last name <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_last_name" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row form-row-wide validate-required validate-phone">
                                                        <label>Phone <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="tel" class="input-text" name="billing_phone" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row form-row-wide validate-required validate-email">
                                                        <label>Email address <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="email" class="input-text" name="billing_email" value="" autocomplete="off"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <h3>Shipping Details</h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>Street Address <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_address_1" placeholder="House number and street name" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="form-row address-field form-row-wide">
                                                        <label>Apartment, suite, unit, etc.&nbsp;<span class="optional">(optional)</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_address_2" placeholder="Apartment, suite, unit, etc. (optional)" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>City <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_city" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>State <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_state" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>Country <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_country" value=""></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>Postcode / ZIP <span class="required" title="required">*</span></label>
                                                        <span class="input-wrapper"><input type="text" class="input-text" name="billing_postcode" value=""></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-fields">
                                        <p class="form-row notes">
                                            <label>Order notes <span class="optional">(optional)</span></label>
                                            <span class="input-wrapper">
                                                <textarea name="order_comments" class="input-text" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-5 col-md-12 col-12">
                                <div class="checkout-review-order">
                                    <div class="checkout-review-order-table">
                                        <h3 class="review-order-title">Products</h3>
                                        <div class="cart-items">
                                            @foreach ($products as $product)
                                                <div class="cart-item">
                                                    @php
                                                        $images = $product->images;
                                                    @endphp
                                                    <div class="info-product">
                                                        <div class="product-thumbnail">

                                                            @if (is_array($images) && count($images) > 0)
                                                                <img src="{{ $images[0] }}" width="600"
                                                                    height="600">
                                                                @if (isset($images[1]))
                                                                    <img src="{{ $images[1] }}" width="600"
                                                                        height="600">
                                                                @else
                                                                    <img src="{{ $images[0] }}" width="600"
                                                                        height="600">
                                                                @endif
                                                            @else
                                                                <img src="{{ asset('front_end/media/product/1.jpg') }}"
                                                                    width="600" height="600">
                                                            @endif
                                                        </div>

                                                        <div class="product-name">
                                                            {{ $product->name }}
                                                            <strong class="product-quantity">QTY :
                                                                {{ $product->quantity }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="product-total">
                                                        <span>${{ number_format($product->price * $product->quantity, 2) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="cart-subtotal">
                                            <h2>Subtotal</h2>
                                            <div class="subtotal-price">
                                                <span>${{ number_format($subtotal, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="shipping-totals shipping">
                                            <h2>Shipping</h2>
                                            <div data-title="Shipping">
                                                <ul class="shipping-methods custom-radio">
                                                    <li>
                                                        <input type="radio" name="shipping_method" data-index="0"
                                                            value="free_shipping" class="shipping_method"
                                                            checked="checked">
                                                        <label>Free shipping</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="shipping_method" data-index="0"
                                                            value="flat_rate" class="shipping_method">
                                                        <label>Flat rate</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="order-total">
                                            <h2>Total</h2>
                                            <div class="total-price">
                                                <strong>
                                                    <span>${{ number_format($subtotal, 2) }}</span>
                                                </strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="payment" class="checkout-payment">
                                        <ul class="payment-methods methods custom-radio">
                                            <li class="payment-method">
                                                <input type="radio" class="input-radio" name="payment_method"
                                                    value="bacs" checked="checked">
                                                <label for="payment_method_bacs">Direct bank transfer</label>
                                                <div class="payment-box" style="">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order will not be shipped
                                                        until the funds have cleared in our account.</p>
                                                </div>
                                            </li>
                                            <li class="payment-method">
                                                <input type="radio" class="input-radio" name="payment_method"
                                                    value="cheque">
                                                <label>Check payments</label>
                                                <div class="payment-box" style="display: none;">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store
                                                        State / County, Store Postcode.</p>
                                                </div>
                                            </li>
                                            <li class="payment-method">
                                                <input type="radio" class="input-radio" name="payment_method"
                                                    value="cod">
                                                <label>Cash on delivery</label>
                                                <div class="payment-box" style="display: none;">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </li>
                                            <li class="payment-method">
                                                <input type="radio" class="input-radio" name="payment_method"
                                                    value="paypal">
                                                <label>PayPal</label>
                                                <div class="payment-box" style="display: none;">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                        PayPal account.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-row place-order">
                                            <div class="terms-and-conditions-wrapper">
                                                <div class="privacy-policy-text"></div>
                                            </div>
                                            <button type="submit" class="button alt" name="checkout_place_order"
                                                value="Place order">Place order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
<script>
    $(document).ready(function() {
        $('input, textarea').on('blur', function() {
            var data = $(this).closest('form').serialize(); // Serializes the form data
            $.ajax({
                url: 'save_checkout.php', // Change this to your server-side script
                type: 'POST',
                data: data,
                success: function(response) {
                    console.log('Data saved:', response); // Handle the response from the server
                },
                error: function(xhr, status, error) {
                    console.error('Error saving data:', error);
                }
            });
        });
    });
    </script>

@endpush


