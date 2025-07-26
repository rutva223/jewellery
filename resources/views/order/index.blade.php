@extends('layouts.app')
@section('title', 'Admin :: ' . __('Order'))

@section('content')

<style>
    .text-danger {
        color: red; /* Adjust color as needed */
        text-align: left; /* Align text to the left */
        margin-top: 5px; /* Optional: Add some margin for spacing */
    }

    .is-invalid {
        border-color: red;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item first"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order List</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row clearfix ResponseMessageError">
    <div class="col-lg-12 col-md-12">
        @include('flash')
    </div>
</div>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row mb-3 justify-content-end">
                            <div class="col-sm-2 mt-2">
                                <div>
                                    <select id="per_page_option" class="form-control">
                                        <option value="10" @if ($per_page_limit=='10' ) selected @endif>10
                                        </option>
                                        <option value="25" @if ($per_page_limit=='25' ) selected @endif>25
                                        </option>
                                        <option value="50" @if ($per_page_limit=='50' ) selected @endif>50
                                        </option>
                                        <option value="75" @if ($per_page_limit=='75' ) selected @endif>75
                                        </option>
                                        <option value="100" @if ($per_page_limit=='100' ) selected @endif>100
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-2">
                                <div class="input-group mb-3">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="table_data" class="transaction_table">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-wrapper d-none">
    <span class="site-loader"> </span>
</div>

@endsection


@push('after-scripts')
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#category_store_frm').submit(function(event) {
            event.preventDefault();
            if (!$(this).valid()) {
                return;
            }
            $('#proccess_btn').prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    $('#customModal').modal('hide');
                    $('#proccess_btn').prop('disabled', false);

                    if (response.status == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            getDataFunction(null, 1, 10);
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
                    $('#proccess_btn').prop('disabled', false);
                }
            });
        });
    });
</script>

<script>
    function status_change(id, tablename, type_val) {
        var status_type = type_val === 'Active' ? "Inactive" : "Active";
        var status_color = status_type === 'Active' ? 'green' : 'red';

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure?",
            text: "You want to change the status to " + status_type + "?",
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: `YES, ${status_type} IT!`,
            denyButtonText: `No, cancel!`,
        }).then((result) => {
            if (result.isConfirmed) {
                // Make AJAX request to change status
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ChangeCategoryStatus') }}",
                    data: {
                        tablename: tablename,
                        id: id,
                        type: status_type,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status == true) {
                            // Update the status cell with the new status link
                            var statusCell = $('tr[data-select-id="' + id + '"] td:nth-child(4)');
                            var newLink = `<a href="javascript:void(0)" onclick="status_change(${id}, '${tablename}', '${status_type === 'Active' ? 'Active' : 'Inactive'}')" style="color: ${status_color}">${status_type}</a>`;
                            statusCell.html(newLink);

                            // Show success message
                            Swal.fire({
                                title: "Updated!",
                                text: `Your ${tablename} has been ${status_type}.`,
                                icon: "success",
                                timer: 1500, // Auto-hide after 1500 milliseconds (1.5 seconds)
                                showConfirmButton: true // Show the "OK" button
                            });
                        } else {
                            Swal.fire("Cancelled", "Something went wrong", "error");
                        }
                    },
                    error: function() {
                        // Handle AJAX error
                        Swal.fire("Cancelled", "Something went wrong", "error");
                    }
                });
            } else if (result.isDenied) {
                // Show cancellation message
                Swal.fire("Cancelled", "The status change has been cancelled.", "info");
            }
        });
    }

    function getDataFunction(input_value, page, per_page_option) {
        // $(".custom-wrapper").removeClass('d-none');

        $.ajax({
            type: 'POST',
            url: "{{ route('AllOrderTableData') }}",
            data: {
                input_value: input_value,
                page: page,
                per_page_option: per_page_option,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#table_data').html(data);
                // $(".custom-wrapper").addClass('d-none');
            },
            complete: function() {
                $('.loder_image_submit').hide();
                $(".custom-wrapper").addClass('d-none');
            }
        });
    }

    $(document).ready(function() {
        // Initialize DataTable (if needed)
        $('#second-table').DataTable({
            paging: false, // Disable pagination
            info: false,
            searching: false
        });

        // Initial data fetch
        fetchData();

        // Fetch data on input change
        $('#name').on('input', function() {
            fetchData();
        });

        // Fetch data on per_page_option change
        $('#per_page_option').on('change', function() {
            fetchData();
        });

        // Function to fetch data with current values
        function fetchData() {
            var input_value = $('#name').val();
            var per_page_option = $("#per_page_option").val();
            getDataFunction(input_value, 1, per_page_option);
        }
    });

    var cutom_url = "{{ url('/') }}";
    if (window.location.protocol == 'https:') {
        cutom_url = cutom_url.replace("http://", "https://");
    } else {
        cutom_url = cutom_url.replace("https://", "http://");
    }

    $(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var this_page_uri = window.location.toString();
            if (this_page_uri.indexOf("?") > 0) {
                var clean_uri = this_page_uri.substring(0, this_page_uri.indexOf("?"));
                window.history.replaceState({}, document.title, clean_uri);
            }
            var page = $(this).attr('href').split('page=')[1];
            var input_value = $('#name').val();
            var per_page_option = $("#per_page_option").val();
            getDataFunction(input_value, page, per_page_option);
        });
    });

</script>

<script>

$(document).ready(function() {
    // Add categoryExists validation method
    $.validator.addMethod("categoryExists", function(value, element, params) {
        var result = false;
        $.ajax({
            url: params.url,
            type: 'POST',
            async: false, // Avoid blocking UI; consider async handling
            data: {
                name: value,
                id: params.id,
                _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token if required
            },
            success: function(response) {
                result = !response.exists;
            },
            error: function(xhr) {
                console.error('AJAX Error: ' + xhr.responseText);
            }
        });
        return result;
    }, "Category name already exists");

    // Validate the category update form
    function validateCategoryUpdateForm(formId) {
        $('.category-update-form').each(function() {
            $(this).validate({
                errorElement: 'div',
                errorClass: 'text-danger',
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2-hidden-accessible')) {
                        error.insertAfter(element.next('.select2-container'));
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
                        categoryExists: {
                            url: "{{ route('checkCategoryName') }}",
                            id: $(formId).find('input[name="id"]').val() // Pass the form ID to get the current row ID
                        }
                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Category Name.",
                        categoryExists: "This category name already exists."
                    }
                },
                success: function(label, element) {
                    $(element).removeClass('is-invalid');
                    $(label).remove();
                }
            });
        });
    }

    // Initialize form validation when the modal is shown
    $(document).on('shown.bs.modal', function(e) {
        var modal = $(e.target);
        var formId = modal.find('.category-update-form').attr('id');
        if (formId) {
            validateCategoryUpdateForm('#' + formId);
        }
    });

    // Handle button click to validate and submit the form
    $(document).on('click', '.update_btn', function() {
        var form = $(this).closest('form');
        if (form.valid()) {
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
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
                            getDataFunction(null, 1, 10); // Refresh data
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
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        }
    });
});

function delete_record(id, tablename) {
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this " + tablename + "!",
        type: "warning",
        showDenyButton: true,
        confirmButtonText: `YES, DELETE IT!`,
        denyButtonText: `No, cancel!`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: "{{ route('category.destroy', ':id') }}".replace(':id', id),
                data: {
                    tablename: tablename,
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {

                    if (data.status == true) {
                        $('tr[data-select-id="' + id + '"]').remove();

                        Swal.fire({
                            title: "Deleted!",
                            text: "Your " + tablename + " has been deleted.",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var page = 1;
                                var per_page_option = $("#per_page_option").val();
                                var input_value = $('#name').val();
                                getDataFunction(input_value, page, per_page_option);
                            }
                        });
                    } else {
                        Swal.fire("Cancelled", "Something went wrong", "error");
                    }
                }
            });
        } else if (result.isDenied) {
            Swal.fire("Cancelled", "Your " + tablename + " is safe :)", "error");

        }
    })
}

</script>
@endpush
