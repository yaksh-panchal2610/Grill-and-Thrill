@extends('layouts.frontend.main')

@section('content')

<!-- PAGE HEADER -->
<section class="gt-page-head">
    <div class="gt-container">
        <nav aria-label="breadcrumb">
            <ol class="gt-crumbs">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li aria-current="page">Contact Us</li>
            </ol>
        </nav>
        <h1 class="gt-page-head__title">Contact Us</h1>
        <p class="gt-page-head__sub">Questions, feedback or a big order? We'd love to hear from you.</p>
    </div>
</section>

<!-- CONTACT -->
<section id="contacts-5" class="gt-contact">
    <div class="gt-container">

        <div class="gt-contact__grid">

            <!-- Location -->
            <a class="gt-contact-card gt-reveal" href="https://www.google.com/maps/search/?api=1&query=18+Seven+Ways+Parade+Gants+Hill+Ilford+IG2+6JX" target="_blank" rel="noopener">
                <span class="gt-contact-card__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </span>
                <div class="gt-contact-card__body">
                    <h2>Location</h2>
                    <p>18, Seven Ways Parade,<br>Gants Hill, Ilford IG2 6JX<br>United Kingdom</p>
                    <span class="gt-contact-card__cta">
                        Get directions
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </span>
                </div>
            </a>

            <!-- Hours -->
            <div class="gt-contact-card gt-reveal">
                <span class="gt-contact-card__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </span>
                <div class="gt-contact-card__body">
                    <h2>Working hours</h2>
                    <p>Open daily<br>12:00 PM – 11:00 PM</p>
                    <span id="gt-open-badge-contact" class="gt-open-badge" hidden></span>
                </div>
            </div>

            <!-- Phone & email -->
            <div class="gt-contact-card gt-reveal">
                <span class="gt-contact-card__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>
                </span>
                <div class="gt-contact-card__body">
                    <h2>Phone and email</h2>
                    <p class="gt-contact__links">
                        <a href="tel:02085514329">020 8551 4329</a>
                        <a href="mailto:grillandthrill2020@gmail.com">grillandthrill2020@gmail.com</a>
                    </p>
                </div>
            </div>

        </div>

        <!-- MAP -->
        <div id="gmap" class="gt-map gt-reveal">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2479.5112854051904!2d0.06382827592962481!3d51.57719217182928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a7e6bfd1683d%3A0x52e228ea41617fb3!2sGrill%20and%20Thrill!5e0!3m2!1sen!2suk!4v1682451149051!5m2!1sen!2suk" title="Grill and Thrill on Google Maps" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <div class="gt-map__chip">
                <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="" />
                <span>
                    <strong>Grill and Thrill</strong>
                    <a href="https://www.google.com/maps/search/?api=1&query=18+Seven+Ways+Parade+Gants+Hill+Ilford+IG2+6JX" target="_blank" rel="noopener">Get directions →</a>
                </span>
            </div>
        </div>

    </div>
</section>

@push('script')
<script>
    (function () {
        var badge = document.getElementById('gt-open-badge-contact');
        if (!badge || !window.Intl) return;
        try {
            var hour = parseInt(new Intl.DateTimeFormat('en-GB', {
                hour: 'numeric', hourCycle: 'h23', timeZone: 'Europe/London'
            }).format(new Date()), 10);
            var open = hour >= 12 && hour < 23;
            badge.textContent = open ? 'Open now' : 'Closed now · opens 12 PM';
            badge.classList.add(open ? 'is-open' : 'is-closed');
            badge.hidden = false;
        } catch (e) {}
    })();
</script>
@endpush
@endsection