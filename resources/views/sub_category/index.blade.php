@extends('layouts.app')
@section('title', 'Admin :: ' . __('Sub Category'))

@section('content')

<style>
    .text-danger {
        color: red;
    }

    .is-invalid {
        border-color: red;
    }
    .select2-container .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .tab-content {
        height: auto !important;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 36px;
        top: 1px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item first"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sub Category List</li>
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

<div class="row">
    <div class="col-xl-12">
        <div class="filter cm-content-box box-primary">
            <form action="{{ route('sub-category.store') }}" id="category_store_frm" name="category_store_frm" method="POST">
                @csrf
                <div class="cm-content-body form excerpt">
                    <div class="card-body">
                        <input type="hidden" name="id" id="record_id" value="">
                        <!-- Other form fields -->
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="subject" class="form-label">Category</label>
                                <div class="">
                                    <select name="cat_id" id="single-select" class="form-control add_cat_name">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $key => $cat)
                                            <option value="{{ $key }}">
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="select_error"></span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <label for="subject" class="form-label">Sub Category</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Sub Category Name">
                                </div>
                            </div>
                            <div class="col-xl-2 mt-3">
                                <div class="mt-3">
                                    <button type="submit" class="btn w-100 btn-primary" id="process_btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                                    <input type="text" name="search" id="search" class="form-control"
                                        placeholder="Search">
                                </div>
                            </div>
                            {{-- <div class="col-sm-2 mt-2">
                                <button class="btn btn-primary w-100 search_btn"
                                    id="search-btn">Search</button>
                                </div>
                                <div class="col-sm-2 mt-2">
                                <a href="javascript:;" class="btn btn-primary w-100 modal-open" for="modal-toggle"
                                    onclick="openCustomModal();">
                                    <i class="fa fa-plus"></i> Add Category
                                </a>
                            </div> --}}
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

    function openCustomModal() {
        $('#customModal').modal('show');
        $('#category_store_frm')[0].reset();
        $('#proccess_btn').prop('disabled', false);
    }

    function closeCustomModal() {
        $('#name').val('');
        $('#customModal').modal('hide');
        document.getElementById('customModal').style.display = 'none';
    }

    $(".add_cat_name").change(function() {
        var serverId = $('#single-select option:selected').text();
        if (serverId) {
            $('#single-select-error').remove();
        }
    });

    $(document).ready(function() {
        $('#category_store_frm').validate({
            errorElement: 'div',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                if (element.hasClass('add_cat_name')) {
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
                    required: true
                },
                cat_id: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter the sub category name."
                },
                cat_id: {
                    required: "Please select a category."
                }
            },
            success: function(label, element) {
                $(element).removeClass('is-invalid');
                $(label).remove();
            }
        });


        $('#category_store_frm').submit(function(event) {
            event.preventDefault();
            if (!$(this).valid()) {
                return;
            }
            $('#process_btn').prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    $('#customModal').modal('hide');
                    $('#process_btn').prop('disabled', false);
                    console.log(response);
                    if (response.status == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            // Reset form fields after successful submission
                            $('#name').val('');

                            var selectElement = $('#single-select');

                            // Clear existing options except the default one
                            selectElement.find('option').not(':first').remove();

                            // Append new options
                            $.each(response.categories, function(key, value) {
                                selectElement.append(
                                    $('<option>', {
                                        value: key,
                                        text: value
                                    })
                                );
                            });

                            // Set the "Select Category" option as selected
                            selectElement.val('');

                            // If you want to call a function after updating the select options
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
                    console.error(xhr.responseText);
                    $('#process_btn').prop('disabled', false);
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
            confirmButtonText: `YES, ` + status_type + ` IT!`,
            denyButtonText: `No, cancel!`,
        }).then((result) => {
            if (result.isConfirmed) {
                // Make AJAX request to change status
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ChangeSubCategoryStatus') }}",
                    data: {
                        tablename: tablename,
                        id: id,
                        type: status_type,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status == true) {
                            // Update the status cell with the new status link
                            var statusCell = $('tr[data-select-id="' + id + '"] td:nth-child(5)');
                            var newLink = `<a href="javascript:void(0)" onclick="status_change(${id}, '${tablename}', '${status_type === 'Active' ? 'Active' : 'Inactive'}')" style="color: ${status_color}">${status_type}</a>`;
                            statusCell.html(newLink);

                            // Show success message
                            Swal.fire({
                                title: "Updated!",
                                // text: "The status has been changed to " + status_type + ".",
                                text: "Your " + tablename + " has been " + status_type + ".",
                                icon: "success",
                                timer: 1500, // Auto-hide after 1500 milliseconds (1.5 seconds)
                                showConfirmButton: true // Show the "OK" button
                            });
                        } else {
                            Swal.fire("Cancelled", "Something went wrong", "error");
                        }
                    },
                    error: function(xhr, status, error) {
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
            url: "{{ route('AllSubCategoryTableData') }}",
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
        $('#search').on('input', function() {
            fetchData();
        });

        // Fetch data on per_page_option change
        $('#per_page_option').on('change', function() {
            fetchData();
        });

        // Function to fetch data with current values
        function fetchData() {
            var input_value = $('#search').val();
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

    function delete_record(id, tablename) {
        console.log(id, tablename);
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
                    url: "{{ route('sub-category.destroy', ':id') }}".replace(':id', id),
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
