@extends('layouts.frontend.main')

@section('content')

<section class="gt-confirm">
    <div class="gt-container">
        <div class="gt-confirm__card">

            <div class="gt-check" aria-hidden="true">
                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
            </div>

            <h1 class="gt-confirm__title">Thank you, your order is in! 🔥</h1>

            <p class="gt-confirm__text">
                Your order has been confirmed. You can check the order status in your
                <a href="{{ URL::to('customer/dashboard') }}">dashboard</a>.
            </p>

            <ol class="gt-confirm__steps" aria-label="What happens next">
                <li class="is-done" style="--i: 0">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
                    </span>
                    Order placed
                </li>
                <li style="--i: 1">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 2-2 3-3 3 0-3-1-5-3-7-1 4-4 7-4 13 0 4 3 7 7 7z"/></svg>
                    </span>
                    Being grilled
                </li>
                <li style="--i: 2">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/></svg>
                    </span>
                    Ready to collect
                </li>
            </ol>

            <div class="gt-confirm__actions">
                <a href="{{ URL::to('customer/dashboard') }}" class="gt-btn gt-btn--brand">
                    Track in dashboard
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <a href="{{ URL::to('/') }}#menu-8" class="gt-btn gt-btn--soft">Back to menu</a>
            </div>

            <p class="gt-confirm__help">Questions about your order? Call <a href="tel:02085514329">020 8551 4329</a></p>

        </div>
    </div>
</section>

@endsection