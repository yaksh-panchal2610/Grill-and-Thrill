@extends('layouts.admin.main')
@section('content')

@php
    $gtTitles = [
        'new_order' => 'New',
        'preparing_order' => 'Preparing',
        'sent_to_delivery_order' => 'Sent to delivery',
        'completed_order' => 'Completed',
        'cancelled_order' => 'Cancelled',
    ];
    $gtListTitle = $gtTitles[$pageName] ?? 'All';
@endphp

<!-- Page header -->
<section class="content-header">
    <h1>
        Orders
        <small>{{ $gtListTitle }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a></li>
        <li class="active">{{ $gtListTitle }} orders</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Status tabs -->
    <nav class="gt-seg" aria-label="Order status">
        <a href="{{ URL::to('order-list') }}/new" class="@if($pageName == 'new_order') is-active @endif">
            <i class="fa fa-bell-o" aria-hidden="true"></i> New <span class="gt-seg__count">{{ $orderCount['new'] }}</span>
        </a>
        <a href="{{ URL::to('order-list') }}/preparing" class="@if($pageName == 'preparing_order') is-active @endif">
            <i class="fa fa-fire" aria-hidden="true"></i> Preparing <span class="gt-seg__count">{{ $orderCount['preparing'] }}</span>
        </a>
        <a href="{{ URL::to('order-list') }}/sent_to_delivery" class="@if($pageName == 'sent_to_delivery_order') is-active @endif">
            <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Sent <span class="gt-seg__count">{{ $orderCount['sent_to_delivery'] }}</span>
        </a>
        <a href="{{ URL::to('order-list') }}/completed" class="@if($pageName == 'completed_order') is-active @endif">
            <i class="fa fa-check" aria-hidden="true"></i> Completed <span class="gt-seg__count">{{ $orderCount['completed'] }}</span>
        </a>
        <a href="{{ URL::to('order-list') }}/cancelled" class="@if($pageName == 'cancelled_order') is-active @endif">
            <i class="fa fa-times" aria-hidden="true"></i> Cancelled <span class="gt-seg__count">{{ $orderCount['cancelled'] }}</span>
        </a>
    </nav>

    <input type="hidden" id="update_order_status_url" value="{{ URL::to('update-order-status') }}">

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
                                <th>Customer</th>
                                <th>Order Products</th>
                                <th>Order Total</th>
                                <th>Delivery Method</th>
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
                            <tr class="@if($order->status == 'new') is-new @endif">
                                <td data-label="Order" class="gt-order-id">#{{ $order->id }}</td>

                                <td data-label="Customer" class="gt-cust">
                                    <span>
                                        <strong>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</strong>
                                        @if($order->customer->contact_no)
                                        <a href="tel:{{ $order->customer->contact_no }}"><i class="fa fa-phone" aria-hidden="true"></i> {{ $order->customer->contact_no }}</a>
                                        @endif
                                    </span>
                                </td>

                                <td data-label="Items" class="gt-order-products">
                                    @php $i = 0; @endphp
                                    @foreach($order->order_details as $details)
                                    @if($i > 0), @endif{{ $details->product->name }}
                                    @php $i++; @endphp
                                    @endforeach
                                </td>

                                <td data-label="Total" class="gt-order-total" data-order="{{ $gtTotal }}">£{{ number_format($gtTotal, 2) }}</td>

                                <td data-label="Method">
                                    <span class="gt-method @if(strtolower($order->delivery_method) == 'delivery') gt-method--delivery @endif">
                                        <i class="fa {{ strtolower($order->delivery_method) == 'delivery' ? 'fa-truck' : 'fa-shopping-bag' }}" aria-hidden="true"></i>
                                        {{ $order->delivery_method }}
                                    </span>
                                </td>

                                <td data-label="Ordered" class="gt-order-date" data-order="{{ $gtDate->timestamp }}">
                                    {{ $gtDate->format('d M Y') }}
                                    <small>{{ $gtDate->format('g:i A') }}</small>
                                </td>

                                <td data-label="Action">
                                    <div class="gt-acts">
                                        <a href="{{ URL::to('order') }}/{{ $order->id }}" class="gt-act gt-act--view" title="View order #{{ $order->id }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i> View
                                        </a>

                                        @if($order->status == 'new')
                                        <button type="button" class="gt-act gt-act--next" onclick="updateOrderStatus({{ $order->id }}, 'preparing')" title="Prepare Order">
                                            <i class="fa fa-fire" aria-hidden="true"></i> Start preparing
                                        </button>
                                        @endif

                                        @if($order->status == 'preparing')
                                        <button type="button" class="gt-act gt-act--next" onclick="updateOrderStatus({{ $order->id }}, 'sent_to_delivery')" title="Send Order to Delivery">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Send out
                                        </button>
                                        @endif

                                        @if($order->status == 'sent_to_delivery')
                                        <button type="button" class="gt-act gt-act--next" onclick="updateOrderStatus({{ $order->id }}, 'completed')" title="Complete Order">
                                            <i class="fa fa-check" aria-hidden="true"></i> Complete
                                        </button>
                                        @endif

                                        @if($order->status != 'completed' && $order->status != 'cancelled')
                                        <button type="button" class="gt-act gt-act--cancel" onclick="updateOrderStatus({{ $order->id }}, 'cancelled')" title="Cancel Order" aria-label="Cancel order #{{ $order->id }}">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                        @endif
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
            searchPlaceholder: 'Search orders…',
            emptyTable: 'No orders here right now 🍔',
            zeroRecords: 'No matching orders found',
            info: 'Showing _START_–_END_ of _TOTAL_ orders',
            infoEmpty: '',
            lengthMenu: 'Show _MENU_'
        }
    });

    function updateOrderStatus(orderId, status) {
        if (!confirm('Are you sure to change the order status?')) {
            return;
        }
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