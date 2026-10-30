@extends('layouts.frontend.main')

@section('content')

@php $total_price = 0; @endphp
@php $delivery_charge = 3.00; @endphp
@if($cartItems)
@foreach ($cartItems as $item)
@php $total_price += $item->quantity * $item->price; @endphp
@endforeach
@endif
@if($total_price > 30)
@php $delivery_charge = 0.00; @endphp
@endif

<!-- PAGE HEADER -->
<section class="gt-page-head">
    <div class="gt-container">
        <nav aria-label="breadcrumb">
            <ol class="gt-crumbs">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                <li aria-current="page">Checkout</li>
            </ol>
        </nav>
        <h1 class="gt-page-head__title">Checkout</h1>

        <ol class="gt-steps" aria-label="Checkout progress">
            <li class="is-done"><span>✓</span> Bag</li>
            <li class="is-current" aria-current="step"><span>2</span> Details</li>
            <li><span>3</span> Payment</li>
        </ol>
    </div>
</section>

<!-- CHECKOUT -->
<section id="cart-1" class="gt-cart-page gt-checkout">
    <div class="gt-container">

        @csrf
        <input type="hidden" id="update_product_cart_url" value="{{ URL::to('update-product-cart') }}">

        <form action="{{ route('payment') }}" method="POST">
            @csrf
            <div class="gt-cart-layout">

                <!-- LEFT: DETAILS -->
                <div class="gt-co-steps">

                    <!-- Your details -->
                    <div class="gt-co-card" style="--i: 0">
                        <div class="gt-co-card__head">
                            <span class="gt-co-card__num">1</span>
                            <h2>Your details</h2>
                        </div>
                        <ul class="gt-co-info">
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                                <span><small>Name</small>{{ $customer->first_name.' '.$customer->last_name }}</span>
                            </li>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
                                <span><small>Email</small>{{ $customer->email }}</span>
                            </li>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>
                                <span><small>Contact no</small>{{ $customer->contact_no }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Delivery method -->
                    <div class="gt-co-card" style="--i: 1">
                        <div class="gt-co-card__head">
                            <span class="gt-co-card__num">2</span>
                            <h2>How would you like it?</h2>
                        </div>

                        <div class="gt-options">
                            <label for="pickId" class="gt-option">
                                <input type="radio" name="delivery_method" @if(old('delivery_method') !='Delivery' ) checked @endif value="Pickup" id="pickId" onclick="deliverySelected('Pickup')">
                                <span class="gt-option__icon" aria-hidden="true">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/></svg>
                                </span>
                                <span class="gt-option__text">
                                    <strong>Pickup</strong>
                                    <small>18, Seven Ways Parade, Gants Hill, Ilford IG2 6JX</small>
                                </span>
                                <span class="gt-option__tag">Free</span>
                            </label>

                            <!--
                            <label for="deliverId" class="gt-option">
                                <input type="radio" name="delivery_method" @if(old('delivery_method')=='Delivery' ) checked @endif value="Delivery" id="deliverId" onclick="deliverySelected('Delivery')">
                                <span class="gt-option__icon" aria-hidden="true">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="7" width="13" height="10" rx="1"/><path d="M14 10h4l3 3v4h-7z"/><circle cx="6" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>
                                </span>
                                <span class="gt-option__text">
                                    <strong>Delivery</strong>
                                    <small>Free on orders over £30</small>
                                </span>
                            </label>
                            -->
                        </div>

                        <div class="gt-field" id="address_div" style="@if(old('delivery_method') != 'Delivery') display: none; @endif ">
                            <label for="gt-address" class="gt-field__label">Delivery address</label>
                            <textarea id="gt-address" name="address" class="form-control message" rows="4" placeholder="House number, street, postcode…">{{ $customer->address }}</textarea>
                            @error('address')
                            <span class="gt-field__error" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="gt-co-card" style="--i: 2">
                        <div class="gt-co-card__head">
                            <span class="gt-co-card__num">3</span>
                            <h2>Payment</h2>
                        </div>

                        <div class="gt-options">
                            <label for="stripe" class="gt-option">
                                <input type="radio" name="payment_type" checked="checked" value="stripe" id="stripe">
                                <span class="gt-option__icon" aria-hidden="true">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M6 15h4"/></svg>
                                </span>
                                <span class="gt-option__text">
                                    <strong>Card payment</strong>
                                    <small>Secure checkout powered by Stripe</small>
                                </span>
                                <span class="gt-option__lock" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- RIGHT: SUMMARY -->
                <aside class="gt-summary">
                    <div class="gt-summary__card">
                        <h2 class="gt-summary__title">Your order</h2>

                        <ul class="gt-mini-items" id="myTable">
                            @if($cartItems)
                            @foreach ($cartItems as $key => $item)
                            <li class="gt-mini-item">
                                <span class="gt-mini-item__img">
                                    <img src="{{ asset('images/product') }}/{{ ($item->attributes['image']?$item->attributes['image']:asset('testo/images/menu/burger-07.png')) }}" alt="">
                                    <em>{{ $item->quantity }}</em>
                                </span>
                                <span class="gt-mini-item__info">
                                    <strong>{{ $item->name }}</strong>
                                    <small>
                                        @php $opts = []; @endphp
                                        @foreach ($item->attributes as $attrKey => $attribute)
                                        @if($attribute != '' && in_array($attrKey, ['variation', 'flavour', 'side', 'sauce', 'drink']))
                                        @php $opts[] = $attribute; @endphp
                                        @endif
                                        @endforeach
                                        {{ implode(' · ', $opts) }}
                                    </small>
                                </span>
                                <span class="gt-mini-item__price">£<span id="productPriceTotal">{{ number_format($item->quantity * $item->price, 2, '.', '') }}</span></span>
                            </li>
                            @endforeach
                            @endif
                        </ul>

                        <dl class="gt-summary__rows">
                            <div><dt>Subtotal</dt><dd>£<span id="sub_total">{{ number_format($total_price, 2, '.', '') }}</span></dd></div>
                            <div><dt>Delivery charge</dt><dd>£<span id="delivery_charge">{{ number_format($delivery_charge, 2, '.', '') }}</span></dd></div>
                            <div class="gt-summary__total"><dt>Total</dt><dd>£<span id="grand_total">{{ number_format($total_price + $delivery_charge, 2, '.', '') }}</span></dd></div>
                        </dl>

                        <button type="submit" class="gt-btn gt-btn--brand gt-btn--block">
                            Continue to secure payment
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </button>

                        <p class="gt-summary__note">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Payments are encrypted and processed by Stripe
                        </p>
                    </div>
                </aside>

            </div>

            <!-- MOBILE PAY BAR -->
            <div class="gt-mbar">
                <div class="gt-mbar__total">
                    <small>Total</small>
                    <strong>£<span id="gt-mbar-total">{{ number_format($total_price + $delivery_charge, 2, '.', '') }}</span></strong>
                </div>
                <button type="submit" class="gt-btn gt-btn--brand">Pay securely</button>
            </div>
        </form>

    </div>
</section>

@push('script')
<script>
    var main_total_price = {{$total_price}};
    var main_delivery_charge = {{$delivery_charge}};

    $(document).ready(function() {
        if($('input[name="delivery_method"]:checked').val() == 'Pickup'){
            $('#delivery_charge').html('0.00');
            $('#grand_total').html(parseFloat(main_total_price).toFixed(2));
        }else if($('input[name="delivery_method"]:checked').val() == 'Delivery'){
            $('#delivery_charge').html(parseFloat(main_delivery_charge).toFixed(2));
            $('#grand_total').html(parseFloat(main_total_price + main_delivery_charge).toFixed(2));
        }
    });

    function deliverySelected(method) {
        if (method == 'Pickup') {
            $("#address_div").hide("slow");
            $('#delivery_charge').html('0.00');
            $('#grand_total').html(parseFloat(main_total_price).toFixed(2));
        } else {
            $("#address_div").show("slow");
            $('#delivery_charge').html(parseFloat(main_delivery_charge).toFixed(2));
            $('#grand_total').html(parseFloat(main_total_price + main_delivery_charge).toFixed(2));
        }
    }

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

    (function () {
        var source = document.getElementById('grand_total');
        var target = document.getElementById('gt-mbar-total');
        if (!source || !target) return;
        var sync = function () { target.textContent = source.textContent; };
        sync();
        new MutationObserver(sync).observe(source, { childList: true, characterData: true, subtree: true });
    })();
</script>
@endpush
@endsection