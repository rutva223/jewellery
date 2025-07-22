@extends('front_end.app')

@push('css')
<style>
    .order-status {
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .order-status.pending {
        background-color: #ffc107;
        color: #000;
    }
    .order-status.completed {
        background-color: #28a745;
        color: #fff;
    }
    .order-status.cancelled {
        background-color: #dc3545;
        color: #fff;
    }
    .order-status.cod {
        background-color: #17a2b8;
        color: #fff;
    }
    .order-details-toggle {
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
    }
    .order-details-toggle:hover {
        color: #0056b3;
    }
    .order-items {
        display: none;
        margin-top: 15px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    .order-items.show {
        display: block;
    }
    .order-item {
        padding: 10px 0;
        border-bottom: 1px solid #dee2e6;
    }
    .order-item:last-child {
        border-bottom: none;
    }
</style>
@endpush

@section('content')

<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
                My Orders
            </h1>
        </div>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a><span class="delimiter"></span>My Orders
        </div>
    </div>
</div>

<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="page-cart">
                @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="cart-items table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Order #</th>
                                    <th class="product-price">Date</th>
                                    <th class="product-quantity">Items</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-subtotal">Payment</th>
                                    <th class="product-subtotal">Status</th>
                                    <th class="product-remove">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="cart-item">
                                        <td class="product-thumbnail">
                                            <strong>{{ $order->order_number }}</strong>
                                        </td>
                                        <td class="product-price">
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                        <td class="product-quantity">
                                            {{ $order->items->count() }} items
                                        </td>
                                        <td class="product-subtotal">
                                            <strong>₹{{ number_format($order->total_amount, 2) }}</strong>
                                        </td>
                                        <td class="product-subtotal">
                                            @if($order->payment_status == 'completed')
                                                <span class="order-status completed">Paid</span>
                                            @elseif($order->payment_status == 'cod')
                                                <span class="order-status cod">COD</span>
                                            @elseif($order->payment_status == 'pending')
                                                <span class="order-status pending">Pending</span>
                                            @else
                                                <span class="order-status cancelled">{{ ucfirst($order->payment_status) }}</span>
                                            @endif
                                        </td>
                                        <td class="product-subtotal">
                                            @if($order->shipping_status == 'delivered')
                                                <span class="order-status completed">Delivered</span>
                                            @elseif($order->shipping_status == 'shipped')
                                                <span class="order-status cod">Shipped</span>
                                            @elseif($order->shipping_status == 'processing')
                                                <span class="order-status pending">Processing</span>
                                            @else
                                                <span class="order-status pending">{{ ucfirst($order->shipping_status) }}</span>
                                            @endif
                                        </td>
                                        <td class="product-remove">
                                            <a href="#" class="order-details-toggle" data-order-id="{{ $order->id }}">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="order-items-row">
                                        <td colspan="7" style="padding: 0;">
                                            <div class="order-items" id="order-items-{{ $order->id }}">
                                                <h4>Order Items</h4>
                                                @foreach($order->items as $item)
                                                    <div class="order-item">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>{{ $item->product_name }}</strong>
                                                            </div>
                                                            <div class="col-md-2 text-center">
                                                                Qty: {{ $item->quantity }}
                                                            </div>
                                                            <div class="col-md-2 text-right">
                                                                ₹{{ number_format($item->price, 2) }}
                                                            </div>
                                                            <div class="col-md-2 text-right">
                                                                <strong>₹{{ number_format($item->total, 2) }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                
                                                <div class="mt-3">
                                                    <h5>Shipping Address</h5>
                                                    <p>
                                                        {{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}<br>
                                                        {{ $order->shippingAddress->address_1 }}<br>
                                                        @if($order->shippingAddress->address_2)
                                                            {{ $order->shippingAddress->address_2 }}<br>
                                                        @endif
                                                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->postcode }}<br>
                                                        {{ $order->shippingAddress->country }}<br>
                                                        Phone: {{ $order->shippingAddress->phone }}<br>
                                                        Email: {{ $order->shippingAddress->email }}
                                                    </p>
                                                </div>
                                                
                                                @if($order->order_notes)
                                                    <div class="mt-3">
                                                        <h5>Order Notes</h5>
                                                        <p>{{ $order->order_notes }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="text-center">
                        <p>You haven't placed any orders yet!</p>
                        <a href="{{ route('catwiseproduct') }}" class="button btn-primary mt-3">Start Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        $('.order-details-toggle').on('click', function(e) {
            e.preventDefault();
            var orderId = $(this).data('order-id');
            $('#order-items-' + orderId).toggleClass('show');
            
            if ($('#order-items-' + orderId).hasClass('show')) {
                $(this).text('Hide Details');
            } else {
                $(this).text('View Details');
            }
        });
    });
</script>
@endpush