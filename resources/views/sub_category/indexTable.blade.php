
@if (count($get_data) > 0)
    <div class="table-responsive">
        <table class="table table-bordered" id="second-table" data-table-id="second-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category Name</th>
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
                            <td>{{ $data->category->name }}</td>
                            <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s A') ?? '-' }}</td>
                            <td>
                                @if ($data->status == 'Active')
                                    <a href="javascript:void(0)" onclick="status_change('{{ $data->id }}', 'Category', 'Active')" style="color:green">Active</a>
                                @else
                                    <a href="javascript:void(0)" onclick="status_change('{{ $data->id }}', 'Category', 'Inactive')" style="color:red">Inactive</a>
                                @endif
                            </td>
                            <td>
                                <a href="#!" data-size="md" data-title="Edit sub category" class="btn btn-primary btn-xs sharp me-1" data-url="{{ route('sub-category.edit', $data->id) }}" data-ajax-popup="true" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-primary btn-xs sharp me-1" title="Delete User"
                                    onclick="delete_record('{{ $data->id }}','Sub Category')">
                                    <i class="fa fa-trash"></i>
                                </a>
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
    setTimeout(() => {
        // Initialize Select2 when modal is shown
        $('#staticBackdrop').on('shown.bs.modal', function() {
            $('#single-select1').select2({
                dropdownParent: $('#staticBackdrop') // Replace with the actual ID of your modal
            });
        });
    }, 300);

    // Remove error message on change
    $('#single-select1').on('change', function() {
        var selectedText = $('#single-select1 option:selected').text();
        if (selectedText) {
            $('#select_error').remove();
        }
    });

    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            let recordId = this.getAttribute('data-id');
            let categoryId = this.getAttribute('data-category-id');
            let subCategoryName = this.getAttribute('data-sub-category-name');

            // Set the hidden input value
            document.getElementById('record_id').value = recordId;

            // Get the dropdown element
            let categorySelect = document.getElementById('add_cat_name');

            // Reset the form validation errors
            $('#category_store_frm').validate().resetForm();
            $('#category_store_frm').find('.is-invalid').removeClass('is-invalid');
            $('#select_error').text('');

            // Set the selected category based on the Category ID
            categorySelect.value = categoryId;
            $(categorySelect).selectpicker('refresh');

            // Set the sub-category name in the input field
            document.getElementById('name').value = subCategoryName;
        });
    });

</script>
