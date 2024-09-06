@extends('front_end.app')
@section('content')
<style>
    p{
        font-size: medium;
    }
    h3{
        color: #5A5A5A;
    }
</style>
<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
                Terms & Condition
            </h1>
        </div>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a>
            <span class="delimiter"></span> Terms & Condition
        </div>
    </div>
</div>

<div id="content" class="site-content" role="main" style="padding: 0% 10%;">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="row">
                {{-- <div class="terms-section text-center">
                    <h2 style="text-align: center; color: #5A5A5A; font-size: 2em; margin-bottom: 20px;">Terms and Conditions for Pavitra Jewellery</h2>
                </div> --}}

                <div class="terms-section" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

                    <h3><b>Introduction</b></h3>
                    <p>Welcome to Pavitra Jewellery. By accessing or using our website, you agree to be bound by these Terms and Conditions. Please read them carefully. If you do not agree with any part of these terms, you may not use our services.</p>

                    <h3><b>Products and Services</b></h3>
                    <p>Pavitra Jewellery offers a range of jewellry items for purchase. While we strive to display the colors and images of our products accurately, we cannot guarantee that your computer monitor's display will reflect the true color.</p>

                    <h3><b>Pricing and Payment</b></h3>
                    <p>All prices listed on our website are in INR (Indian Rupees) and include all applicable taxes. Prices may change without notice, but such changes will not affect orders that have already been accepted. Payment must be made in full before your order is processed.</p>

                    <h3><b>Order Acceptance and Cancellation</b></h3>
                    <p>We reserve the right to refuse or cancel any order for any reason, including but not limited to product availability, errors in the description or price, or issues identified by our fraud prevention system. If your order is canceled after your payment has been processed, we will issue a full refund.</p>

                    <h3><b>Shipping and Delivery</b></h3>
                    <p>We aim to dispatch all orders within the specified timeframe. However, delivery times are estimates and not guaranteed. Pavitra Jewellery is not responsible for delays due to customs clearance or other circumstances beyond our control.</p>

                    <h3><b>Return and Refund Policy</b></h3>
                    <p>If you are not satisfied with your purchase, you may return the item within 14 days of receipt for a full refund, provided the item is in its original condition and packaging. Custom-made items and engraved products are not eligible for return. Refunds will be processed within 7-10 business days of receiving the returned item.</p>

                    <h3><b>Intellectual Property</b></h3>
                    <p>All content on our website, including images, text, graphics, logos, and designs, is the property of Pavitra Jewellery and is protected by copyright and trademark laws. You may not reproduce, distribute, or otherwise use any content without our prior written consent.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
