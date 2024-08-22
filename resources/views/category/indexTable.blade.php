@if (count($get_data) > 0)
<div class="table-responsive">
    <table class="table table-bordered" id="second-table" data-table-id="second-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($get_data) > 0)
            @foreach ($get_data as $data)
            <tr data-select-id="{{ $data->id }}">
                <th>{{ $data->id }}</th>
                <td>{{ $data->name }}</td>
                <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s A') ?? '-' }}</td>
                <td>
                    @if ($data->status == 'Active')
                    <a href="javascript:void(0)" onclick="status_change('{{ $data->id }}', 'Category', 'Active')" style="color:green">Active</a>
                    @else
                    <a href="javascript:void(0)" onclick="status_change('{{ $data->id }}', 'Category', 'Inactive')" style="color:red">Inactive</a>
                    @endif
                </td>
                <td>
                    <a href="" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $data->id }}" class="btn btn-primary btn-xs sharp me-1 ms-2">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-primary btn-xs sharp me-1" title="Delete User"
                        onclick="delete_record('{{ $data->id }}','Category')">
                        <i class="fa fa-trash"></i>
                    </a>
                    <div id="exampleModal{{ $data->id }}" class="modal fade customModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="title" id="defaultModalLabel">Edit Category</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="category-update-form" id="category_update_frm{{ $data->id }}" method="POST" action="{{ route('category.update', $data->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" value="{{ $data->name }}" name="name" placeholder="Enter Category Name">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary update_btn" type="button" data-id="{{ $data->id }}">Update</button>
                                            <a href="javascript:;" class="btn btn-secondary" onclick="closeupdateModal()">Close</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" class="align-center text-center">No data available in table</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>



<div class="row">
    <div class="col-lg-6">{{ $text_for_pagination }}</div>

    <div class="col-lg-6 d-flex justify-content-end">
        {!! $get_data->links('pagination::bootstrap-4', ['class' => 'pagination-links-for-second-table']) !!}
    </div>
</div>
@else
<div class="table-responsive">
    <table class="table table-bordered" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5" class="align-center text-center">No data available in table</td>
            </tr>
        </tbody>
    </table>
</div>
@endif

<script>
    function closeupdateModal() {
        $('.customModal').modal('hide');
        // document.getElementsByClassName('customModal').style.display = 'none';
        var modals = document.getElementsByClassName('customModal');
        for (var i = 0; i < modals.length; i++) {
            modals[i].style.display = 'none';
        }
    }
</script>
