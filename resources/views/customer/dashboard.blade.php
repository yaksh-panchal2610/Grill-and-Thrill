@extends('layouts.customer.main')

@section('content')

@php
    $gtFirst = optional(session()->get('customer'))->first_name;
@endphp

<!-- Page header -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Your orders at a glance</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Website</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Welcome -->
    <div class="gt-welcome">
        <div class="gt-welcome__text">
            <span class="gt-welcome__eyebrow">My account</span>
            <h2>Hi {{ $gtFirst ?: 'there' }} 👋, welcome back</h2>
            <p>Track your orders here, or grab something tasty from the grill.</p>
        </div>
        <div class="gt-welcome__actions">
            <svg class="gt-welcome__burger gt-float" viewBox="0 0 200 200" aria-hidden="true">
                <path d="M32 140 H168 Q168 166 140 166 H60 Q32 166 32 140 Z" fill="#E08A2C"/>
                <rect x="26" y="116" width="148" height="24" rx="12" fill="#6B3A1E"/>
                <path d="M26 112 H174 L162 130 L150 118 L132 134 L114 118 L94 132 L76 118 L58 130 L42 118 Z" fill="#FFC93C"/>
                <rect x="30" y="102" width="140" height="10" rx="5" fill="#E2513A"/>
                <path d="M24 96 q9 10 19 0 t19 0 t19 0 t19 0 t19 0 t19 0 t19 0 t20 0 v10 H24 z" fill="#6BBF59"/>
                <path d="M30 96 Q30 38 100 38 Q170 38 170 96 Z" fill="#F2A33A"/>
                <ellipse cx="76" cy="62" rx="4" ry="2.6" fill="#FFF3D6" transform="rotate(-20 76 62)"/>
                <ellipse cx="102" cy="54" rx="4" ry="2.6" fill="#FFF3D6"/>
                <ellipse cx="126" cy="64" rx="4" ry="2.6" fill="#FFF3D6" transform="rotate(20 126 64)"/>
            </svg>
            <a href="{{ URL::to('/') }}#menu-8" class="gt-btn gt-btn--brand">
                <i class="fa fa-cutlery" aria-hidden="true"></i> Order food
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="gt-stats">
        <a href="{{ URL::to('customer/order-list') }}/current" class="gt-stat gt-stat--current" style="--i: 0">
            <span class="gt-stat__top">
                <span class="gt-stat__icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                <i class="fa fa-arrow-right gt-stat__arrow" aria-hidden="true"></i>
            </span>
            <span>
                <span class="gt-stat__num">{{ $customerOrderCount['current'] }}</span>
                <span class="gt-stat__label">Current orders</span>
            </span>
        </a>

        <a href="{{ URL::to('customer/order-list') }}/completed" class="gt-stat gt-stat--done" style="--i: 1">
            <span class="gt-stat__top">
                <span class="gt-stat__icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                <i class="fa fa-arrow-right gt-stat__arrow" aria-hidden="true"></i>
            </span>
            <span>
                <span class="gt-stat__num">{{ $customerOrderCount['completed'] }}</span>
                <span class="gt-stat__label">Completed orders</span>
            </span>
        </a>

        <a href="{{ URL::to('customer/order-list') }}/cancelled" class="gt-stat gt-stat--cancel" style="--i: 2">
            <span class="gt-stat__top">
                <span class="gt-stat__icon"><i class="fa fa-times" aria-hidden="true"></i></span>
                <i class="fa fa-arrow-right gt-stat__arrow" aria-hidden="true"></i>
            </span>
            <span>
                <span class="gt-stat__num">{{ $customerOrderCount['cancelled'] }}</span>
                <span class="gt-stat__label">Cancelled orders</span>
            </span>
        </a>
    </div>

    <!-- Quick actions -->
    <h3 class="gt-section-title">Quick actions</h3>
    <div class="gt-quick">
        <a href="{{ URL::to('/') }}#menu-8" class="gt-quick__item">
            <i class="fa fa-cutlery" aria-hidden="true"></i>
            <span>Order food<small>Browse the full menu</small></span>
        </a>
        <a href="tel:02085514329" class="gt-quick__item">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <span>Call the shop<small>020 8551 4329</small></span>
        </a>
        <a href="https://www.google.com/maps/search/?api=1&query=18+Seven+Ways+Parade+Gants+Hill+Ilford+IG2+6JX" target="_blank" rel="noopener" class="gt-quick__item">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span>Visit us<small>Gants Hill, Ilford IG2 6JX</small></span>
        </a>
    </div>

</section>

@endsection