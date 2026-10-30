@extends('layouts.frontend.main')

@section('content')

@php $total_price = 0; @endphp
@php $delivery_charge = 3.00; @endphp
@if($cartItems)
@foreach ($cartItems as $item)
@php $total_price += $item->quantity * $item->price; @endphp
@endforeach
@endif
@if($total_price > 30 || count($cartItems) == 0)
@php $delivery_charge = 0.00; @endphp
@endif
@php $itemCount = $cartItems ? count($cartItems) : 0; @endphp

<!-- PAGE HEADER -->
<section class="gt-page-head">
    <div class="gt-container">
        <nav aria-label="breadcrumb">
            <ol class="gt-crumbs">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li aria-current="page">Cart</li>
            </ol>
        </nav>
        <h1 class="gt-page-head__title">Your bag</h1>
        <p class="gt-page-head__sub">
            @if($itemCount > 0)
            {{ $itemCount }} {{ $itemCount == 1 ? 'item' : 'items' }} ready to go
            @else
            Nothing here yet
            @endif
        </p>
    </div>
</section>

<!-- CART PAGE -->
<section id="cart-1" class="gt-cart-page">
    <div class="gt-container">

        @if(count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible fade show gt-alert" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @csrf
        <input type="hidden" id="update_product_cart_url" value="{{ URL::to('update-product-cart') }}">

        @if($itemCount == 0)

        <!-- EMPTY STATE -->
        <div class="gt-empty gt-reveal">
            <svg class="gt-empty__art gt-float" viewBox="0 0 200 200" aria-hidden="true">
                <ellipse cx="100" cy="172" rx="70" ry="8" fill="#000" opacity="0.08"/>
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
            <h2>Your bag is empty</h2>
            <p>Burgers, wraps and wings are waiting. Add something tasty to get started.</p>
            <a href="{{ URL::to('/') }}#menu-8" class="gt-btn gt-btn--brand">Browse the menu</a>
        </div>

        @else

        <div class="gt-cart-layout">

            <!-- ITEMS -->
            <div class="gt-cart-items" id="myTable">
                @foreach ($cartItems as $key => $item)
                <article class="gt-cart-item" style="--i: {{ min($loop->index, 8) }}">

                    <div class="gt-cart-item__img">
                        <img src="{{ asset('images/product') }}/{{ ($item->attributes['image']?$item->attributes['image']:asset('testo/images/menu/burger-07.png')) }}" alt="{{ $item->name }}">
                    </div>

                    <div class="gt-cart-item__info">
                        <div class="gt-cart-item__top">
                            <h3 class="gt-cart-item__name">{{ $item->name }}</h3>
                            <form method="post" action="{{route('cart.destroy',$item->id)}}" class="gt-cart-item__remove">
                                @method('delete')
                                @csrf
                                <button type="submit" class="gt-icon-round" aria-label="Remove {{ $item->name }}">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v6M14 11v6"/></svg>
                                </button>
                            </form>
                        </div>

                        <ul class="gt-chips">
                            @foreach ($item->attributes as $attrKey => $attribute)
                            @if($attribute != '' && in_array($attrKey, ['variation', 'flavour', 'side', 'sauce', 'drink']))
                            <li class="gt-chip">{{ $attribute }}</li>
                            @endif
                            @if($attribute != '' && $attrKey == 'removable')
                            <li class="gt-chip gt-chip--no">Remove: {{ $attribute }}</li>
                            @endif
                            @endforeach
                        </ul>

                        <div class="gt-cart-item__bottom">
                            <div class="gt-stepper">
                                <button type="button" class="gt-stepper__btn" onclick="gtStep({{ $item->id }}, -1)" aria-label="Decrease quantity" @if($item->quantity <= 1) disabled @endif>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14"/></svg>
                                </button>
                                <input class="qty" type="number" min="1" value="{{ $item->quantity }}" id="quantity-{{$item->id}}" onchange="updateCartQuantity({{$item->id}})" aria-label="Quantity for {{ $item->name }}">
                                <button type="button" class="gt-stepper__btn" onclick="gtStep({{ $item->id }}, 1)" aria-label="Increase quantity">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                                </button>
                            </div>

                            <div class="gt-cart-item__price">
                                <small>£{{ number_format($item->price, 2, '.', '') }} each</small>
                                <strong>£<span id="productPriceTotal">{{ number_format($item->quantity * $item->price, 2, '.', '') }}</span></strong>
                            </div>
                        </div>
                    </div>

                </article>
                @endforeach

                <a href="{{ URL::to('/') }}#menu-8" class="gt-add-more">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                    Add more items
                </a>
            </div>

            <!-- SUMMARY -->
            <aside class="gt-summary">
                <div class="gt-summary__card">
                    <h2 class="gt-summary__title">Order summary</h2>

                    @if($total_price <= 30)
                    @php $left = 30 - $total_price; @endphp
                    <div class="gt-freebar">
                        <p>Spend <strong>£{{ number_format($left > 0 ? $left : 0.01, 2) }}</strong> more for <strong>free delivery</strong></p>
                        <div class="gt-freebar__track"><span style="width: {{ min(100, round(($total_price / 30) * 100)) }}%"></span></div>
                    </div>
                    @else
                    <div class="gt-freebar is-done">
                        <p>🎉 You've unlocked <strong>free delivery</strong></p>
                        <div class="gt-freebar__track"><span style="width: 100%"></span></div>
                    </div>
                    @endif

                    <dl class="gt-summary__rows">
                        <div><dt>Items ({{ $itemCount }})</dt><dd>£{{ number_format($total_price, 2, '.', '') }}</dd></div>
                        <div class="gt-summary__total"><dt>Total</dt><dd>£{{ number_format($total_price, 2, '.', '') }}</dd></div>
                    </dl>

                    <a href="{{route('checkout')}}" class="gt-btn gt-btn--brand gt-btn--block">
                        Proceed to checkout
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </a>

                    <p class="gt-summary__note">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Delivery or collection is chosen at checkout
                    </p>
                </div>
            </aside>

        </div>

        <!-- MOBILE CHECKOUT BAR -->
        <div class="gt-mbar">
            <div class="gt-mbar__total">
                <small>Total</small>
                <strong>£{{ number_format($total_price, 2, '.', '') }}</strong>
            </div>
            <a href="{{route('checkout')}}" class="gt-btn gt-btn--brand">Checkout</a>
        </div>

        @endif

    </div>
</section>

@push('script')
<script>
    function updateCartQuantity(uniqueId) {
        var updatedQuantity = $('#quantity-' + uniqueId).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: $('#update_product_cart_url').val() + '/' + uniqueId + '/' + updatedQuantity,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(xhr, formProductId) {},

            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {}
        })
    }

    function gtStep(id, delta) {
        var input = document.getElementById('quantity-' + id);
        if (!input) return;
        var current = parseInt(input.value, 10) || 1;
        var next = Math.max(1, current + delta);
        if (next === current) return;
        input.value = next;
        input.dispatchEvent(new Event('change')); 
    }

    (function () {
        document.querySelectorAll('.gt-cart-item .qty').forEach(function (input) {
            input.addEventListener('change', function () {
                var card = input.closest('.gt-cart-item');
                if (card) card.classList.add('is-loading');
            });
        });
        document.querySelectorAll('.gt-cart-item__remove').forEach(function (form) {
            form.addEventListener('submit', function () {
                var card = form.closest('.gt-cart-item');
                if (card) card.classList.add('is-removing');
            });
        });
    })();
</script>
@endpush
@endsection