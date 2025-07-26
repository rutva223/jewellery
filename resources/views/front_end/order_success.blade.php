@extends('front_end.app')
@section('content')
    <div id="title" class="page-title">
        <div class="section-container">
            <div class="content-title-heading">
                <h1 class="text-title-heading">
                    Order Successful
                </h1>
            </div>
            <div class="breadcrumbs">
                <a href="{{ route('home') }}">Home</a><span class="delimiter"></span>Order Success
            </div>
        </div>
    </div>

    <div id="content" class="site-content" role="main">
        <div class="section-padding">
            <div class="section-container p-l-r">
                <div class="order-success-content text-center">
                    <div class="success-icon" style="font-size: 60px; color: #4CAF50; margin-bottom: 20px;">
                        ✓
                    </div>
                    <h2 style="color: #4CAF50; margin-bottom: 20px;">Thank You for Your Order!</h2>
                    <p style="font-size: 18px; margin-bottom: 30px;">Your order has been successfully placed.</p>
                    
                    <div class="order-details" style="background: #f5f5f5; padding: 30px; border-radius: 10px; max-width: 600px; margin: 0 auto;">
                        <h3 style="margin-bottom: 20px;">Order Details</h3>
                        <table style="width: 100%; text-align: left;">
                            <tr>
                                <td style="padding: 10px;"><strong>Order Number:</strong></td>
                                <td style="padding: 10px;">{{ $order->order_number }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;"><strong>Order Date:</strong></td>
                                <td style="padding: 10px;">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;"><strong>Total Amount:</strong></td>
                                <td style="padding: 10px;">₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;"><strong>Payment Method:</strong></td>
                                <td style="padding: 10px;">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;"><strong>Payment Status:</strong></td>
                                <td style="padding: 10px;">
                                    @if($order->payment_status == 'paid')
                                        <span style="color: #4CAF50;">Paid</span>
                                    @elseif($order->payment_status == 'cod')
                                        <span style="color: #ff9800;">Cash on Delivery</span>
                                    @else
                                        <span style="color: #f44336;">{{ ucfirst($order->payment_status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="shipping-details" style="background: #f5f5f5; padding: 30px; border-radius: 10px; max-width: 600px; margin: 30px auto;">
                        <h3 style="margin-bottom: 20px;">Shipping Details</h3>
                        <p><strong>{{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}</strong></p>
                        <p>{{ $order->shippingAddress->address_1 }}</p>
                        @if($order->shippingAddress->address_2)
                            <p>{{ $order->shippingAddress->address_2 }}</p>
                        @endif
                        <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->postcode }}</p>
                        <p>{{ $order->shippingAddress->country }}</p>
                        <p>Phone: {{ $order->shippingAddress->phone }}</p>
                        <p>Email: {{ $order->shippingAddress->email }}</p>
                    </div>

                    <div class="order-items" style="background: #f5f5f5; padding: 30px; border-radius: 10px; max-width: 800px; margin: 30px auto;">
                        <h3 style="margin-bottom: 20px;">Order Items</h3>
                        <table style="width: 100%; text-align: left;">
                            <thead>
                                <tr style="border-bottom: 1px solid #ddd;">
                                    <th style="padding: 10px;">Product</th>
                                    <th style="padding: 10px;">Quantity</th>
                                    <th style="padding: 10px;">Price</th>
                                    <th style="padding: 10px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 10px;">{{ $item->product_name }}</td>
                                    <td style="padding: 10px;">{{ $item->quantity }}</td>
                                    <td style="padding: 10px;">₹{{ number_format($item->price, 2) }}</td>
                                    <td style="padding: 10px;">₹{{ number_format($item->total, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" style="padding: 10px; text-align: right;"><strong>Total:</strong></td>
                                    <td style="padding: 10px;"><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="actions" style="margin-top: 40px;">
                        <a href="{{ route('home') }}" class="button" style="margin-right: 10px;">Continue Shopping</a>
                        <a href="{{ route('profile') }}" class="button alt">View My Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection