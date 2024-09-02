@extends('layouts.app')
@section('title', 'Admin :: ' . __('Dashboard'))

@section('content')

<style>
    .card {
        margin-bottom: 15px;
    }

    @media (min-width: 992px) {
        .col-lg-2 {
            flex-basis: 20%;
            max-width: 20%;
        }
    }

    @media (max-width: 991px) {
        .col-lg-2 {
            flex-basis: 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 767px) {
        .col-lg-2 {
            flex-basis: 100%;
            max-width: 100%;
        }
    }
</style>

<div class="page-titles">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item first"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ol>
    </nav>
</div>

<div class="row clearfix">
    <div class="col-lg-4 col-md-4">
        <div class="card counter">
            <div class="card-body d-flex align-items-center">
                <div class="card-box-icon" style="background: rgba(244 244 244)">
                    <i class="material-icons" aria-hidden="true">category</i>
                </div>
                <div class="chart-num">
                    <a href="{{ route('category.index') }}">
                        <h3 class="mb-0">{{ $categories ?? 0 }}</h3>
                        <p class="mb-0">Total Category</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="card counter">
            <div class="card-body d-flex align-items-center">
                <div class="card-box-icon" style="background: rgba(244 244 244)">
                    <i class="material-icons" aria-hidden="true">category</i>
                </div>
                <div class="chart-num">
                    <a href="{{ route('productss.index') }}">
                        <h3 class="mb-0">{{ $products ?? 0 }}</h3>
                        <p class="mb-0">Total Product</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
