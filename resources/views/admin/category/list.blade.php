@extends('layouts.admin.main')
@section('content')

<!-- Page header -->
<section class="content-header">
    <h1>
        Category
        <small>{{ count($allCategories) }} total</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a></li>
        <li class="active">Category list</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box gt-orders-box">

                <?php if (Session::get('success_message') != "") { ?>
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }}" style="margin: 16px 16px 0;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('success_message') }}
                    </div>
                <?php } ?>

                <div class="box-header with-border">
                    <h3 class="box-title">Category list</h3>
                    <a href="{{ URL::to('category') }}/create" class="gt-btn gt-btn--brand gt-box-head-btn">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add category
                    </a>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-hover gt-orders-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allCategories as $category)
                            <tr>
                                <td data-label="Id" class="gt-order-id">#{{ $category->id }}</td>

                                <td data-label="Name">
                                    <span class="gt-name-cell">
                                        <img class="gt-thumb visible-xs" src="{{ URL::to('/') }}/images/category/{{ $category->image }}" alt="">
                                        <strong>{{ $category->name }}</strong>
                                    </span>
                                </td>

                                <td data-label="Image" class="hidden-xs">
                                    <img class="gt-thumb" src="{{ URL::to('/') }}/images/category/{{ $category->image }}" alt="{{ $category->name }}" loading="lazy">
                                </td>

                                <td data-label="Status">
                                    <span class="gt-onoff @if(strtolower($category->status) == 'active') is-on @endif">{{ $category->status }}</span>
                                </td>

                                <td data-label="Action">
                                    <div class="gt-acts">
                                        <a href="{{ URL::to('category') }}/{{ $category->id }}/edit" class="gt-act gt-act--view" title="Edit {{ $category->name }}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $("#example1").DataTable({
        autoWidth: false,
        language: {
            search: '',
            searchPlaceholder: 'Search categories…',
            emptyTable: 'No categories yet. Add your first one!',
            zeroRecords: 'No matching categories found',
            info: 'Showing _START_–_END_ of _TOTAL_ categories',
            infoEmpty: '',
            lengthMenu: 'Show _MENU_'
        }
    });
</script>
@endpush