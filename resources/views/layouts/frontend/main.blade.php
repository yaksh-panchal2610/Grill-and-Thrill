<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://consent.cookiefirst.com/sites/staging.grillandthrills.co.uk-ade71465-0275-4610-811f-6871a967d56a/consent.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Saiful Akhter" />
    <meta name="description" content="Grill and Thrill Restaurant" />
    <meta name="keywords" content="Food, Fast Food, Restaurant, Restaurant Menu, Pizza, Burger, Grill, Snack">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#FFFBF5">

    <title>Grill and Thrill</title>

    <link rel="shortcut icon" href="{{ asset('testo/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('testo/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('testo/images/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('testo/images/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('testo/images/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('testo/images/apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="{{ asset('testo/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.11.0/css/all.css" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('testo/css/flaticon.css') }}" rel="stylesheet">

    <link href="{{ asset('testo/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('testo/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('testo/css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('testo/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('testo/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('testo/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('testo/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('testo/css/responsive.css') }}" rel="stylesheet">

    <link href="{{ asset('css/grill-ui.css') }}?v=1" rel="stylesheet">

    @stack('style')
</head>

<body class="gt-ui">
    <!-- PRELOADER -->
    <div id="loader-wrapper">
        <div id="loader">
            <div class="gt-loader">
                <span class="gt-loader__icon">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 2-2 3-3 3 0-3-1-5-3-7-1 4-4 7-4 13 0 4 3 7 7 7z"/></svg>
                </span>
                <span class="gt-loader__text">Firing up the grill…</span>
            </div>
            <div class="cssload-spinner">
                <div class="cssload-ball cssload-ball-1"></div>
                <div class="cssload-ball cssload-ball-2"></div>
                <div class="cssload-ball cssload-ball-3"></div>
                <div class="cssload-ball cssload-ball-4"></div>
            </div>
        </div>
    </div>

    @include('layouts/frontend/partial/header')

    <div id="page" class="page">
        @yield('content')

        @include('layouts/frontend/partial/footer')
    </div>

    <div id="gt-toast" class="gt-toast" role="status" aria-live="polite"></div>

    <script src="{{ asset('testo/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('testo/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('testo/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.scrollto.js') }}"></script>
    <script src="{{ asset('testo/js/menu.js') }}"></script>
    <script src="{{ asset('testo/js/materialize.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('testo/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('testo/js/contact-form.js') }}"></script>
    <script src="{{ asset('testo/js/comment-form.js') }}"></script>
    <script src="{{ asset('testo/js/booking-form.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('testo/js/jquery.ajaxchimp.min.js') }}"></script>

    <script src="{{ asset('testo/js/custom.js') }}"></script>

    <script>
        (function($) {
            'use strict';

            $(window).scroll(function() {
                if ($('header').offset().top > 10) {
                    $('.top-header').addClass('hide');
                    $('body').addClass('gt-scrolled');
                } else {
                    $('.top-header').removeClass('hide');
                    $('body').removeClass('gt-scrolled');
                }
            });

        })(jQuery);

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.modalclose').on('click', function() {
                $('.modal-backdrop').hide();
                $('body').removeClass("modal-backdrop fade show");
                $('.modal').modal('hide');
            });

        });

        (function() {
            var items = document.querySelectorAll('.gt-reveal');
            if (!('IntersectionObserver' in window)) {
                items.forEach(function(el) { el.classList.add('is-in'); });
                return;
            }
            var io = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-in');
                        io.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });
            items.forEach(function(el) { io.observe(el); });
        })();

        window.gtToast = function(message) {
            var t = document.getElementById('gt-toast');
            if (!t) return;
            t.textContent = message;
            t.classList.add('is-on');
            clearTimeout(window.__gtToastTimer);
            window.__gtToastTimer = setTimeout(function() { t.classList.remove('is-on'); }, 1800);
        };
    </script>
    @stack('script')
</body>

</html>