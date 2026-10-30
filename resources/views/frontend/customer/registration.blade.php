@extends('layouts.frontend.main')

@section('content')

<section id="contacts-page" class="gt-auth gt-auth--signup">
    <div class="gt-container">
        <div class="gt-auth__shell">

            <!-- LEFT: food panel -->
            <div class="gt-auth__art">
                <a href="{{ URL::to('/') }}" class="gt-auth__logo">
                    <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="Grill and Thrill" />
                </a>

                <div>
                    <h2>Join the<br>Grill &amp; Thrill crew</h2>
                    <p>Create your free account in under a minute.</p>
                </div>

                <ul class="gt-auth__perks">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
                        Order online in a few taps
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
                        Track every order from your dashboard
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
                        Faster checkout next time
                    </li>
                </ul>

                <svg class="gt-auth__burger gt-float" viewBox="0 0 200 200" aria-hidden="true">
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
            </div>

            <!-- RIGHT: form -->
            <div class="gt-auth__form">
                <h1 class="gt-auth__title">Create account</h1>
                <p class="gt-auth__sub">Fields marked <span style="color: var(--gt-brand);">*</span> are required.</p>

                <form action="{{ route('storeCurtomer') }}" method="POST" role="form">
                    @csrf

                    <div class="gt-form-row">
                        <div class="gt-form-group">
                            <label for="first_name" class="required">First name</label>
                            <div class="gt-input-wrap">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" autocomplete="given-name">
                            </div>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="gt-form-group">
                            <label for="last_name" class="required">Last name</label>
                            <div class="gt-input-wrap">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" autocomplete="family-name">
                            </div>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="gt-form-group">
                        <label for="email" class="required">E-mail address</label>
                        <div class="gt-input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="gt-form-group">
                        <label for="contact_no" class="required">Contact no</label>
                        <div class="gt-input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>
                            <input type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" id="contact_no" value="{{ old('contact_no') }}" autocomplete="tel" placeholder="07xxx xxxxxx">
                        </div>
                        @error('contact_no')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="gt-form-row">
                        <div class="gt-form-group">
                            <label for="password" class="required">Password</label>
                            <div class="gt-input-wrap gt-input-wrap--pw">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="new-password">
                                <button type="button" class="gt-pw-toggle" data-target="password" aria-label="Show password" aria-pressed="false">
                                    <svg class="gt-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <svg class="gt-eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.9 17.9A10.1 10.1 0 0 1 12 20c-7 0-11-8-11-8a18.5 18.5 0 0 1 5.1-5.9M9.9 4.2A9 9 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.2 3.2M1 1l22 22"/></svg>
                                </button>
                            </div>
                            <div class="gt-strength" id="gt-strength" data-level="0" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="gt-form-group">
                            <label for="password_confirmation" class="required">Confirm password</label>
                            <div class="gt-input-wrap gt-input-wrap--pw">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" autocomplete="new-password">
                                <button type="button" class="gt-pw-toggle" data-target="password_confirmation" aria-label="Show password" aria-pressed="false">
                                    <svg class="gt-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <svg class="gt-eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.9 17.9A10.1 10.1 0 0 1 12 20c-7 0-11-8-11-8a18.5 18.5 0 0 1 5.1-5.9M9.9 4.2A9 9 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.2 3.2M1 1l22 22"/></svg>
                                </button>
                            </div>
                            <span class="gt-match" id="gt-match" aria-live="polite"></span>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="gt-form-divider">Your address (optional)</div>

                    <div class="gt-form-group">
                        <label for="address">Address</label>
                        <div class="gt-input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5V21H3z"/><path d="M9 21v-6h6v6"/></svg>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address') }}" autocomplete="street-address" placeholder="House number and street">
                        </div>
                        @error('address')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="gt-form-group">
                        <label for="post_code">Post code</label>
                        <div class="gt-input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <input type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" id="post_code" value="{{ old('post_code') }}" autocomplete="postal-code" placeholder="e.g. IG2 6JX">
                        </div>
                        @error('post_code')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <button type="submit" class="gt-btn gt-btn--brand gt-btn--block">
                        Sign up
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </button>
                </form>

                <p class="gt-auth__switch">Have an account? <a href="{{ route('customer.login') }}">Log in</a></p>
            </div>

        </div>
    </div>
</section>

@push('script')
<script>
    (function () {

        document.querySelectorAll('.gt-pw-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.getAttribute('data-target'));
                if (!input) return;
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.classList.toggle('is-on', show);
                btn.setAttribute('aria-pressed', show ? 'true' : 'false');
                btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            });
        });

        var pw = document.getElementById('password');
        var pc = document.getElementById('password_confirmation');
        var bar = document.getElementById('gt-strength');
        var match = document.getElementById('gt-match');

        function strength(v) {
            var s = 0;
            if (v.length >= 8) s++;
            if (/[A-Z]/.test(v) && /[a-z]/.test(v)) s++;
            if (/\d/.test(v)) s++;
            if (/[^A-Za-z0-9]/.test(v)) s++;
            return v.length ? Math.max(1, s) : 0;
        }

        function checkMatch() {
            if (!pc.value) { match.className = 'gt-match'; match.textContent = ''; return; }
            var ok = pc.value === pw.value;
            match.className = 'gt-match ' + (ok ? 'is-ok' : 'is-bad');
            match.textContent = ok ? 'Passwords match ✓' : 'Passwords don\'t match yet';
        }

        if (pw && bar) pw.addEventListener('input', function () { bar.setAttribute('data-level', strength(pw.value)); if (pc) checkMatch(); });
        if (pc && match) pc.addEventListener('input', checkMatch);
    })();
</script>
@endpush
@endsection