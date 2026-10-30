<!-- CTA BAND -->
<section class="gt-cta gt-reveal">
    <div class="gt-container">
        <div class="gt-cta__card">
            <div class="gt-cta__text">
                <span class="gt-cta__eyebrow">Hungry?</span>
                <h2 class="gt-cta__title">Hot food is only a few taps away.</h2>
                <p>Flame-grilled and made to order. Delivery or collection from Gants Hill.</p>
            </div>
            <div class="gt-cta__actions">
                <a href="{{ URL::to('/') }}" class="gt-btn gt-btn--brand">
                    Order now
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <a href="tel:02085514329" class="gt-btn gt-btn--ghost">Call 020 8551 4329</a>
            </div>
            <span class="gt-cta__flame gt-float" aria-hidden="true">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 2-2 3-3 3 0-3-1-5-3-7-1 4-4 7-4 13 0 4 3 7 7 7z"/></svg>
            </span>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer id="footer-4" class="gt-footer">
    <div class="gt-container">

        <div class="gt-footer__grid">

            <!-- Brand -->
            <div class="gt-footer__brand">
                <a href="{{ URL::to('/') }}" class="gt-footer__logo">
                    <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="Grill and Thrill" />
                </a>
                <p>Surf the site and get the best prices. Burgers, wraps, wings and more — grilled fresh every day.</p>
                <div class="gt-social">
                    <a href="https://www.facebook.com/profile.php?id=100077488123054" target="_blank" rel="noopener" aria-label="Facebook">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H8v4h2v8h4v-8h3l1-4h-4V8z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@grillandthrill?_t=8eG0J0HKx46&_r=1" target="_blank" rel="noopener" aria-label="TikTok">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.6 3c.4 2.2 1.8 3.7 4 4v3.2c-1.5 0-2.9-.4-4-1.2v6.6A5.8 5.8 0 1 1 10.8 10v3.3a2.6 2.6 0 1 0 2.6 2.6V3h3.2z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Visit -->
            <div class="gt-footer__col">
                <h5>Visit us</h5>
                <a class="gt-footer__line" href="https://www.google.com/maps/search/?api=1&query=18+Seven+Ways+Parade+Gants+Hill+Ilford+IG2+6JX" target="_blank" rel="noopener">
                    18, Seven Ways Parade,<br>Gants Hill, Ilford IG2 6JX
                </a>
                <a class="gt-footer__link" href="https://www.google.com/maps/search/?api=1&query=18+Seven+Ways+Parade+Gants+Hill+Ilford+IG2+6JX" target="_blank" rel="noopener">Get directions →</a>
            </div>

            <!-- Contact -->
            <div class="gt-footer__col">
                <h5>Order now</h5>
                <a class="gt-footer__line" href="tel:02085514329">020 8551 4329</a>
                <a class="gt-footer__line" href="mailto:grillandthrill2020@gmail.com">grillandthrill2020@gmail.com</a>
            </div>

            <!-- Hours -->
            <div class="gt-footer__col">
                <h5>Working hours</h5>
                <p class="gt-footer__line">Open daily<br><strong>12:00 PM – 11:00 PM</strong></p>
                <span id="gt-open-badge" class="gt-open-badge" hidden></span>
            </div>

        </div>

        <!-- Bottom -->
        <div class="gt-footer__bottom">
            <p>&copy; {{ date('Y') }} Grill and Thrill. All Rights Reserved</p>
            <nav class="gt-footer__legal" aria-label="Legal">
                <a href="{{ asset('Privacy policy.pdf') }}" target="_blank" rel="noopener">Privacy Policy</a>
                <a href="{{ asset('Website terms and conditions.pdf') }}" target="_blank" rel="noopener">Terms and Conditions</a>
            </nav>
        </div>

    </div>
</footer>

<script>
    (function () {
        var badge = document.getElementById('gt-open-badge');
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