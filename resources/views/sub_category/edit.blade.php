
<form class="g-3" action="{{ route('sub-category.update', [$subCategory->id]) }}" method="post" id="sub_category_update_frm">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" id="sub_category_id" value="{{ $subCategory->id }}">

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $subCategory->name }}" placeholder="Enter Sub Category Name">
            </div>
            <div class="col-md-12 mt-2">
                <label for="category" class="form-label">Category</label>
                <div class="">
                    <select name="cat_id" id="single-select1" class="form-control add_cat_name">
                        <option value="">Select Category</option>
                        @foreach ($categories as $key => $cat)
                            <option value="{{ $key }}" {{ $subCategory->cat_id == $key ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    <span id="select_error"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-light" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Save')}}" class="btn btn-primary ms-2 update_btn">
    </div>
</form>

<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
    $(document).ready(function() {
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
    });
</script>

<script>
    $(document).ready(function() {
        // Add custom validation method
        $.validator.addMethod("categoryExists", function(value, element) {
            var isSuccess = false;
            var id = $('#sub_category_id').val();
            $.ajax({
                type: "POST",
                url: "{{ route('checkSubCategoryName') }}",
                data: {
                    name: value,
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                async: false,
                success: function(response) {
                    isSuccess = !response.exists;
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
            return isSuccess;
        }, "Category name already exists.");

        // Initialize form validation
        $('#sub_category_update_frm').validate({
            errorElement: 'div',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                } else if(element.hasClass('add_cat_name')) {
                    error.insertAfter('#select_error');
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            rules: {
                name: {
                    required: true,
                    categoryExists: true
                },
                cat_id: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter the sub-category name.",
                    categoryExists: "Category name already exists."
                },
                cat_id: {
                    required: "Please select a category."
                }
            },
            success: function(label, element) {
                $(element).removeClass('is-invalid');
                $(label).remove();
            },
            submitHandler: function(form) {
                var formData = $(form).serialize();

                $.ajax({
                    type: "PATCH",
                    url: $(form).attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('.modal').modal('hide');

                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                getDataFunction(null, 1, 10);  // Refresh data
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
                return false; // Prevent the default form submission
            }
        });
    });
</script>


