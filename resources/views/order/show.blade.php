@extends('layouts.app')
@section('title', 'Admin :: Order Details')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item first"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Order #{{ $order->order_number }}</h3>
                <span class="badge badge-primary">{{ ucfirst($order->payment_status) }}</span>
                <span class="badge badge-info">{{ ucfirst($order->shipping_status) }}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Customer Information</h4>
                        @if($order->user)
                            <p><strong>Name:</strong> {{ $order->user->name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                        @else
                            <p>Guest User</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4>Shipping Address</h4>
                        @if($order->shippingAddress)
                            <p>{{ $order->shippingAddress->address_line_1 }}</p>
                            @if($order->shippingAddress->address_line_2)
                                <p>{{ $order->shippingAddress->address_line_2 }}</p>
                            @endif
                            <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->zip_code }}</p>
                            <p>{{ $order->shippingAddress->country }}</p>
                            <p><strong>Phone:</strong> {{ $order->shippingAddress->phone }}</p>
                        @else
                            <p>No shipping address available</p>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Order Items</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                @if($item->image)
                                                    <img src="{{ asset($item->image) }}" alt="{{ $item->product_name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image" style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>₹{{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>₹{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Subtotal:</th>
                                        <th>₹{{ number_format($order->orderItems->sum('total'), 2) }}</th>
                                    </tr>
                                    @if($order->discount_amount > 0)
                                        <tr>
                                            <th colspan="4" class="text-right">Discount ({{ $order->coupon_code }}):</th>
                                            <th>-₹{{ number_format($order->discount_amount, 2) }}</th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th colspan="4" class="text-right">Total Amount:</th>
                                        <th>₹{{ number_format($order->total_amount, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h4>Payment Information</h4>
                        <p><strong>Method:</strong> {{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                        @if($order->razorpay_order_id)
                            <p><strong>Razorpay Order ID:</strong> {{ $order->razorpay_order_id }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4>Order Notes</h4>
                        <p>{{ $order->order_notes ?? 'No notes available' }}</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection