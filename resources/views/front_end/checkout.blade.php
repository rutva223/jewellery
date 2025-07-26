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
                                                                    height="600" alt="Product Image">
                                                            @else
                                                                <img src="{{ asset('front_end/media/product/1.jpg') }}"
                                                                    width="600" height="600" alt="Default Image">
                                                            @endif
                                                        </div>

                                                        <div class="product-name">
                                                            {{ $product->name }}
                                                            <div class="quantity-controls" style="margin-top: 10px;">
                                                                <button type="button" class="qty-minus" data-id="{{ $product->id }}" style="width: 30px; height: 30px; border: 1px solid #ddd; background: #fff; cursor: pointer;">-</button>
                                                                <input type="text" class="qty-input" data-id="{{ $product->id }}" value="{{ $product->quantity }}" style="width: 50px; height: 30px; text-align: center; border: 1px solid #ddd; margin: 0 5px;" readonly>
                                                                <button type="button" class="qty-plus" data-id="{{ $product->id }}" style="width: 30px; height: 30px; border: 1px solid #ddd; background: #fff; cursor: pointer;">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-total">
                                                        <span class="item-total" data-id="{{ $product->id }}" data-price="{{ $product->price }}">₹{{ number_format($product->price * $product->quantity, 2) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="cart-subtotal">
                                            <h2>Subtotal</h2>
                                            <div class="subtotal-price">
                                                <span id="checkout-subtotal">₹{{ number_format($subtotal, 2) }}</span>
                                            </div>
                                        </div>
                                        {{-- <div class="shipping-totals shipping">
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
                                        </div> --}}
                                        <div class="order-total">
                                            <h2>Total</h2>
                                            <div class="total-price">
                                                <strong>
                                                    <span id="checkout-total">₹{{ number_format($subtotal, 2) }}</span>
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
                                                    <p>Pay via PayPal; you can pay with your credit card if you don't have a
                                                        PayPal account.</p>
                                                </div>
                                            </li>
                                            <li class="payment-method">
                                                <input type="radio" class="input-radio" name="payment_method"
                                                    value="razorpay">
                                                <label>Razorpay</label>
                                                <div class="payment-box" style="display: none;">
                                                    <p>Pay securely using Razorpay. Accept Credit/Debit Cards, Net Banking, UPI, and Wallets.</p>
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function() {
        // Quantity controls
        $('.qty-minus').on('click', function() {
            var id = $(this).data('id');
            var input = $('.qty-input[data-id="' + id + '"]');
            var currentVal = parseInt(input.val());
            
            if (currentVal > 1) {
                input.val(currentVal - 1);
                updateQuantity(id, currentVal - 1);
            }
        });

        $('.qty-plus').on('click', function() {
            var id = $(this).data('id');
            var input = $('.qty-input[data-id="' + id + '"]');
            var currentVal = parseInt(input.val());
            
            input.val(currentVal + 1);
            updateQuantity(id, currentVal + 1);
        });

        function updateQuantity(cartId, quantity) {
            $.ajax({
                url: '{{ route("update.cart.quantity") }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": cartId,
                    "quantity": quantity
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Update item total
                        var price = $('.item-total[data-id="' + cartId + '"]').data('price');
                        var newTotal = (price * quantity).toFixed(2);
                        $('.item-total[data-id="' + cartId + '"]').text('₹' + newTotal);
                        
                        // Update totals
                        updateTotals();
                    } else {
                        alert('Error updating quantity');
                    }
                },
                error: function() {
                    alert('Error updating quantity');
                }
            });
        }

        function updateTotals() {
            var subtotal = 0;
            $('.item-total').each(function() {
                var total = parseFloat($(this).text().replace('₹', ''));
                subtotal += total;
            });
            
            $('#checkout-subtotal').text('₹' + subtotal.toFixed(2));
            $('#checkout-total').text('₹' + subtotal.toFixed(2));
        }

        // Original form save functionality
        $('input, textarea').on('blur', function() {
             var $form = $(this).closest('form');
             var data = $form.serialize();
            $.ajax({
                url: "{{route('save.checkout.data') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "data": data,
                },
                success: function(response) {
                    console.log('Data saved:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error saving data:', error);
                }
            });
        });

        // Handle payment method selection
        $('input[name="payment_method"]').on('change', function() {
            $('.payment-box').hide();
            $(this).closest('li').find('.payment-box').show();
        });

        // Handle form submission
        $('form.checkout').on('submit', function(e) {
            e.preventDefault();
            var selectedPayment = $('input[name="payment_method"]:checked').val();
            var form = $(this);
            
            if (selectedPayment === 'razorpay') {
                // Collect form data
                var formData = form.serialize();
                
                // Get total amount in paise (multiply by 100)
                var totalAmount = parseFloat($('#checkout-total').text().replace('₹', '').replace(',', '')) * 100;
                
                // Create order via AJAX
                $.ajax({
                    url: '{{ route("razorpay.create.order") }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "amount": totalAmount,
                        "form_data": formData
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Configure Razorpay options
                            var options = {
                                "key": response.razorpay_key,
                                "amount": response.amount,
                                "currency": "INR",
                                "name": "Jewellery Store",
                                "description": "Order Payment",
                                "order_id": response.order_id,
                                "handler": function (razorpayResponse) {
                                    // Handle successful payment
                                    verifyPayment(razorpayResponse, formData);
                                },
                                "prefill": {
                                    "name": $('input[name="billing_first_name"]').val() + ' ' + $('input[name="billing_last_name"]').val(),
                                    "email": $('input[name="billing_email"]').val(),
                                    "contact": $('input[name="billing_phone"]').val()
                                },
                                "theme": {
                                    "color": "#3399cc"
                                }
                            };
                            
                            var rzp = new Razorpay(options);
                            rzp.open();
                        } else {
                            alert('Error creating order. Please try again.');
                        }
                    },
                    error: function() {
                        alert('Error processing payment. Please try again.');
                    }
                });
            } else {
                // Handle other payment methods
                alert('Please implement ' + selectedPayment + ' payment processing');
            }
        });

        // Verify payment
        function verifyPayment(razorpayResponse, formData) {
            $.ajax({
                url: '{{ route("razorpay.verify.payment") }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "razorpay_payment_id": razorpayResponse.razorpay_payment_id,
                    "razorpay_order_id": razorpayResponse.razorpay_order_id,
                    "razorpay_signature": razorpayResponse.razorpay_signature,
                    "form_data": formData
                },
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect_url;
                    } else {
                        alert('Payment verification failed. Please contact support.');
                    }
                },
                error: function() {
                    alert('Error verifying payment. Please contact support.');
                }
            });
        }
    });
</script>
@endpush


