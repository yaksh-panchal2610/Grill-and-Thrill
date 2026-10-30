@extends('layouts.frontend.main')

@section('content')

<!-- HERO -->
<section class="gt-hero">
    <div class="gt-container gt-hero__grid">

        <div class="gt-hero__copy">
            <span class="gt-pill">
                <span class="gt-pill__dot" aria-hidden="true"></span>
                Open daily · 12:00 PM – 11:00 PM
            </span>

            <h1 class="gt-hero__title">Good time,<br><em>great taste.</em></h1>

            <p class="gt-hero__lead">Discover the real burgers. Big burger, little money — enjoy the food you love from the lowest price, flame-grilled fresh in Gants Hill.</p>

            <div class="gt-hero__actions">
                <a href="#menu-8" class="gt-btn gt-btn--brand">
                    View menu
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M6 13l6 6 6-6"/></svg>
                </a>
                <a href="tel:02085514329" class="gt-btn gt-btn--light">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>
                    020 8551 4329
                </a>
            </div>

            <ul class="gt-hero__facts">
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 2-2 3-3 3 0-3-1-5-3-7-1 4-4 7-4 13 0 4 3 7 7 7z"/></svg>
                    Flame-grilled fresh
                </li>
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="7" width="13" height="10" rx="1"/><path d="M14 10h4l3 3v4h-7z"/><circle cx="6" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>
                    Delivery &amp; collection
                </li>
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Gants Hill, Ilford
                </li>
            </ul>
        </div>

        <div class="gt-hero__media">
            <div class="gt-hero__photo">
                <img src="{{ asset('images/banner/banner-1.jpg') }}" alt="Grill and Thrill burgers" />
            </div>

            <div class="gt-hero__card gt-hero__card--top gt-float">
                <span class="gt-hero__card-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 2-2 3-3 3 0-3-1-5-3-7-1 4-4 7-4 13 0 4 3 7 7 7z"/></svg>
                </span>
                <span><strong>Big burger,</strong><small>little money</small></span>
            </div>

            <div class="gt-hero__card gt-hero__card--bottom">
                <span class="gt-hero__thumbs" aria-hidden="true">
                    <img src="{{ asset('images/banner/banner-2.jpeg') }}" alt="" />
                    <img src="{{ asset('images/banner/banner-3.jpeg') }}" alt="" />
                </span>
                <span><strong>Discover the real burgers</strong><small>Made fresh to order</small></span>
            </div>

            <svg class="gt-hero__burger gt-float" viewBox="0 0 200 200" aria-hidden="true">
                <ellipse cx="100" cy="172" rx="70" ry="8" fill="#000" opacity="0.08"/>
                <path d="M32 140 H168 Q168 166 140 166 H60 Q32 166 32 140 Z" fill="#E08A2C"/>
                <rect x="26" y="116" width="148" height="24" rx="12" fill="#6B3A1E"/>
                <path d="M26 112 H174 L162 130 L150 118 L132 134 L114 118 L94 132 L76 118 L58 130 L42 118 Z" fill="#FFC93C"/>
                <rect x="30" y="102" width="140" height="10" rx="5" fill="#E2513A"/>
                <path d="M24 96 q9 10 19 0 t19 0 t19 0 t19 0 t19 0 t19 0 t19 0 t20 0 v10 H24 z" fill="#6BBF59"/>
                <path d="M30 96 Q30 38 100 38 Q170 38 170 96 Z" fill="#F2A33A"/>
                <path d="M48 70 Q60 50 90 46" stroke="#FFD08A" stroke-width="6" stroke-linecap="round" fill="none"/>
                <ellipse cx="76" cy="62" rx="4" ry="2.6" fill="#FFF3D6" transform="rotate(-20 76 62)"/>
                <ellipse cx="102" cy="54" rx="4" ry="2.6" fill="#FFF3D6"/>
                <ellipse cx="126" cy="64" rx="4" ry="2.6" fill="#FFF3D6" transform="rotate(20 126 64)"/>
                <ellipse cx="92" cy="76" rx="4" ry="2.6" fill="#FFF3D6" transform="rotate(10 92 76)"/>
                <ellipse cx="144" cy="82" rx="4" ry="2.6" fill="#FFF3D6" transform="rotate(30 144 82)"/>
                <ellipse cx="60" cy="84" rx="4" ry="2.6" fill="#FFF3D6" transform="rotate(-30 60 84)"/>
            </svg>
        </div>

    </div>
</section>

<!-- MENU -->
<section id="menu-8" class="gt-menu-section">

    <div class="gt-container">
        <div class="gt-section-head gt-reveal">
            <span class="gt-eyebrow">Our menu</span>
            <h2>What are you craving?</h2>
            <p>Tap any dish to choose your size, sides and sauces.</p>
        </div>
    </div>

    <!-- TABS NAVIGATION -->
    <div id="tabs-nav" class="gt-tabs">
        <div class="gt-container">
            <ul class="tabs-1 gt-tabs__list" role="tablist" aria-label="Menu categories">
                @php($i = 1)
                @foreach($categories as $category)
                <li id="tab-btn-{{$i}}" class="tab-link @if($i == 1) current @endif" data-tab="tab-{{$i}}" role="tab" tabindex="0" aria-controls="tab-{{$i}}" aria-selected="{{ $i == 1 ? 'true' : 'false' }}">
                    <span class="gt-tabs__img"><img src="{{ asset('images/category/') }}/{{ $category->image }}" width="40" height="40" alt="" /></span>
                    <span class="gt-tabs__name">{{ $category->name }}</span>
                </li>
                @php($i++)
                @endforeach
            </ul>
        </div>
    </div>
    <!-- END TABS NAVIGATION -->

    <!-- TABS CONTENT -->
    <div class="gt-container">
        <div id="tabs-content">

            @php($i = 1)
            @foreach($categories as $category)
            <div id="tab-{{$i}}" class="tab-content @if($i == 1) current @endif" role="tabpanel" aria-labelledby="tab-btn-{{$i}}">
                <div class="row gt-grid">
                    @foreach($category->category_products as $product)
                    @if($product->status == 'active')

                    @php($minVal = 999)
                    @foreach($product->product_variations as $variation)
                    @if($variation->price < $minVal)
                    @php($minVal = $variation->price)
                    @endif
                    @endforeach

                    <!-- MENU ITEM -->
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <article class="gt-card" style="--i: {{ min($loop->index, 11) }}">

                            <div class="gt-card__media">
                                <img src="{{ asset('images/product') }}/{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" />
                            </div>

                            <div class="gt-card__body">
                                <h3 class="gt-card__title">{{ $product->name }}</h3>
                                <p class="gt-card__desc">{{ $product->details }}</p>

                                <div class="gt-card__foot">
                                    <span class="gt-card__price">
                                        @if(count($product->product_variations) > 1)
                                        <small>From</small>
                                        @endif
                                        <strong>£{{ number_format($minVal, 2) }}</strong>
                                    </span>
                                    <button type="button" class="gt-add details-button" data-toggle="modal" data-target="#productModal{{ $product->id }}" aria-label="Choose options for {{ $product->name }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                                        Add
                                    </button>
                                </div>
                            </div>

                        </article>
                    </div>
                    <!-- END MENU ITEM -->

                    <!-- MENU ITEM MODAL -->
                    <div class="modal fade gt-modal" id="productModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" id="cart-form-{{ $product->id }}" class="cart-modal" action="{{ URL::to('add-to-cart') }}/{{ $product->id }}" data-product-id="{{ $product->id }}">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header modal-header--sticky">
                                        <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="gt-modal__hero modal-product-image">
                                            <img src="{{ asset('images/product') }}/{{ $product->image }}" alt="{{ $product->name }}" />
                                            @if($product->details)
                                            <p>{{ $product->details }}</p>
                                            @endif
                                        </div>

                                        <div class="errorandsuccess" id="errorandsuccess-{{ $product->id }}"></div>

                                        <div class="item-section">
                                            <fieldset>
                                                <legend>Choose a variation <span class="gt-hint gt-hint--req">Required</span></legend>
                                                <div class="errorandsuccess_variation"></div>
                                                @foreach($product->product_variations as $variation)
                                                <div class="radio-input-group">
                                                    <label class="radio-input-label" for="variation_id_{{ $variation->id }}">
                                                        <input class="variation-radio-{{ $product->id }}" type="radio" name="variation" id="variation_id_{{ $variation->id }}" data-price="{{ $variation->price }}" onclick="variationSelected({{ $product->id }},'{{ $variation->type }}')" value="{{ $variation->name }}">
                                                        <span class="gt-opt__name">{{ $variation->name }}</span>
                                                        <span class="label-right-portion">£{{ number_format($variation->price, 2) }}</span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </fieldset>
                                        </div>

                                        @if(count($product->product_flavours) > 0)
                                        <div class="item-section">
                                            <fieldset>
                                                <legend>Choose a flavour <span class="gt-hint">Pick 1</span></legend>
                                                <div class="errorandsuccess_flavour"></div>
                                                @foreach($product->product_flavours as $flavour)
                                                <div class="radio-input-group">
                                                    <label class="radio-input-label" for="flavour_id_{{ $flavour->id }}">
                                                        <input type="radio" name="flavour" id="flavour_id_{{ $flavour->id }}" value="{{ $flavour->name }}">
                                                        <span class="gt-opt__name">{{ $flavour->name }}</span>
                                                        <span class="label-right-portion"></span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                        @endif

                                        @if(count($product->product_sides) > 0)
                                        <div class="item-section">
                                            <fieldset>
                                                <legend>Choose a side <span class="gt-hint">Pick 1</span></legend>
                                                <div class="errorandsuccess_side"></div>
                                                @foreach($product->product_sides as $side)
                                                <div class="radio-input-group">
                                                    <label class="radio-input-label" for="side_id_{{ $side->id }}">
                                                        <input type="radio" name="side" id="side_id_{{ $side->id }}" value="{{ $side->name }}">
                                                        <span class="gt-opt__name">{{ $side->name }}</span>
                                                        <span class="label-right-portion"></span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                        @endif

                                        @if(count($product->product_sauces) > 0)
                                        <div class="item-section">
                                            <fieldset>
                                                <legend>Choose a sauce <span class="gt-hint">Pick 1</span></legend>
                                                <div class="errorandsuccess_sauce"></div>
                                                @foreach($product->product_sauces as $sauce)
                                                <div class="radio-input-group">
                                                    <label class="radio-input-label" for="sauce_id_{{ $sauce->id }}">
                                                        <input type="radio" name="sauce" id="sauce_id_{{ $sauce->id }}" value="{{ $sauce->name }}">
                                                        <span class="gt-opt__name">{{ $sauce->name }}</span>
                                                        <span class="label-right-portion"></span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                        @endif

                                        @if(count($product->product_drinks) > 0)
                                        <div class="item-section" id="drink-section-{{ $product->id }}" style="display:none;">
                                            <fieldset>
                                                <legend>Choose a drink <span class="gt-hint">Pick 1</span></legend>
                                                <div class="errorandsuccess_drink"></div>
                                                @foreach($product->product_drinks as $drink)
                                                <div class="radio-input-group">
                                                    <label class="radio-input-label" for="drink_id_{{ $drink->id }}">
                                                        <input type="radio" name="drink" id="drink_id_{{ $drink->id }}" value="{{ $drink->name }}">
                                                        <span class="gt-opt__name">{{ $drink->name }}</span>
                                                        <span class="label-right-portion"></span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                        @endif

                                        @if(count($product->product_removables) > 0)
                                        <div class="item-section">
                                            <fieldset>
                                                <legend>Remove anything? <span class="gt-hint">Optional</span></legend>
                                                <div class="errorandsuccess_removable"></div>
                                                @foreach($product->product_removables as $removable)
                                                <div class="radio-input-group">
                                                    <label class="radio-input-label" for="removable_id_{{ $removable->id }}">
                                                        <input type="checkbox" name="removables[]" id="removable_id_{{ $removable->id }}" value="{{ $removable->name }}">
                                                        <span class="gt-opt__name">{{ $removable->name }}</span>
                                                        <span class="label-right-portion"></span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </fieldset>
                                        </div>
                                        @endif

                                        <input type="hidden" id="quantity-{{ $product->id }}" name="quantity" value="1">
                                    </div>

                                    <div class="modal-footer modal-footer--sticky">
                                        <div class="gt-qty" id="quantitySelector-{{ $product->id }}" style="display:none;">
                                            <button type="button" class="gt-qty__btn" onclick="decreaseQuantity({{ $product->id }})" aria-label="Decrease quantity">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14"/></svg>
                                            </button>
                                            <span class="gt-qty__val" id="quantity-show-{{ $product->id }}" aria-live="polite">1</span>
                                            <button type="button" class="gt-qty__btn" onclick="increaseQuantity({{ $product->id }})" aria-label="Increase quantity">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                                            </button>
                                        </div>
                                        <button type="submit" class="gt-submit">
                                            <span>Add to cart</span>
                                            <span id="total-product-cost-{{ $product->id }}">£<span id="total-product-cost-value-{{ $product->id }}">0</span></span>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END MENU ITEM MODAL -->

                    @endif
                    @endforeach
                </div>
            </div>
            @php($i++)
            @endforeach

        </div>
    </div>
    <!-- END TABS CONTENT -->

</section>

@push('script')
<script>
    function increaseQuantity(productId) {
        var quantityElement = $("#quantity-" + productId);
        var quantity = parseInt(quantityElement.val());
        quantityElement.val(quantity + 1);

        var price = $(".variation-radio-" + productId + ":checked ").data("price");
        var postQuantity = parseInt(quantityElement.val());
        var total = postQuantity * price;
        $('#total-product-cost-value-' + productId).html(total.toFixed(2));
        $('#quantity-show-' + productId).html(postQuantity);
    }

    function decreaseQuantity(productId) {
        var quantityElement = $("#quantity-" + productId);
        var quantity = parseInt(quantityElement.val());
        if (quantity > 1) {
            quantityElement.val(quantity - 1);

            var price = $(".variation-radio-" + productId + ":checked ").data("price");
            var postQuantity = parseInt(quantityElement.val());
            var total = postQuantity * price;
            $('#total-product-cost-value-' + productId).html(total.toFixed(2));
            $('#quantity-show-' + productId).html(postQuantity);
        }
    }

    function variationSelected(productId, type) {
        $('#quantitySelector-' + productId).show();
        var quantityElement = $("#quantity-" + productId);
        var quantity = parseInt(quantityElement.val());

        var price = $(".variation-radio-" + productId + ":checked ").data("price");
        var total = quantity * price;
        $('#total-product-cost-value-' + productId).html(total.toFixed(2));

        if (type == 'regular') {
            $("#drink-section-" + productId).hide('slow');
            $("#drink-section-" + productId).find(':radio').prop('checked', false);
        } else {
            $("#drink-section-" + productId).show('slow');
        }
    }

    $(".details-button").on('click', function(e) {
        $(".errorandsuccess").html("");
        $(".errorandsuccess_variation").html("");
        $(".errorandsuccess_flavour").html("");
        $(".errorandsuccess_side").html("");
        $(".errorandsuccess_sauce").html("");
        $(".errorandsuccess_drink").html("");
    });

    $(".cart-modal").on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(xhr, formProductId) {
                $('.form-group').removeClass('has-error');
                $(".errorandsuccess").html("");
                $(".errorandsuccess_variation").html("");
                $(".errorandsuccess_flavour").html("");
                $(".errorandsuccess_side").html("");
                $(".errorandsuccess_sauce").html("");
                $(".errorandsuccess_drink").html("");
            },

            success: function(response) {
                if (response.success == true) {
                    $("#cart-form-" + response.id)[0].reset();
                    $("#cart-itme").text(response.cqty);
                    $('.close').trigger('click');

                    $('#quantitySelector-' + response.id).hide();
                    var quantityElement = $("#quantity-" + response.id);
                    quantityElement.val(1);
                    $('#quantity-show-' + response.id).html(1);

                    if (window.gtToast) { window.gtToast('Added to your bag 🔥'); }
                }
            },
            error: function(xhr, status, error) {
                var count = 0;
                $.each(xhr.responseJSON.errors, function(key, item) {
                    $(".errorandsuccess_" + key).html("<div class='alert alert-danger' role='alert'>" + item + "</div>");
                    if (count == 0) {
                        $(".errorandsuccess").html("<div class='alert alert-danger' role='alert'>Please select all required fields.</div>");
                        $(".modal").animate({
                            scrollTop: 0
                        }, 'slow');
                        count++;
                    }
                });
            }
        })
    });
</script>

<script>
    (function () {
        var root    = document.documentElement;
        var header  = document.getElementById('gt-header');
        var bar     = document.getElementById('tabs-nav');
        var list    = bar ? bar.querySelector('.tabs-1') : null;
        var content = document.getElementById('tabs-content');

        // 1) Keep the sticky tabs right under the sticky header
        function setHeaderH() {
            if (header) root.style.setProperty('--gt-header-h', header.offsetHeight + 'px');
        }
        setHeaderH();
        window.addEventListener('resize', setHeaderH);
        if (window.ResizeObserver && header) new ResizeObserver(setHeaderH).observe(header);

        // 2) Shadow on tabs bar when it is stuck
        function onScroll() {
            if (!bar || !header) return;
            bar.classList.toggle('is-stuck', bar.getBoundingClientRect().top <= header.offsetHeight + 1);
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        if (!list) return;
        var tabs = list.querySelectorAll('.tab-link');

        // 3) Keyboard support + aria + centre the active pill
        tabs.forEach(function (tab) {
            tab.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); $(tab).trigger('click'); }
            });

            tab.addEventListener('click', function () {
                setTimeout(function () {
                    tabs.forEach(function (t) {
                        t.setAttribute('aria-selected', t.classList.contains('current') ? 'true' : 'false');
                    });
                }, 0);

                list.scrollTo({ left: tab.offsetLeft - (list.clientWidth - tab.offsetWidth) / 2, behavior: 'smooth' });

                if (content && header) {
                    var offset = header.offsetHeight + bar.offsetHeight + 8;
                    var top = content.getBoundingClientRect().top;
                    if (top < offset) window.scrollTo({ top: window.pageYOffset + top - offset, behavior: 'smooth' });
                }
            });
        });
    })();
</script>
@endpush
@endsection