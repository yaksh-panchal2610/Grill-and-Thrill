
<header id="gt-header" class="gt-header">

  <div class="top-header gt-topbar">
    <div class="gt-container gt-topbar__inner">
      <a class="gt-topbar__item" href="tel:02085514329">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>
        <span>020 8551 4329</span>
      </a>
      <a class="gt-topbar__item" href="https://www.google.com/maps/search/?api=1&query=18+Seven+Ways+Parade+Gants+Hill+Ilford+IG2+6JX" target="_blank" rel="noopener">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
        <span>18 Seven Ways Parade, Gants Hill, Ilford IG2 6JX</span>
      </a>
      <span class="gt-topbar__note">Order online · Delivery &amp; collection</span>
    </div>
  </div>

  <div class="gt-nav">
    <div class="gt-container gt-nav__inner">

      <a class="gt-logo" href="{{ URL::to('/') }}">
        <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="Grill and Thrill" />
      </a>

      <nav id="gt-menu" class="gt-menu" aria-label="Main">
        <a href="{{ URL::to('/') }}" class="{{ request()->is('/') ? 'is-active' : '' }}">Home</a>
        <a href="{{ URL::to('about-us') }}" class="{{ request()->is('about-us') ? 'is-active' : '' }}">About Us</a>
        @if(!empty(session()->get('customer')))
        <a href="{{ URL::to('customer/dashboard') }}" class="{{ request()->is('customer/*') ? 'is-active' : '' }}">Dashboard</a>
        @endif
        <a href="{{ URL::to('contact-us') }}" class="{{ request()->is('contact-us') ? 'is-active' : '' }}">Contact Us</a>

        @if(!empty(session()->get('customer')))
        <a href="{{ URL::to('customerLogout') }}" class="gt-menu__mobile-only">Log out</a>
        @else
        <a href="{{ URL::to('customer/login') }}" class="gt-menu__mobile-only">Login</a>
        @endif
      </nav>

      <div class="gt-actions">
        @if(!empty(session()->get('customer')))
        <a href="{{ URL::to('customerLogout') }}" class="gt-icon-btn gt-hide-mobile" aria-label="Log out" title="Log out">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
        </a>
        @else
        <a href="{{ URL::to('customer/login') }}" class="gt-login gt-hide-mobile">Login</a>
        @endif

        <a href="tel:02085514329" class="gt-icon-btn gt-only-mobile" aria-label="Call us">
          <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>
        </a>

        <a href="{{ route('cart.index') }}" class="gt-cart" aria-label="View your bag">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 8h14l-1 12H6z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
          <span class="gt-cart__label">Bag</span>
          <em id="cart-itme" class="roundpoint gt-cart__count">{{ Cart::getContent()->count() }}</em>
        </a>

        <button type="button" class="gt-burger" aria-label="Open menu" aria-controls="gt-menu" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>

    </div>
  </div>
</header>

<script>
  (function () {

    var header = document.getElementById('gt-header');
    var burger = header.querySelector('.gt-burger');
    burger.addEventListener('click', function () {
      var open = header.classList.toggle('is-menu-open');
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
      burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    });

    var count = document.getElementById('cart-itme');
    if (count && 'MutationObserver' in window) {
      var last = count.textContent.trim();
      new MutationObserver(function () {
        var now = count.textContent.trim();
        if (now === last) return;
        last = now;
        count.classList.remove('is-bump');
        void count.offsetWidth;
        count.classList.add('is-bump');
      }).observe(count, { childList: true, characterData: true, subtree: true });
    }
  })();
</script>