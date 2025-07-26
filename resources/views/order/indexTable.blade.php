<div class="table-responsive">
    <table id="second-table" class="table second-table table-striped table-bordered table-hove" role="grid">
        <thead>
            <tr role="row">
                <th width="5%">S.N</th>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Shipping Status</th>
                <th>Order Date</th>
                <th width="12%">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($get_data) && count($get_data) > 0)
                @foreach ($get_data as $data)
                    <tr data-select-id="{{ $data->id }}">
                        <td>{{ $start_index + $loop->iteration }}</td>
                        <td>{{ $data->order_number }}</td>
                        <td>
                            @if($data->user)
                                {{ $data->user->name }}<br>
                                <small>{{ $data->user->email }}</small>
                            @else
                                Guest User
                            @endif
                        </td>
                        <td>¹{{ number_format($data->total_amount, 2) }}</td>
                        <td>
                            <select class="form-control form-control-sm payment-status" data-id="{{ $data->id }}">
                                <option value="pending" @if($data->payment_status == 'pending') selected @endif>Pending</option>
                                <option value="completed" @if($data->payment_status == 'completed') selected @endif>Completed</option>
                                <option value="failed" @if($data->payment_status == 'failed') selected @endif>Failed</option>
                                <option value="refunded" @if($data->payment_status == 'refunded') selected @endif>Refunded</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control form-control-sm shipping-status" data-id="{{ $data->id }}">
                                <option value="pending" @if($data->shipping_status == 'pending') selected @endif>Pending</option>
                                <option value="processing" @if($data->shipping_status == 'processing') selected @endif>Processing</option>
                                <option value="shipped" @if($data->shipping_status == 'shipped') selected @endif>Shipped</option>
                                <option value="delivered" @if($data->shipping_status == 'delivered') selected @endif>Delivered</option>
                                <option value="cancelled" @if($data->shipping_status == 'cancelled') selected @endif>Cancelled</option>
                            </select>
                        </td>
                        <td>{{ $data->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $data->id) }}" class="btn btn-info btn-sm" title="View Order">
                                <i class="material-icons">visibility</i>
                            </a>
                            <a href="javascript:void(0)" onclick="delete_record({{ $data->id }}, 'order')" class="btn btn-danger btn-sm" title="Delete">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">No Order Found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@if (isset($get_data) && count($get_data) > 0)
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="dataTables_info" role="status" aria-live="polite">
                {{ $text_for_pagination }}
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers">
                {!! $get_data->links() !!}
            </div>
        </div>
    </div>
@endif

<script>
// Update payment status
$(document).on('change', '.payment-status', function() {
    var id = $(this).data('id');
    var value = $(this).val();
    updateOrderStatus(id, 'payment_status', value);
});

// Update shipping status
$(document).on('change', '.shipping-status', function() {
    var id = $(this).data('id');
    var value = $(this).val();
    updateOrderStatus(id, 'shipping_status', value);
});

function updateOrderStatus(id, field, value) {
    $.ajax({
        type: 'POST',
        url: "{{ route('orders.updateStatus') }}",
        data: {
            id: id,
            field: field,
            value: value,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong!'
            });
        }
    });
}
</script>