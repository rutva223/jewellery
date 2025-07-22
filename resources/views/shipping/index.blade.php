@extends('layouts.app')
@section('title', 'Admin :: ' . __('Shipping Methods'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item first"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Methods</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Shipping Methods</h4>
                    <a href="{{ route('shipping-methods.create') }}" class="btn btn-primary">
                        Add New Method
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Cost</th>
                                <th>Min Order Amount</th>
                                <th>Status</th>
                                <th>Sort Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shippingMethods as $method)
                                <tr>
                                    <td>{{ $method->name }}</td>
                                    <td>
                                        <span class="badge {{ $method->type == 'free' ? 'bg-success' : 'bg-primary' }}">
                                            {{ ucfirst(str_replace('_', ' ', $method->type)) }}
                                        </span>
                                    </td>
                                    <td>{{ $method->display_cost }}</td>
                                    <td>
                                        {{ $method->minimum_order_amount ? '₹' . number_format($method->minimum_order_amount, 2) : 'No minimum' }}
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" 
                                                   type="checkbox" 
                                                   data-id="{{ $method->id }}"
                                                   {{ $method->is_active ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $method->sort_order }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('shipping-methods.edit', $method->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger delete-method" 
                                                    data-id="{{ $method->id }}"
                                                    data-name="{{ $method->name }}">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No shipping methods found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
$(document).ready(function() {
    // Toggle status
    $('.status-toggle').change(function() {
        const id = $(this).data('id');
        const toggle = $(this);
        
        $.ajax({
            url: '{{ route("shipping-methods.toggle-status") }}',
            type: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                    toggle.prop('checked', !toggle.prop('checked'));
                }
            },
            error: function() {
                toastr.error('Error updating status');
                toggle.prop('checked', !toggle.prop('checked'));
            }
        });
    });

    // Delete method
    $('.delete-method').click(function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const row = $(this).closest('tr');
        
        if (confirm(`Are you sure you want to delete "${name}" shipping method?`)) {
            $.ajax({
                url: '{{ url("admin/shipping-methods") }}/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        row.fadeOut(function() {
                            $(this).remove();
                        });
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('Error deleting shipping method');
                }
            });
        }
    });
});
</script>
@endpush