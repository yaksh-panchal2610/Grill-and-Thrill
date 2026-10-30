@extends('layouts.customer.main')
@section('content')

@php
    $gtListTitle = 'Order';
    if ($pageName == 'customer_current_order') $gtListTitle = 'Current';
    if ($pageName == 'customer_completed_order') $gtListTitle = 'Completed';
    if ($pageName == 'customer_cancelled_order') $gtListTitle = 'Cancelled';

    $gtStatusText = [
        'new' => 'Order Received',
        'preparing' => 'Preparing Order',
        'sent_to_delivery' => 'Order Sent to Delivery',
        'completed' => 'Order Completed',
        'cancelled' => 'Order Cancelled',
    ];
@endphp

<!-- Page header -->
<section class="content-header">
    <h1>
        My orders
        <small>{{ $gtListTitle }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('customer/dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a></li>
        <li class="active">{{ $gtListTitle }} orders</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Status tabs -->
    <nav class="gt-seg" aria-label="Order status">
        <a href="{{ URL::to('customer/order-list') }}/current" class="@if($pageName == 'customer_current_order') is-active @endif">
            <i class="fa fa-clock-o" aria-hidden="true"></i> Current
            <span class="gt-seg__count">{{ $customerOrderCount['current'] }}</span>
        </a>
        <a href="{{ URL::to('customer/order-list') }}/completed" class="@if($pageName == 'customer_completed_order') is-active @endif">
            <i class="fa fa-check" aria-hidden="true"></i> Completed
            <span class="gt-seg__count">{{ $customerOrderCount['completed'] }}</span>
        </a>
        <a href="{{ URL::to('customer/order-list') }}/cancelled" class="@if($pageName == 'customer_cancelled_order') is-active @endif">
            <i class="fa fa-times" aria-hidden="true"></i> Cancelled
            <span class="gt-seg__count">{{ $customerOrderCount['cancelled'] }}</span>
        </a>
    </nav>

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
                    <h3 class="box-title">{{ $gtListTitle }} order list</h3>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-hover gt-orders-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Status</th>
                                <th>Order Products</th>
                                <th>Order Total</th>
                                <th>Ordered At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allOrders as $order)
                            @php
                                $gtTotal = $order->total_price + $order->delivery_charge;
                                $gtDate = \Carbon\Carbon::parse($order->created_at);
                            @endphp
                            <tr>
                                <td data-label="Order" class="gt-order-id">#{{ $order->id }}</td>

                                <td data-label="Status">
                                    @if(isset($gtStatusText[$order->status]))
                                    <span class="gt-status gt-status--{{ $order->status }}">{{ $gtStatusText[$order->status] }}</span>
                                    @endif
                                </td>

                                <td data-label="Items" class="gt-order-products">
                                    @php $i = 0; @endphp
                                    @foreach($order->order_details as $details)
                                    @if($i > 0), @endif{{ $details->product->name }}
                                    @php $i++; @endphp
                                    @endforeach
                                </td>

                                <td data-label="Total" class="gt-order-total" data-order="{{ $gtTotal }}">£{{ number_format($gtTotal, 2) }}</td>

                                <td data-label="Ordered" class="gt-order-date" data-order="{{ $gtDate->timestamp }}">
                                    {{ $gtDate->format('d M Y') }}
                                    <small>{{ $gtDate->format('g:i A') }}</small>
                                </td>

                                <td data-label="Action">
                                    <a href="{{ URL::to('customer/order-details') }}/{{ $order->id }}" class="gt-view-btn" title="View order #{{ $order->id }}">
                                        View <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
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
            searchPlaceholder: 'Search orders…',
            emptyTable: 'No orders here yet 🍔',
            zeroRecords: 'No matching orders found',
            info: 'Showing _START_–_END_ of _TOTAL_ orders',
            infoEmpty: '',
            lengthMenu: 'Show _MENU_'
        }
    });

    function updateOrderStatus(orderId, status) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: $('#update_order_status_url').val() + '/' + orderId + '/' + status,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(xhr, formProductId) {},
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {}
        });
    }
</script>
@endpush