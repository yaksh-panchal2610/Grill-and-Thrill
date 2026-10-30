@extends('layouts.frontend.main')

@section('content')

<!-- PAGE HEADER -->
<section class="gt-page-head">
    <div class="gt-container">
        <nav aria-label="breadcrumb">
            <ol class="gt-crumbs">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li aria-current="page">About Us</li>
            </ol>
        </nav>
        <h1 class="gt-page-head__title">About Grill and Thrill</h1>
        <p class="gt-page-head__sub">Our story, our food and where we're heading.</p>
    </div>
</section>

<!-- STORY -->
<section id="about-3" class="gt-about">
    <div class="gt-container gt-about__grid">

        <div class="gt-about__copy gt-reveal">
            <span class="gt-eyebrow">Our story</span>
            <h2 class="gt-about__lead">Not just a grill restaurant — a <em>thrilling</em> grilling experience.</h2>

            <p>Grill and Thrill is not only a grill restaurant, it's a perfect grilling experience in a thrilling way. Our aim is to bring back a premium dining experience around the Gants Hill area. Our unique style, high-quality, great-tasting and affordable food will definitely deliver you an exceptional dining experience.</p>

            <p>Our expert team is committed to serving you with premium ingredients, unique recipes and a family-friendly dining experience which you may have never experienced before around this area. Our vision is to develop and franchise our brand all over the country.</p>

            <ul class="gt-about__stats">
                <li><strong>7 days</strong><small>Open every day</small></li>
                <li><strong>12–11 PM</strong><small>Opening hours</small></li>
                <li><strong>Gants Hill</strong><small>Ilford IG2 6JX</small></li>
            </ul>
        </div>

        <div class="gt-collage gt-reveal">
            <figure><img src="{{ asset('images/banner/banner-1.jpg') }}" alt="Grill and Thrill burgers" loading="lazy" /></figure>
            <figure><img src="{{ asset('images/banner/banner-2.jpeg') }}" alt="Freshly grilled food" loading="lazy" /></figure>
            <figure><img src="{{ asset('images/banner/banner-3.jpeg') }}" alt="Burger and sides" loading="lazy" /></figure>
            <span class="gt-collage__badge">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 2-2 3-3 3 0-3-1-5-3-7-1 4-4 7-4 13 0 4 3 7 7 7z"/></svg>
                Proudly grilling in Gants Hill
            </span>
        </div>

    </div>
</section>

<!-- VALUES -->
<section class="gt-values">
    <div class="gt-container">
        <div class="gt-section-head gt-reveal">
            <span class="gt-eyebrow">What we stand for</span>
            <h2>Why people love us</h2>
        </div>

        <div class="gt-values__grid">
            <div class="gt-value gt-reveal">
                <span class="gt-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.5 19 2c1 2 2 4.2 2 8 0 5.5-4.8 10-10 10z"/><path d="M2 21c0-3 1.9-5.4 5.1-6"/></svg>
                </span>
                <div>
                    <h3>Premium ingredients</h3>
                    <p>High-quality, fresh produce in every single order.</p>
                </div>
            </div>
            <div class="gt-value gt-reveal">
                <span class="gt-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 2-2 3-3 3 0-3-1-5-3-7-1 4-4 7-4 13 0 4 3 7 7 7z"/></svg>
                </span>
                <div>
                    <h3>Unique recipes</h3>
                    <p>Our own style of grilling you won't find anywhere else.</p>
                </div>
            </div>
            <div class="gt-value gt-reveal">
                <span class="gt-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/></svg>
                </span>
                <div>
                    <h3>Family-friendly</h3>
                    <p>A welcoming place for friends, families and everyone.</p>
                </div>
            </div>
            <div class="gt-value gt-reveal">
                <span class="gt-value__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 7c0-2.2-2-4-4.5-4S9 4.8 9 7v4M6 11h9M7 21h11M9 11c0 4-1 7-2 10"/></svg>
                </span>
                <div>
                    <h3>Affordable prices</h3>
                    <p>Great-tasting food that's easy on your pocket.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISION -->
<section class="gt-vision">
    <div class="gt-container">
        <div class="gt-vision__card gt-reveal">
            <div class="gt-vision__text">
                <span class="gt-eyebrow">Our vision</span>
                <h2>To grow Grill and Thrill and franchise our brand all over the country.</h2>
            </div>
            <a href="{{ URL::to('/') }}#menu-8" class="gt-btn gt-btn--brand">
                Order now
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
    </div>
</section>

@endsection