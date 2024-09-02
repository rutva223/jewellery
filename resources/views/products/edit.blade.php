@extends('layouts.app')
@section('title', 'Admin :: ' . __('Product Edit'))

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
                    <li class="breadcrumb-item"><a href="{{ route('productss.index') }}">Product List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Product Edit</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('productss.update', $product->id) }}" method="post" enctype="multipart/form-data" id="blog_sub_form">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Category</h6>
                                </div>
                                <div class="col-sm-12 text-secondary">
                                    <select name="cat_id" id="single-select" class="form-control cat_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $key }}" {{ $product->cat_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="cat_id_select_error"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Product Name</h6>
                                </div>
                                <div class="col-sm-12 text-secondary">
                                    <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" id="product_name" required placeholder="Enter Product Name.">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Product Quantity</h6>
                                </div>
                                <div class="col-sm-12 text-secondary">
                                    <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}" id="quantity" required placeholder="Enter Product quantity.">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Product Price</h6>
                                </div>
                                <div class="col-sm-12 text-secondary">
                                    <input type="text" class="form-control" name="product_price" value="{{ $product->product_price }}" id="product_price" required placeholder="Enter product price" oninput="calculateDiscount()">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Sell Price</h6>
                                </div>
                                <div class="col-sm-12 text-secondary">
                                    <input type="text" class="form-control" name="sell_price" value="{{ $product->sell_price }}" id="sell_price" required placeholder="Enter sell price" oninput="calculateDiscount()">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Discount</h6>
                                </div>
                                <div class="col-sm-12 text-secondary">
                                    <input type="text" class="form-control" name="discount" value="{{ $product->discount }}" id="discount" required placeholder="Enter discount" readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="col-sm-s">Product Image</h6>
                                <div class="col-sm-6 text-secondary">
                                    <input type="file" class="form-control" id="image" name="image[]" accept="image/jpeg, image/jpg, image/gif, image/png" multiple>
                                </div>
                            </div>
                            <div class="col-6">
                                @php
                                    // Decode the JSON string into an array of full URLs
                                    $images = $product->images; // This uses the accessor to get the full URLs
                                @endphp

                                @if(is_array($images))
                                    @foreach ($images as $item)
                                        @if ($item != null)
                                            <img src="{{ $item }}" height="50px" width="50px" alt="Product Image">
                                        @else
                                            <img src="{{ asset('image/preview_image.png') }}" height="50px" width="50px" alt="Default Image">
                                        @endif
                                    @endforeach
                                @else
                                    <img src="{{ asset('image/preview_image.png') }}" height="50px" width="50px" alt="Default Image">
                                @endif
                                <div id="preview-container"></div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="card-body ">
                                <textarea name="description" id="summernote" placeholder="Enter Product Description">{!! $product->description !!}</textarea>
                            </div>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('productss.index') }}" class="btn btn-secondary">Cancel</a>
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

    function previewImages() {
        var previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = ''; // Clear existing previews
        var files = document.getElementById('image').files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.height = 50;
                img.width = 50;
                previewContainer.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    }


    function calculateDiscount() {
        // Get the values of product_price and sell_price inputs
        var productPrice = parseFloat(document.getElementById("product_price").value) || 0;
        var sellPrice = parseFloat(document.getElementById("sell_price").value) || 0;

        // Calculate the discount
        var discount = productPrice - sellPrice;

        // Update the discount input field with the calculated value
        document.getElementById("discount").value = discount.toFixed(2); // Fixed to 2 decimal places for consistency
    }
</script>

<script>
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
                    required: "Please enter a Product title."
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
            placeholder: 'Enter Product Description',
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


@endpush











