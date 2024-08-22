
@if (count($get_data) > 0)
    <div class="table-responsive">
        <table class="table table-bordered" id="second-table" data-table-id="second-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Blog Image</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Title</th>
                    <th>HeadLine</th>
                    {{-- <th>Description</th> --}}
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($get_data) > 0)
                    @foreach ($get_data as $data)
                        @php
                            $latter_count = mb_strlen($data->category->name);
                            $sub_count = mb_strlen($data->subCategory->name);
                            $title = mb_strlen($data->title);
                            $headline = mb_strlen($data->headline);
                            // $plainDescription = strip_tags($data->description ?? '-');
                            // $shortDescription = substr($plainDescription, 0, 10) . '...';
                        @endphp
                        <tr data-select-id="{{ $data->id }}">
                            <th>{{ $data->id }}</th>
                            <td>
                                <div class="col-3 d-flex align-items-center">
                                    <div class="recent-product-img">
                                        <img src="{{ $data->image }}" height="30%" width="30%" class="imageModal">
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($latter_count >= 25)
                                    <a href="javascript:void(0)" onclick="opencategory('{{ addslashes($data->category ? $data->category->name : '-') }}')" title="Click to view description">
                                        {{ substr(strip_tags($data->category ? $data->category->name : '-'), 0, 10) }}...
                                    </a>
                                @else
                                    {{ $data->category ? $data->category->name : '-' }}
                                @endif
                            </td>
                            <td>
                                @if($sub_count >= 25)
                                    <a href="javascript:void(0)" onclick="openSubCategory('{{ addslashes($data->subCategory ? $data->subCategory->name : '-') }}')" title="Click to view description">
                                        {{ substr(strip_tags($data->subCategory ? $data->subCategory->name : '-'), 0, 10) }}...
                                    </a>
                                @else
                                    {{ $data->subCategory ? $data->subCategory->name : '-' }}
                                @endif
                            </td>
                            <td>
                                @if($title >= 25)
                                    <a href="javascript:void(0)" onclick="openTitle('{{ addslashes($data->title ?? '-') }}')" title="Click to view description">
                                        {{ substr(strip_tags($data->title ?? '-'), 0, 10) }}...
                                    </a>
                                @else
                                    {{ $data->title ?? '-' }}
                                @endif
                            </td>
                            <td>
                                @if($headline >= 25)
                                    <a href="javascript:void(0)" onclick="openHeadline('{{ addslashes($data->headline ?? '-') }}')" title="Click to view description">
                                        {{ substr(strip_tags($data->headline ?? '-'), 0, 10) }}...
                                    </a>
                                @else
                                    {{ $data->headline ?? '-' }}
                                @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s A') ?? '-' }}</td>
                            <td>
                                @if ($data->status == 'Active')
                                    <a href="javascript:void(0)" onclick="status_change('{{ $data->id }}', 'Category', 'Active')" style="color:green">Active</a>
                                @else
                                    <a href="javascript:void(0)" onclick="status_change('{{ $data->id }}', 'Category', 'Inactive')" style="color:red">Inactive</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('blogs.edit', $data->id) }}" class="btn btn-primary btn-xs sharp me-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-primary btn-xs sharp me-1" title="Delete User"
                                    onclick="delete_record('{{ $data->id }}','blog')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="align-center text-center">No data available in table</td>
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
                    <th>Blog Image</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Title</th>
                    <th>HeadLine</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="9" class="align-center text-center">No data available in table</td>
                </tr>
            </tbody>
        </table>
    </div>

@endif
