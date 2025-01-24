@extends('front_end.app')
@section('content')

<div id="site-main" class="site-main">
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="title" class="page-title">
                <div class="section-container">
                    <div class="content-title-heading">
                        <h1 class="text-title-heading">
                            My Account
                        </h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="{{ route('home') }}">Home</a><span class="delimiter"></span>My Account
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="page-my-account">
                            <div class="my-account-wrap clearfix">
                                <nav class="my-account-navigation">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false">Addresses</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details"  role="tab" aria-controls="account" aria-selected="false">Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="change-pass-tab" data-toggle="tab" href="#change-pass"  role="tab" aria-controls="changepass" aria-selected="false">Change Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <form id="logout-form" action="{{ route('user-logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="my-account-content tab-content">
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="my-account-dashboard">
                                            <p>
                                                <form id="logout-form" action="{{ route('user-logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>

                                                Hello <strong>{{ $user->name }}</strong> (not <strong>{{ $user->name }}</strong>? <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>)
                                            </p>
                                            <p>
                                                From your account dashboard you can view your <a href="page-my-account.html#">recent orders</a>, manage your <a href="page-my-account.html#">shipping and billing addresses</a>, and <a href="page-my-account.html#">edit your password and account details</a>.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="my-account-orders">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                        <tr>
                                                            <td>#{{ $order->id }}</td>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $order->order_status ?? "pending"}}</td>
                                                            <td>$125.00 for 2 item</td>
                                                            <td><a href="page-my-account.html#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                                        <div class="my-account-addresses">
                                            <p>
                                                The following addresses will be used on the checkout page by default.
                                            </p>
                                            <div class="addresses">
                                                <div class="addresses-col">
                                                    <header class="col-title">
                                                        <h3>Address</h3>
                                                        {{-- <a href="page-my-account.html#" class="edit">Edit</a> --}}
                                                    </header>
                                                    <address>
                                                        {{ $ship_address->address_1 ?? '-' }},<br>
                                                        {{ $ship_address->address_2 ?? '-' }},<br>
                                                        {{ $ship_address->city ?? '-' }}, {{ $ship_address->state ?? '-' }}, {{ $ship_address->country ?? '-' }}.<br>
                                                        {{ $ship_address->postcode ?? '-' }}
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                        <div class="my-account-account-details">
                                            <form class="edit-account" action="{{ route('update-profile') }}" method="post">
                                                @csrf
                                                <p class="form-row">
                                                    <label for="first_name">First name <span class="required">*</span></label>
                                                    <input type="text" class="input-text" name="first_name" value="{{ $user->first_name ?? ' ' }}">
                                                </p>
                                                <p class="form-row">
                                                    <label for="last_name">Last name <span class="required">*</span></label>
                                                    <input type="text" class="input-text" name="last_name" value="{{ $user->last_name ?? ' '}}">
                                                </p>
                                                <div class="clear"></div>
                                                <p class="form-row">
                                                    <label for="email">Email address <span class="required">*</span></label>
                                                    <input type="email" class="input-text" name="email" value="{{ $user->email ?? ' '}}">
                                                </p>
                                                <div class="clear"></div>
                                                <p class="form-row">
                                                    <button type="submit" class="button" value="Save changes">Save changes</button>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="change-pass" role="tabpanel" aria-labelledby="change-pass-tab">
                                        <div class="my-account-account-details">
                                            <form class="edit-account" action="{{ route('updatepassword') }}" method="post">
                                                @csrf
                                                    <p class="form-row">
                                                        <label>Current password</label>
                                                        <input type="text" class="input-text" name="current_password" autocomplete="off">
                                                    </p>
                                                    <p class="form-row">
                                                        <label>New password</label>
                                                        <input type="text" class="input-text" name="new_password" autocomplete="off">
                                                    </p>
                                                    <p class="form-row">
                                                        <label>Confirm new password</label>
                                                        <input type="text" class="input-text" name="confirm_password" autocomplete="off">
                                                    </p>
                                                <div class="clear"></div>
                                                <p class="form-row">
                                                    <button type="submit" class="button" value="Save changes">Save changes</button>
                                                </p>
                                            </form>
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

@endsection
