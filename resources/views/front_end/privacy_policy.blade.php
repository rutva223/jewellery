
@extends('front_end.app')
@section('content')
<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
                Privacy Policy
            </h1>
        </div>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a>
            <span class="delimiter"></span>Privacy Policy
        </div>
    </div>
</div>

<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="row">
                <h2 style="text-align: center; color: #5A5A5A; font-size: 2em; margin-bottom: 20px;">Privacy Policy for Pavitra Jewellery</h2>

                <div class="privacy-section" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

                    <h3 style="color: #4CAF50;">Introduction</h3>
                    <p>Pavitra Jewellery is committed to protecting your personal information. This Privacy Policy outlines how we collect, use, and safeguard your data when you visit or make a purchase from our website.</p>

                    <h3 style="color: #4CAF50;">Information We Collect</h3>
                    <ul style="margin-left: 20px;">
                        <li><b>Personal Identification Information:</b> Name, email address, phone number, and shipping address.</li>
                        <li><b>Payment Information:</b> Credit card or debit card details for order processing.</li>
                        <li><b>Browsing Information:</b> IP address, browser type, and interaction data (e.g., pages visited).</li>
                    </ul>

                    <h3 style="color: #4CAF50;">How We Use Your Information</h3>
                    <p>We use your personal data to:</p>
                    <ul style="margin-left: 20px;">
                        <li>Process your orders and provide customer support.</li>
                        <li>Send you order updates and marketing communications (if opted-in).</li>
                        <li>Improve our website and services by analyzing user behavior.</li>
                    </ul>

                    <h3 style="color: #4CAF50;">Sharing Your Information</h3>
                    <p>We do not sell or rent your personal data. However, we may share your data with third parties to help us process payments or ship products. These partners are bound by confidentiality agreements.</p>

                    <h3 style="color: #4CAF50;">Cookies</h3>
                    <p>Pavitra Jewellery uses cookies to enhance your browsing experience. Cookies help us remember your preferences and understand your usage patterns. You can control or disable cookies in your browser settings.</p>

                    <h3 style="color: #4CAF50;">Data Security</h3>
                    <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, or destruction. However, no method of transmission over the internet is completely secure.</p>

                    <h3 style="color: #4CAF50;">Your Rights</h3>
                    <p>You have the right to:</p>
                    <ul style="margin-left: 20px;">
                        <li>Access the personal data we hold about you.</li>
                        <li>Request corrections to inaccurate information.</li>
                        <li>Opt-out of marketing communications at any time.</li>
                    </ul>

                    <h3 style="color: #4CAF50;">Changes to this Policy</h3>
                    <p>Pavitra Jewellery reserves the right to update or modify this Privacy Policy at any time. Changes will be posted on this page, and your continued use of the website signifies acceptance of the new policy.</p>

                    <h3 style="color: #4CAF50;">Contact Us</h3>
                    <p>If you have any questions about this Privacy Policy or your personal information, please contact us at:</p>
                    <ul style="margin-left: 20px;">
                        <li><b>Email:</b> [Your Email Address]</li>
                        <li><b>Phone:</b> [Your Phone Number]</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
