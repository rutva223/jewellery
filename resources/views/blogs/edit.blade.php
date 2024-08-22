@extends('layouts.app')
@section('title', 'Admin :: ' . __('Blog Edit'))

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<style>
     .card-header {
        display: block !important;
    }
     .close{
        display: none !important;
    }
     /* Ensure styles for unordered lists (bullet points) */
     .note-editor .note-editing-area ul li {
        list-style-type: disc !important;
        list-style-position: inside;
        margin-left: 20px;
    }

    /* Ensure styles for ordered lists (numeric points) */
    .note-editor .note-editing-area ol li {
        list-style-type: decimal !important;
        list-style-position: inside;
        margin-left: 20px;
    }

    /* Additional styles to ensure list items inherit correct styling */
    .note-editor .note-editing-area ul li,
    .note-editor .note-editing-area ol li {
        margin-bottom: 5px;
        /* Space between list items */
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
                    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blog List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Blog Edit</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data" id="blog_sub_form">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-2">
                                <h6 class="mb-0">Category</h6>
                            </div>
                            <div class="col-sm-4 text-secondary">
                                <select name="cat_id" id="single-select" class="form-control cat_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $key => $value)
                                        <option value="{{ $key }}" {{ $blog->cat_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            {{ $value }}
                                        </option>

                                    @endforeach
                                </select>
                                <span id="cat_id_select_error"></span>
                            </div>

                            <div class="col-sm-2">
                                <h6 class="mb-0">Sub Category</h6>
                            </div>
                            <div class="col-sm-4 text-secondary">
                                <div id="subcategory-select">
                                    <select name="sub_cat_id" class="form-control sub_cat_id" id="sub_cat_id" required>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                                <span id="sub_cat_id_select_error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                                <h6 class="mb-0">Title</h6>
                            </div>
                            <div class="col-sm-4 text-secondary">
                                <input type="text" class="form-control" value="{{ $blog->title }}" name="title" id="title" required placeholder="Enter Blog Title.">
                            </div>

                            <div class="col-sm-2">
                                <h6 class="mb-0">Headline</h6>
                            </div>
                            <div class="col-sm-4 text-secondary">
                                <input type="text" class="form-control" value="{{ $blog->headline }}" name="headline" id="headline" required placeholder="Enter Headline">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                                <h6 class="mb-0">Blog Image</h6>
                            </div>
                            <div class="col-sm-3 text-secondary">
                                <input type="file" class="form-control" id="image" name="image" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" accept="image/jpeg, image/jpg, image/gif, image/png">
                            </div>
                            <div class="col-sm-1">
                                @if ($blog->image != null)
                                    <img id="blah1" src="{{  $blog->image }}" height="50px" width="50px">
                                @else
                                    <img id="blah1" src="{{ asset('image/preview_image.png') }}" height="50px" width="50px">
                                @endif
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="card-body ">
                                <textarea name="description" id="summernote" placeholder="Enter Blog Description">{!! $blog->description !!}</textarea>
                            </div>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('after-scripts')
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Function to update the subcategory dropdown
        function updateSubCategories(catId, selectedSubCatId) {
            if (catId) {
                $.ajax({
                    url: '/get-sub-categories/' + catId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var subCatSelect = '<select name="sub_cat_id" class="form-control sub_cat_id" id="single-select1" required>';
                        subCatSelect += '<option value="">Select Sub Category</option>';
                        $.each(data, function(key, value) {
                            var selected = (key == selectedSubCatId) ? 'selected' : '';
                            subCatSelect += '<option value="' + key + '" ' + selected + '>' + value + '</option>';
                        });
                        subCatSelect += '</select>';

                        $('#subcategory-select').html(subCatSelect);
                        $('#single-select1').select2();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            } else {
                var emptySelect = '<select name="sub_cat_id" class="form-control sub_cat_id" id="single-select1" required>';
                emptySelect += '<option value="">Select Sub Category</option>';
                emptySelect += '</select>';

                $('#subcategory-select').html(emptySelect);
            }
        }

        // Handle category change
        $('#single-select').change(function() {
            var catId = $(this).val();
            updateSubCategories(catId, '');
        });

        // Initial load: populate subcategory based on existing category
        var initialCatId = $('#single-select').val();
        var initialSubCatId = '{{ $blog->sub_cat_id }}'; // Use Blade syntax to get initial subcategory ID
        updateSubCategories(initialCatId, initialSubCatId);
    });



    $("#single-select").change(function() {
        var serverId = $('#single-select option:selected').text();
        if (serverId) {
            $('#single-select-error').remove();
        }
    });
    $(document).on('change', '#single-select1', function() {
        var serverId = $('#single-select1 option:selected').text();
        if (serverId) {
            $('#sub_cat_id-error').remove();
            $('#single-select1-error').remove();
        }
    });
    $(document).ready(function() {
        $('#blog_sub_form').validate({
            errorElement: 'div',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                if (element.hasClass('cat_id')) {
                    error.insertAfter('#cat_id_select_error');
                }else if(element.hasClass('sub_cat_id'))
                {
                    error.insertAfter('#sub_cat_id_select_error');
                }
                 else {
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
                cat_id: {
                    required: true
                },
                sub_cat_id: {
                    required: true
                },
                title: {
                    required: true
                },
                headline: {
                    required: true
                },

            },
            messages: {
                cat_id: {
                    required: "Please select a category."
                },
                sub_cat_id: {
                    required: "Please select a sub category."
                },
                title: {
                    required: "Please enter a blog title."
                },
                headline: {
                    required: "Please enter a headline."
                },
            },
            success: function(label, element) {
                $(element).removeClass('is-invalid');
                $(label).remove();
            }
        });
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Enter Blog Description',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['help', ['help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    // Apply custom styles directly
                    $('.note-editable ul').each(function() {
                        $(this).css({
                            'list-style-type': 'disc',
                            'list-style-position': 'inside',
                            'margin-left': '20px'
                        });
                    });
                    $('.note-editable ol').each(function() {
                        $(this).css({
                            'list-style-type': 'decimal',
                            'list-style-position': 'inside',
                            'margin-left': '20px'
                        });
                    });
                    $('.note-editable li').css({
                        'margin-bottom': '5px'
                    });
                }
            }
        });
    });
</script>
</script>

@endpush











