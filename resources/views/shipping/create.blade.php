@extends('layouts.app')
@section('title', 'Admin :: ' . __('Create Shipping Method'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item first"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shipping-methods.index') }}">Shipping Methods</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Method</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Shipping Method</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('shipping-methods.store') }}" method="post" id="shipping-form">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Method Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" 
                                       placeholder="e.g., Free Shipping, Standard Delivery" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" name="type" id="type" required>
                                    <option value="">Select Type</option>
                                    <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>Free Shipping</option>
                                    <option value="flat_rate" {{ old('type') == 'flat_rate' ? 'selected' : '' }}>Flat Rate</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Cost (₹) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" 
                                       class="form-control @error('cost') is-invalid @enderror" 
                                       name="cost" value="{{ old('cost', 0) }}" 
                                       placeholder="0.00" required id="cost">
                                @error('cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Minimum Order Amount (₹)</label>
                                <input type="number" step="0.01" min="0" 
                                       class="form-control @error('minimum_order_amount') is-invalid @enderror" 
                                       name="minimum_order_amount" value="{{ old('minimum_order_amount') }}" 
                                       placeholder="Leave empty for no minimum">
                                @error('minimum_order_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Leave empty if no minimum order amount required</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" min="0" 
                                       class="form-control @error('sort_order') is-invalid @enderror" 
                                       name="sort_order" value="{{ old('sort_order', 0) }}" 
                                       placeholder="0" required>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Lower numbers appear first</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input" name="is_active" id="is_active" 
                                           value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          name="description" rows="3" 
                                          placeholder="Optional description for customers">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Create Shipping Method</button>
                            <a href="{{ route('shipping-methods.index') }}" class="btn btn-secondary">Cancel</a>
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
    // Update cost field based on type selection
    $('#type').change(function() {
        const type = $(this).val();
        const costField = $('#cost');
        
        if (type === 'free') {
            costField.val(0).prop('readonly', true);
        } else {
            costField.prop('readonly', false);
        }
    });
    
    // Trigger on page load if type is already selected
    $('#type').trigger('change');
});
</script>
@endpush