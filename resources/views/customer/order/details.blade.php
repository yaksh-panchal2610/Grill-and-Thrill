@extends('layouts.customer.main')
@section('content')

@php
    $gtStatusText = [
        'new' => 'Order Received',
        'preparing' => 'Preparing Order',
        'sent_to_delivery' => 'Order Sent to Delivery',
        'completed' => 'Order Completed',
        'cancelled' => 'Order Cancelled',
    ];
    $gtSteps = [
        'new' => ['Received', 'fa-check'],
        'preparing' => ['Preparing', 'fa-fire'],
        'sent_to_delivery' => ['Sent', 'fa-shopping-bag'],
        'completed' => ['Completed', 'fa-thumbs-up'],
    ];
    $gtKeys = array_keys($gtSteps);
    $gtNow = array_search($orderData->status, $gtKeys);
    $gtDate = \Carbon\Carbon::parse($orderData->created_at);
    $gtPaid = in_array(strtolower((string) $orderData->payment_status), ['paid', 'succeeded', 'success', 'complete', 'completed']);
@endphp

<!-- Page header (kept for AdminLTE spacing) -->
<section class="content-header"></section>

<section class="content invoice">

    <!-- Header -->
    <div class="gt-od-head">
        <div class="gt-od-head__left">
            <a href="javascript:history.back()" class="gt-back no-print" aria-label="Back">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <div>
                <h1>Order #{{ $orderData->id }}</h1>
                <span class="gt-od-head__meta">Date: {{ $gtDate->format('d M Y') }} · {{ $gtDate->format('g:i A') }}</span>
            </div>
        </div>
        <div class="gt-od-head__right">
            @if(isset($gtStatusText[$orderData->status]))
            <span class="gt-status gt-status--{{ $orderData->status }}">{{ $gtStatusText[$orderData->status] }}</span>
            @endif
            <button type="button" class="gt-btn gt-btn--soft no-print" onclick="window.print()">
                <i class="fa fa-print" aria-hidden="true"></i> Print
            </button>
        </div>
    </div>

    <?php if (Session::get('success_message') != "") { ?>
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ Session::get('success_message') }}
        </div>
    <?php } ?>

    <!-- Progress -->
    @if($orderData->status == 'cancelled')
    <div class="gt-cancel-banner">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        <span>Order Cancelled<small>If you have any questions, call us on 020 8551 4329.</small></span>
    </div>
    @elseif($gtNow !== false)
    <ol class="gt-track" aria-label="Order progress">
        @foreach($gtKeys as $idx => $key)
        @php
            $state = '';
            if ($idx < $gtNow || $orderData->status == 'completed') $state = 'is-done';
            elseif ($idx == $gtNow) $state = 'is-now';
        @endphp
        <li class="{{ $state }}" @if($state == 'is-now') aria-current="step" @endif>
            <span class="gt-track__dot"><i class="fa {{ $gtSteps[$key][1] }}" aria-hidden="true"></i></span>
            {{ $gtSteps[$key][0] }}
        </li>
        @endforeach
    </ol>
    @endif

    <div class="gt-od-grid">

        <!-- Items -->
        <div class="gt-od-card">
            <h3>Items</h3>
            <ul class="gt-od-items">
                @foreach($orderData->order_details as $details)
                <li class="gt-od-item">
                    <span class="gt-od-item__qty">{{ $details->quantity }}×</span>
                    <div class="gt-od-item__info">
                        <strong>{{ $details->product->name }}</strong>
                        <span class="gt-od-item__unit">£{{ number_format($details->price, 2) }} each</span>

                        <ul class="gt-chips">
                            @if($details->variation != null && $details->variation != '')
                            <li class="gt-chip">{{ $details->variation }}</li>
                            @endif
                            @if($details->flavour != null && $details->flavour != '')
                            <li class="gt-chip"><b>Flavour:</b> {{ $details->flavour }}</li>
                            @endif
                            @if($details->side != null && $details->side != '')
                            <li class="gt-chip"><b>Side:</b> {{ $details->side }}</li>
                            @endif
                            @if($details->sauce != null && $details->sauce != '')
                            <li class="gt-chip"><b>Sauce:</b> {{ $details->sauce }}</li>
                            @endif
                            @if($details->drink != null && $details->drink != '')
                            <li class="gt-chip"><b>Drink:</b> {{ $details->drink }}</li>
                            @endif
                            @if($details->removable != null && $details->removable != '')
                            <li class="gt-chip gt-chip--no">Remove: {{ $details->removable }}</li>
                            @endif
                        </ul>
                    </div>
                    <span class="gt-od-item__price">£{{ number_format($details->price * $details->quantity, 2) }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Side -->
        <div>
            <div class="gt-od-card">
                <h3>Summary</h3>
                <dl class="gt-od-rows">
                    <div><dt>Subtotal</dt><dd>£{{ number_format($orderData->total_price, 2) }}</dd></div>
                    <div><dt>Delivery charge</dt><dd>£{{ number_format($orderData->delivery_charge, 2) }}</dd></div>
                    <div class="gt-od-total"><dt>Total</dt><dd>£{{ number_format($orderData->total_price + $orderData->delivery_charge, 2) }}</dd></div>
                </dl>
            </div>

            <div class="gt-od-card">
                <h3>Details</h3>
                <ul class="gt-od-info">
                    <li><i class="fa fa-hashtag" aria-hidden="true"></i> Invoice #{{ $orderData->id }}</li>
                    <li>
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                        <span>Payment: <span class="gt-pay @if($gtPaid) is-paid @endif">{{ $orderData->payment_status }}</span></span>
                    </li>
                    <li><i class="fa fa-user" aria-hidden="true"></i> {{ $orderData->customer->first_name }} {{ $orderData->customer->last_name }}</li>
                    @if($orderData->address)
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $orderData->address }}</li>
                    @endif
                    <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $orderData->customer->contact_no }}</li>
                    <li><i class="fa fa-envelope" aria-hidden="true"></i> {{ $orderData->customer->email }}</li>
                </ul>
            </div>
        </div>

    </div>
</section>
@endsection

@push('script')
<script>
    $("#example1").DataTable();
</script>
@endpush