@extends('layouts.admin.main')

@section('content')

<!-- Page header -->
<section class="content-header">
    <h1>
        Dashboard
        <small>{{ now()->format('l, d M Y') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-th-large"></i> Admin</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Welcome -->
    <div class="gt-welcome">
        <div class="gt-welcome__text">
            <span class="gt-welcome__eyebrow">Grill and Thrill · Admin</span>
            <h2>Today's kitchen 🔥</h2>
            <p>
                @if($orderCount['new'] > 0)
                You have <strong style="color:#FFFFFF;">{{ $orderCount['new'] }} new {{ $orderCount['new'] == 1 ? 'order' : 'orders' }}</strong> waiting.
                @else
                No new orders right now. We'll ring the bell when one comes in.
                @endif
            </p>
        </div>
        <div class="gt-welcome__actions">
            <a href="{{ URL::to('order-list') }}/new" class="gt-btn gt-btn--brand">
                <i class="fa fa-bell-o" aria-hidden="true"></i> New orders
            </a>
            <a href="{{ URL::to('product') }}/create" class="gt-btn gt-btn--soft">
                <i class="fa fa-plus" aria-hidden="true"></i> Add product
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="gt-stats">
        <a href="{{ URL::to('order-list') }}/new" class="gt-stat gt-stat--hot @if($orderCount['new'] > 0) is-live @endif" style="--i: 0">
            <span class="gt-stat__top">
                <span class="gt-stat__icon"><i class="fa fa-bell" aria-hidden="true"></i></span>
                <i class="fa fa-arrow-right gt-stat__arrow" aria-hidden="true"></i>
            </span>
            <span>
                <span class="gt-stat__num">{{ $orderCount['new'] }}</span>
                <span class="gt-stat__label">New orders</span>
            </span>
        </a>

        <a href="{{ URL::to('product') }}" class="gt-stat gt-stat--menu" style="--i: 1">
            <span class="gt-stat__top">
                <span class="gt-stat__icon"><i class="fa fa-cutlery" aria-hidden="true"></i></span>
                <i class="fa fa-arrow-right gt-stat__arrow" aria-hidden="true"></i>
            </span>
            <span>
                <span class="gt-stat__num">{{ $cardData['total_products'] }}</span>
                <span class="gt-stat__label">Products</span>
            </span>
        </a>

        <a href="{{ URL::to('category') }}" class="gt-stat gt-stat--cat" style="--i: 2">
            <span class="gt-stat__top">
                <span class="gt-stat__icon"><i class="fa fa-tags" aria-hidden="true"></i></span>
                <i class="fa fa-arrow-right gt-stat__arrow" aria-hidden="true"></i>
            </span>
            <span>
                <span class="gt-stat__num">{{ $cardData['total_categories'] }}</span>
                <span class="gt-stat__label">Categories</span>
            </span>
        </a>
    </div>

    <!-- Order pipeline -->
    <h3 class="gt-section-title">Order pipeline</h3>
    <div class="gt-pipe">
        <a href="{{ URL::to('order-list') }}/new" class="gt-pipe__item" style="--dot: #D9381E;">
            <strong>{{ $orderCount['new'] }}</strong>
            <span>New</span>
        </a>
        <a href="{{ URL::to('order-list') }}/preparing" class="gt-pipe__item" style="--dot: #F2A33A;">
            <strong>{{ $orderCount['preparing'] }}</strong>
            <span>Preparing</span>
        </a>
        <a href="{{ URL::to('order-list') }}/sent_to_delivery" class="gt-pipe__item" style="--dot: #8B6CE0;">
            <strong>{{ $orderCount['sent_to_delivery'] }}</strong>
            <span>Sent to delivery</span>
        </a>
        <a href="{{ URL::to('order-list') }}/completed" class="gt-pipe__item" style="--dot: #2F9E5B;">
            <strong>{{ $orderCount['completed'] }}</strong>
            <span>Completed</span>
        </a>
        <a href="{{ URL::to('order-list') }}/cancelled" class="gt-pipe__item" style="--dot: #A8A29E;">
            <strong>{{ $orderCount['cancelled'] }}</strong>
            <span>Cancelled</span>
        </a>
    </div>

    <!-- Quick actions -->
    <h3 class="gt-section-title">Quick actions</h3>
    <div class="gt-quick">
        <a href="{{ URL::to('product') }}/create" class="gt-quick__item">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span>Add product<small>Put a new dish on the menu</small></span>
        </a>
        <a href="{{ URL::to('category') }}/create" class="gt-quick__item">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <span>Add category<small>Group dishes, like "Wraps"</small></span>
        </a>
        <a href="{{ URL::to('/') }}" target="_blank" rel="noopener" class="gt-quick__item">
            <i class="fa fa-external-link" aria-hidden="true"></i>
            <span>View website<small>See the menu as customers do</small></span>
        </a>
    </div>

</section>

@endsection