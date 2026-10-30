@extends('layouts.frontend.main')

@section('content')

<section id="contacts-page" class="gt-auth">
    <div class="gt-container">
        <div class="gt-auth__shell">

            <!-- LEFT: food panel -->
            <div class="gt-auth__art">
                <a href="{{ URL::to('/') }}" class="gt-auth__logo">
                    <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="Grill and Thrill" />
                </a>

                <div>
                    <h2>Welcome back,<br>hungry?</h2>
                    <p>Sign in to continue with your order.</p>
                </div>

                <ul class="gt-auth__perks">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
                        Quick checkout with saved details
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
                        Track your order status
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
                        See all your past orders
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
                <h1 class="gt-auth__title">Sign in</h1>
                <p class="gt-auth__sub">Good to see you again 👋</p>

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

                <form action="{{ route('basicLogin') }}" method="POST" role="form">
                    @csrf

                    <div class="gt-form-group">
                        <label for="email">E-mail address</label>
                        <div class="gt-input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="gt-form-group">
                        <label for="password">Password</label>
                        <div class="gt-input-wrap gt-input-wrap--pw">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password" placeholder="Your password">
                            <button type="button" class="gt-pw-toggle" data-target="password" aria-label="Show password" aria-pressed="false">
                                <svg class="gt-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg class="gt-eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.9 17.9A10.1 10.1 0 0 1 12 20c-7 0-11-8-11-8a18.5 18.5 0 0 1 5.1-5.9M9.9 4.2A9 9 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.2 3.2M1 1l22 22"/></svg>
                            </button>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label class="gt-check-row" for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>

                    <button type="submit" class="gt-btn gt-btn--brand gt-btn--block">
                        Login
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </button>
                </form>

                <p class="gt-auth__switch">New here? <a href="{{ route('registration') }}">Create an account</a></p>
            </div>

        </div>
    </div>
</section>

@push('script')
<script>

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
</script>
@endpush
@endsection