@extends('layouts.admin.main')
@section('content')

<!-- Page header -->
<section class="content-header">
    <h1>
        Product
        <small>{{ count($allProducts) }} total</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a></li>
        <li class="active">Product list</li>
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
                    <h3 class="box-title">Product list</h3>
                    <a href="{{ URL::to('product') }}/create" class="gt-btn gt-btn--brand gt-box-head-btn">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add product
                    </a>
                </div>

                <div class="box-body">
                    <div class="gt-table-scroll">
                        <table id="example1" class="table table-hover gt-orders-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Details</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allProducts as $product)
                                <tr>
                                    <td data-label="Id" class="gt-order-id">#{{ $product->id }}</td>

                                    <td data-label="Name">
                                        <span class="gt-name-cell">
                                            <img class="gt-thumb visible-xs" src="{{ URL::to('/') }}/images/product/{{ $product->image }}" alt="">
                                            <strong>{{ $product->name }}</strong>
                                        </span>
                                    </td>

                                    <td data-label="Category">
                                        <span class="gt-cat-pill">{{ $product->category_details->name }}</span>
                                    </td>

                                    <td data-label="Price">
                                        <span class="gt-var-list">
                                            @foreach($product->product_variations as $variation)
                                            <span class="gt-var">{{ $variation->name }} <b>£{{ number_format($variation->price, 2) }}</b></span>
                                            @endforeach
                                        </span>
                                    </td>

                                    <td data-label="Details">
                                        <span class="gt-clamp" title="{{ $product->details }}">{{ $product->details }}</span>
                                    </td>

                                    <td data-label="Image" class="hidden-xs">
                                        <img class="gt-thumb" src="{{ URL::to('/') }}/images/product/{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
                                    </td>

                                    <td data-label="Status">
                                        <span class="gt-onoff @if(strtolower($product->status) == 'active') is-on @endif">{{ $product->status }}</span>
                                    </td>

                                    <td data-label="Action">
                                        <div class="gt-acts">
                                            <a href="{{ URL::to('product') }}/{{ $product->id }}/edit" class="gt-act gt-act--view" title="Edit {{ $product->name }}">
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
    </div>
</section>
@endsection

@push('script')
<script>
    $("#example1").DataTable({
        autoWidth: false,
        language: {
            search: '',
            searchPlaceholder: 'Search products…',
            emptyTable: 'No products yet. Add your first dish!',
            zeroRecords: 'No matching products found',
            info: 'Showing _START_–_END_ of _TOTAL_ products',
            infoEmpty: '',
            lengthMenu: 'Show _MENU_'
        }
    });
</script>
@endpush