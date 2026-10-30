@extends('layouts.admin.main')

@section('content')

@php
    $gtMin = $productData->product_variations->min('price') ?? 0;
    $gtMany = count($productData->product_variations) > 1;
@endphp

<section class="content-header">
    <h1>
        Product
        <small>Edit #{{ $productData->id }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('product') }}">Product list</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php if (Session::get('success_message') != "") { ?>
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ Session::get('success_message') }}
        </div>
    <?php } ?>

    <div class="gt-form-grid">

        <!-- LEFT: all section forms -->
        <div class="gt-edit-col">

            <!-- 1. BASICS -->
            <form method="post" id="countryform" action="{{ URL::to('product') }}/{{ $productData->id }}" class="gt-anchor" data-anchor="basics">
                @csrf
                @method('PUT')
                <div class="box gt-form-card" id="sec-basics">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="gt-fsec__num">1</span> Basics</h3>
                    </div>
                    <div id="errorandsuccess" style="margin: 16px 22px 0;"></div>

                    <div class="gt-fsec">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $productData->name }}" placeholder="e.g. Smash Burger">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control select2" style="width: 100%;">
                                <option value="">Please select a category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($productData->category == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea name="details" id="details" class="form-control" rows="3" placeholder="Enter a product description">{{ $productData->details }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="gt-drop" id="gt-drop">
                                <input type="file" name="image" id="image" accept="image/*">
                                <span class="gt-drop__preview" id="gt-drop-preview">
                                    <img src="{{ URL::to('/') }}/images/product/{{ $productData->image }}" alt="Current image">
                                </span>
                                <span class="gt-drop__text">
                                    <strong>Click or drag to replace the photo</strong>
                                    <small>Leave empty to keep the current image</small>
                                    <span class="gt-drop__file" id="gt-drop-file"></span>
                                </span>
                            </div>
                            <p class="help-block">Please upload an image here.</p>
                        </div>

                        <div class="form-group">
                            <label style="display:block;">Status</label>
                            <div class="gt-switch" role="radiogroup" aria-label="Status">
                                <label>
                                    <input type="radio" name="status" value="active" @if($productData->status == 'active') checked @endif>
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Active
                                </label>
                                <label>
                                    <input type="radio" name="status" value="inactive" @if($productData->status == 'inactive') checked @endif>
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i> Inactive
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::to('product') }}" class="gt-btn gt-btn--soft">Back to list</a>
                        <button type="submit" class="gt-btn gt-btn--brand submitbutton">
                            <i class="fa fa-check" aria-hidden="true"></i> Save basics
                        </button>
                    </div>
                </div>
            </form>

            <!-- 2. VARIATIONS -->
            <form method="post" id="productVariationForm" action="{{ URL::to('product-variation-update') }}/{{ $productData->id }}" class="gt-anchor">
                @csrf
                <div class="box gt-form-card" id="sec-prices">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="gt-fsec__num">2</span> Sizes &amp; prices</h3>
                    </div>
                    <div class="gt-fsec">
                        <div id="errorandsuccess_variation"></div>

                        <div class="gt-var-head" aria-hidden="true">
                            <span>Type</span><span>Name</span><span>Price</span><span></span>
                        </div>

                        <div id="price_modify">
                            @php($i = 1)
                            @foreach($productData->product_variations as $variation)
                            <div class="form-group gt-var-row">
                                <select class="form-control" name="variation_type[]" required="required" aria-label="Variation type">
                                    <option value="regular" @if($variation->type == 'regular') selected @endif>Regular</option>
                                    <option value="meal" @if($variation->type == 'meal') selected @endif>Meal</option>
                                </select>
                                <input type="text" class="form-control" name="variation_name[]" value="{{ $variation->name }}" placeholder="Variation name" autocomplete="off" aria-label="Variation name" />
                                <span class="gt-money"><input type="number" class="form-control" name="variation_price[]" value="{{ $variation->price }}" placeholder="0.00" autocomplete="off" step="0.01" aria-label="Variation price" /></span>
                                @if($i == 1)
                                <span class="gt-row-lock" title="At least one price is needed"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                @else
                                <button class="gt-row-x" title="Remove" type="button" onclick="removePrice(this)"><i class="fa fa-times" aria-hidden="true"></i></button>
                                @endif
                            </div>
                            @php($i++)
                            @endforeach
                        </div>

                        <button class="gt-add-row" type="button" onclick="addMorePrice()" style="margin-top: 4px;">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add variation
                        </button>
                    </div>
                    <div class="box-footer gt-foot-sm">
                        <button type="submit" id="submitbutton" class="gt-btn gt-btn--brand submitbutton">
                            <i class="fa fa-check" aria-hidden="true"></i> Save sizes &amp; prices
                        </button>
                    </div>
                </div>
            </form>

            <!-- 3. REMOVABLES -->
            <form method="post" id="productRemovableForm" action="{{ URL::to('product-removable-update') }}/{{ $productData->id }}" class="gt-anchor">
                @csrf
                <div class="box gt-form-card" id="sec-remove">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="gt-fsec__num">3</span> Remove options</h3>
                    </div>
                    <div class="gt-fsec">
                        <div id="errorandsuccess_removable"></div>
                        <p class="help-block" style="margin-top: 0;">Things customers can ask to leave out, e.g. Onion.</p>

                        <div id="removable_list">
                            @foreach($productData->product_removables as $removable)
                            <div class="form-group gt-rem-row">
                                <input type="text" class="form-control" name="removables[]" placeholder="e.g. Onion" autocomplete="off" value="{{ $removable->name }}" aria-label="Removable item">
                                <button class="gt-row-x" title="Delete Removable" type="button" onclick="deleteRemovableItem(this)"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>
                            @endforeach
                        </div>

                        <button class="gt-add-row" title="Add Removables" type="button" onclick="addRemovableItem()">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add removable item
                        </button>
                    </div>
                    <div class="box-footer gt-foot-sm">
                        <button type="submit" class="gt-btn gt-btn--brand submitbutton">
                            <i class="fa fa-check" aria-hidden="true"></i> Save remove options
                        </button>
                    </div>
                </div>
            </form>

            <!-- 4. CUSTOMER OPTIONS -->
            <div class="gt-opt-cards gt-anchor" id="sec-options">

                <!-- Flavour -->
                <form method="post" id="productFlavourForm" action="{{ URL::to('product-flavour-update') }}/{{ $productData->id }}">
                    @csrf
                    <div class="box gt-form-card">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-fire" style="color: var(--gt-brand);" aria-hidden="true"></i> Flavours</h3>
                        </div>
                        <div class="gt-fsec">
                            <div id="errorandsuccess_flavour"></div>
                            <div class="form-group">
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select Flavours" style="width: 100%;" name="product_flavours[]">
                                    <option value="Lemon" @if(in_array("Lemon", $selectedFlavours)) selected @endif>Lemon</option>
                                    <option value="Lemon & Herb" @if(in_array("Lemon & Herb", $selectedFlavours)) selected @endif>Lemon & Herb</option>
                                    <option value="BBQ" @if(in_array("BBQ", $selectedFlavours)) selected @endif>BBQ</option>
                                    <option value="Sweet Chilli" @if(in_array("Sweet Chilli", $selectedFlavours)) selected @endif>Sweet Chilli</option>
                                    <option value="Mild" @if(in_array("Mild", $selectedFlavours)) selected @endif>Mild</option>
                                    <option value="Medium Hot" @if(in_array("Medium Hot", $selectedFlavours)) selected @endif>Medium Hot</option>
                                    <option value="Hot" @if(in_array("Hot", $selectedFlavours)) selected @endif>Hot</option>
                                    <option value="Extra Hot" @if(in_array("Extra Hot", $selectedFlavours)) selected @endif>Extra Hot</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer gt-foot-sm">
                            <button type="submit" class="gt-btn gt-btn--brand submitbutton"><i class="fa fa-check" aria-hidden="true"></i> Save flavours</button>
                        </div>
                    </div>
                </form>

                <!-- Sides -->
                <form method="post" id="productSideForm" action="{{ URL::to('product-side-update') }}/{{ $productData->id }}">
                    @csrf
                    <div class="box gt-form-card">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-cutlery" style="color: var(--gt-brand);" aria-hidden="true"></i> Sides</h3>
                        </div>
                        <div class="gt-fsec">
                            <div id="errorandsuccess_side"></div>
                            <div class="form-group">
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select Sides" style="width: 100%;" name="product_sides[]">
                                    <option value="Rice" @if(in_array("Rice", $selectedSides)) selected @endif>Rice</option>
                                    <option value="Fries" @if(in_array("Fries", $selectedSides)) selected @endif>Fries</option>
                                    <option value="Chips" @if(in_array("Chips", $selectedSides)) selected @endif>Chips</option>
                                    <option value="Wedges" @if(in_array("Wedges", $selectedSides)) selected @endif>Wedges</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer gt-foot-sm">
                            <button type="submit" class="gt-btn gt-btn--brand submitbutton"><i class="fa fa-check" aria-hidden="true"></i> Save sides</button>
                        </div>
                    </div>
                </form>

                <!-- Drinks -->
                <form method="post" id="productDrinkForm" action="{{ URL::to('product-drink-update') }}/{{ $productData->id }}">
                    @csrf
                    <div class="box gt-form-card">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-glass" style="color: var(--gt-brand);" aria-hidden="true"></i> Drinks</h3>
                        </div>
                        <div class="gt-fsec">
                            <div id="errorandsuccess_drink"></div>
                            <div class="form-group">
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select Drinks" style="width: 100%;" name="product_drinks[]">
                                    <option value="Fruit Shoot Blackcurrant 200ml" @if(in_array("Fruit Shoot Blackcurrant 200ml", $selectedDrinks)) selected @endif>Fruit Shoot Blackcurrant 200ml</option>
                                    <option value="Fruit Shoot Orange 200ml" @if(in_array("Fruit Shoot Orange 200ml", $selectedDrinks)) selected @endif>Fruit Shoot Orange 200ml</option>
                                    <option value="Capri Sun Orange 200ml" @if(in_array("Capri Sun Orange 200ml", $selectedDrinks)) selected @endif>Capri Sun Orange 200ml</option>

                                    <option value="Coke 330ml" @if(in_array("Coke 330ml", $selectedDrinks)) selected @endif>Coke 330ml</option>
                                    <option value="Diet Coke 330ml" @if(in_array("Diet Coke 330ml", $selectedDrinks)) selected @endif>Diet Coke 330ml</option>
                                    <option value="Sprite 330ml" @if(in_array("Sprite 330ml", $selectedDrinks)) selected @endif>Sprite 330ml</option>
                                    <option value="7UP 330ml" @if(in_array("7UP 330ml", $selectedDrinks)) selected @endif>7UP 330ml</option>
                                    <option value="Coke Zero 330ml" @if(in_array("Coke Zero 330ml", $selectedDrinks)) selected @endif>Coke Zero 330ml</option>
                                    <option value="Fanta 330ml" @if(in_array("Fanta 330ml", $selectedDrinks)) selected @endif>Fanta 330ml</option>
                                    <option value="Pepsi 330ml" @if(in_array("Pepsi 330ml", $selectedDrinks)) selected @endif>Pepsi 330ml</option>
                                    <option value="Mirinda Orange 330ml" @if(in_array("Mirinda Orange 330ml", $selectedDrinks)) selected @endif>Mirinda Orange 330ml</option>
                                    <option value="Mirinda Strawberry 330ml" @if(in_array("Mirinda Strawberry 330ml", $selectedDrinks)) selected @endif>Mirinda Strawberry 330ml</option>
                                    <option value="Dr Pepper 330ml" @if(in_array("Dr Pepper 330ml", $selectedDrinks)) selected @endif>Dr Pepper 330ml</option>
                                    <option value="Dr Pepper Zero 330ml" @if(in_array("Dr Pepper Zero 330ml", $selectedDrinks)) selected @endif>Dr Pepper Zero 330ml</option>

                                    <option value="Water Volvic 500ml" @if(in_array("Water Volvic 500ml", $selectedDrinks)) selected @endif>Water Volvic 500ml</option>
                                    <option value="Coke 500ml" @if(in_array("Coke 500ml", $selectedDrinks)) selected @endif>Coke 500ml</option>
                                    <option value="Diet Coke 500ml" @if(in_array("Diet Coke 500ml", $selectedDrinks)) selected @endif>Diet Coke 500ml</option>

                                    <option value="Coke 1 Litre" @if(in_array("Coke 1 Litre", $selectedDrinks)) selected @endif>Coke 1 Litre</option>
                                    <option value="Diet Coke 1 Litre" @if(in_array("Diet Coke 1 Litre", $selectedDrinks)) selected @endif>Diet Coke 1 Litre</option>
                                    <option value="Fanta 1 Litre" @if(in_array("Fanta 1 Litre", $selectedDrinks)) selected @endif>Fanta 1 Litre</option>
                                    <option value="Pepsi 1 Litre" @if(in_array("Pepsi 1 Litre", $selectedDrinks)) selected @endif>Pepsi 1 Litre</option>
                                    <option value="Sprite 1 Litre" @if(in_array("Sprite 1 Litre", $selectedDrinks)) selected @endif>Sprite 1 Litre</option>
                                    <option value="7UP 1 Litre" @if(in_array("7UP 1 Litre", $selectedDrinks)) selected @endif>7UP 1 Litre</option>
                                    <option value="Coke Zero 1 Litre" @if(in_array("Coke Zero 1 Litre", $selectedDrinks)) selected @endif>Coke Zero 1 Litre</option>

                                    <option value="Water Volvic 1.5 Litre" @if(in_array("Water Volvic 1.5 Litre", $selectedDrinks)) selected @endif>Water Volvic 1.5 Litre</option>
                                    <option value="Coke 1.5 Litre" @if(in_array("Coke 1.5 Litre", $selectedDrinks)) selected @endif>Coke 1.5 Litre</option>
                                    <option value="Diet Coke 1.5 Litre" @if(in_array("Diet Coke 1.5 Litre", $selectedDrinks)) selected @endif>Diet Coke 1.5 Litre</option>
                                    <option value="Sprite 1.5 Litre" @if(in_array("Sprite 1.5 Litre", $selectedDrinks)) selected @endif>Sprite 1.5 Litre</option>
                                    <option value="7UP 1.5 Litre" @if(in_array("7UP 1.5 Litre", $selectedDrinks)) selected @endif>7UP 1.5 Litre</option>
                                    <option value="Coke Zero 1.5 Litre" @if(in_array("Coke Zero 1.5 Litre", $selectedDrinks)) selected @endif>Coke Zero 1.5 Litre</option>
                                    <option value="Fanta 1.5 Litre" @if(in_array("Fanta 1.5 Litre", $selectedDrinks)) selected @endif>Fanta 1.5 Litre</option>
                                    <option value="Pepsi 1.5 Litre" @if(in_array("Pepsi 1.5 Litre", $selectedDrinks)) selected @endif>Pepsi 1.5 Litre</option>

                                    <option value="Still Water 1.75 Litre" @if(in_array("Still Water 1.75 Litre", $selectedDrinks)) selected @endif>Still Water 1.75 Litre</option>
                                    <option value="Coke 1.75 Litre" @if(in_array("Coke 1.75 Litre", $selectedDrinks)) selected @endif>Coke 1.75 Litre</option>
                                    <option value="Diet Coke 1.75 Litre" @if(in_array("Diet Coke 1.75 Litre", $selectedDrinks)) selected @endif>Diet Coke 1.75 Litre</option>
                                    <option value="Pepsi 1.75 Litre" @if(in_array("Pepsi 1.75 Litre", $selectedDrinks)) selected @endif>Pepsi 1.75 Litre</option>
                                    <option value="Fanta 1.75 Litre" @if(in_array("Fanta 1.75 Litre", $selectedDrinks)) selected @endif>Fanta 1.75 Litre</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer gt-foot-sm">
                            <button type="submit" class="gt-btn gt-btn--brand submitbutton"><i class="fa fa-check" aria-hidden="true"></i> Save drinks</button>
                        </div>
                    </div>
                </form>

                <!-- Sauce -->
                <form method="post" id="productSauceForm" action="{{ URL::to('product-sauce-update') }}/{{ $productData->id }}">
                    @csrf
                    <div class="box gt-form-card">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-tint" style="color: var(--gt-brand);" aria-hidden="true"></i> Sauces</h3>
                        </div>
                        <div class="gt-fsec">
                            <div id="errorandsuccess_sauce"></div>
                            <div class="form-group">
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select Sauces" style="width: 100%;" name="product_sauces[]">
                                    <option value="Mayo" @if(in_array("Mayo", $selectedSauces)) selected @endif>Mayo</option>
                                    <option value="Ketchup" @if(in_array("Ketchup", $selectedSauces)) selected @endif>Ketchup</option>
                                    <option value="Burger Sauce" @if(in_array("Burger Sauce", $selectedSauces)) selected @endif>Burger Sauce</option>
                                    <option value="Garlic Mayo" @if(in_array("Garlic Mayo", $selectedSauces)) selected @endif>Garlic Mayo</option>
                                    <option value="Hot Sauce" @if(in_array("Hot Sauce", $selectedSauces)) selected @endif>Hot Sauce</option>
                                    <option value="BBQ Sauce" @if(in_array("BBQ Sauce", $selectedSauces)) selected @endif>BBQ Sauce</option>
                                    <option value="G & T Special Sauce" @if(in_array("G & T Special Sauce", $selectedSauces)) selected @endif>G & T Special Sauce</option>
                                    <option value="Sweet Chilli Sauce" @if(in_array("Sweet Chilli Sauce", $selectedSauces)) selected @endif>Sweet Chilli Sauce</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer gt-foot-sm">
                            <button type="submit" class="gt-btn gt-btn--brand submitbutton"><i class="fa fa-check" aria-hidden="true"></i> Save sauces</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <!-- RIGHT: preview + jump links -->
        <aside class="gt-preview">
            <span class="gt-preview__label">Menu preview</span>
            <div class="gt-pcard">
                <div class="gt-pcard__img" id="gt-prev-img">
                    <img src="{{ URL::to('/') }}/images/product/{{ $productData->image }}" alt="">
                </div>
                <div class="gt-pcard__body">
                    <strong id="gt-prev-name">{{ $productData->name }}</strong>
                    <p id="gt-prev-details">{{ $productData->details }}</p>
                    <div class="gt-pcard__foot">
                        <span><small id="gt-prev-from" style="visibility: {{ $gtMany ? 'visible' : 'hidden' }};">From</small><b id="gt-prev-price">£{{ number_format($gtMin, 2) }}</b></span>
                        <span class="gt-pcard__add"><i class="fa fa-plus" aria-hidden="true"></i> Add</span>
                    </div>
                </div>
            </div>

            <nav class="gt-sec-nav" aria-label="Jump to section">
                <a href="#sec-basics"><i class="fa fa-info-circle" aria-hidden="true"></i> Basics</a>
                <a href="#sec-prices"><i class="fa fa-gbp" aria-hidden="true"></i> Sizes &amp; prices</a>
                <a href="#sec-remove"><i class="fa fa-minus-circle" aria-hidden="true"></i> Remove options</a>
                <a href="#sec-options"><i class="fa fa-sliders" aria-hidden="true"></i> Flavours, sides, drinks &amp; sauces</a>
                <a href="{{ URL::to('/') }}#menu-8" target="_blank" rel="noopener"><i class="fa fa-external-link" aria-hidden="true"></i> View on menu</a>
            </nav>
        </aside>

    </div>
</section>
@endsection

@push('script')
<script>

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $("#countryform").on('submit', function(e) {
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
            beforeSend: function() {
                $('.form-group').removeClass('has-error');
                $('.submitbutton').attr('disabled', '');
            },

            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                $('.submitbutton').removeAttr('disabled');
                console.log(error);
                var count = 0;
                $.each(xhr.responseJSON.errors, function(key, item) {
                    if (count == 0) {
                        $("#errorandsuccess").html("<div class='alert alert-danger' role='alert'>" + item + "</div>");
                        $("#" + key).focus();
                        count++;
                    }
                    $("#" + key).closest(".form-group").addClass("has-error");
                });
            }
        })
    });

    function addMorePrice() {
        $('#price_modify').append(
            '<div class="form-group gt-var-row">' +
                '<select class="form-control" name="variation_type[]" required="required" aria-label="Variation type">' +
                    '<option value="regular">Regular</option>' +
                    '<option value="meal">Meal</option>' +
                '</select>' +
                '<input type="text" class="form-control" name="variation_name[]" placeholder="Variation name" autocomplete="off" aria-label="Variation name"/>' +
                '<span class="gt-money"><input type="number" class="form-control" name="variation_price[]" placeholder="0.00" autocomplete="off" step="0.01" aria-label="Variation price"/></span>' +
                '<button class="gt-row-x" title="Remove" type="button" onclick="removePrice(this)"><i class="fa fa-times" aria-hidden="true"></i></button>' +
            '</div>'
        );
    }

    function removePrice(el) {
        $(el).closest('.form-group').remove();
        if (window.gtUpdatePrice) gtUpdatePrice();
    }

    function addRemovableItem() {
        $('#removable_list').append(
            '<div class="form-group gt-rem-row">' +
                '<input type="text" class="form-control" name="removables[]" placeholder="e.g. Onion" autocomplete="off" aria-label="Removable item">' +
                '<button class="gt-row-x" title="Delete Removable" type="button" onclick="deleteRemovableItem(this)"><i class="fa fa-times" aria-hidden="true"></i></button>' +
            '</div>'
        );
        $('#removable_list .gt-rem-row:last input').focus();
    }

    function deleteRemovableItem(el) {
        $(el).closest('.form-group').remove();
    }

    $("#productVariationForm").on('submit', function(e) {
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
            beforeSend: function() {
                $('.submitbutton').attr('disabled', '');
            },
            success: function(response) {
                $('.submitbutton').removeAttr('disabled');
                $("#errorandsuccess_variation").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Product variation updated.</div>");
            },
            error: function(xhr, status, error) {
                $('.submitbutton').removeAttr('disabled');
                var count = 0;
                $.each(xhr.responseJSON.errors, function(key, item) {
                    if (count == 0) {
                        $("#errorandsuccess_variation").html("<div class='alert alert-danger' role='alert'>" + item + "</div>");
                        count++;
                    }
                });
            }
        })
    });

    $("#productFlavourForm").on('submit', function(e) {
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
            beforeSend: function() {
                $('.submitbutton').attr('disabled', '');
            },
            success: function(response) {
                $('.submitbutton').removeAttr('disabled');
                $("#errorandsuccess_flavour").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Product flavour updated.</div>");
            },
            error: function(xhr, status, error) {
                $('.submitbutton').removeAttr('disabled');
            }
        })
    });

    $("#productSideForm").on('submit', function(e) {
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
            beforeSend: function() {
                $('.submitbutton').attr('disabled', '');
            },
            success: function(response) {
                $('.submitbutton').removeAttr('disabled');
                $("#errorandsuccess_side").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Product side updated.</div>");
            },
            error: function(xhr, status, error) {
                $('.submitbutton').removeAttr('disabled');
            }
        })
    });

    $("#productRemovableForm").on('submit', function(e) {
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
            beforeSend: function() {
                $('.submitbutton').attr('disabled', '');
            },
            success: function(response) {
                $('.submitbutton').removeAttr('disabled');
                $("#errorandsuccess_removable").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Product removable updated.</div>");
            },
            error: function(xhr, status, error) {
                $('.submitbutton').removeAttr('disabled');
                var count = 0;
                $.each(xhr.responseJSON.errors, function(key, item) {
                    if (count == 0) {
                        $("#errorandsuccess_removable").html("<div class='alert alert-danger' role='alert'>" + item + "</div>");
                        count++;
                    }
                });
            }
        })
    });

    $("#productDrinkForm").on('submit', function(e) {
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
            beforeSend: function() {
                $('.submitbutton').attr('disabled', '');
            },
            success: function(response) {
                $('.submitbutton').removeAttr('disabled');
                $("#errorandsuccess_drink").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Product drink updated.</div>");
            },
            error: function(xhr, status, error) {
                $('.submitbutton').removeAttr('disabled');
            }
        })
    });

    $("#productSauceForm").on('submit', function(e) {
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
            beforeSend: function() {
                $('.submitbutton').attr('disabled', '');
            },
            success: function(response) {
                $('.submitbutton').removeAttr('disabled');
                $("#errorandsuccess_sauce").html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Product sauce updated.</div>");
            },
            error: function(xhr, status, error) {
                $('.submitbutton').removeAttr('disabled');
            }
        })
    });

    (function () {
        var file = document.getElementById('image');
        var drop = document.getElementById('gt-drop');
        var prev = document.getElementById('gt-drop-preview');
        var fname = document.getElementById('gt-drop-file');
        var pImg = document.getElementById('gt-prev-img');
        var name = document.getElementById('name');
        var details = document.getElementById('details');

        if (name) name.addEventListener('input', function () { document.getElementById('gt-prev-name').textContent = name.value.trim() || 'Product name'; });
        if (details) details.addEventListener('input', function () { document.getElementById('gt-prev-details').textContent = details.value.trim() || 'The product description will show here.'; });

        window.gtUpdatePrice = function () {
            var prices = [];
            document.querySelectorAll('#price_modify input[name="variation_price[]"]').forEach(function (i) {
                var v = parseFloat(i.value);
                if (!isNaN(v)) prices.push(v);
            });
            var rows = document.querySelectorAll('#price_modify .gt-var-row').length;
            document.getElementById('gt-prev-price').textContent = '£' + (prices.length ? Math.min.apply(null, prices) : 0).toFixed(2);
            document.getElementById('gt-prev-from').style.visibility = rows > 1 ? 'visible' : 'hidden';
        };
        document.getElementById('price_modify').addEventListener('input', gtUpdatePrice);

        if (file) {
            file.addEventListener('change', function () {
                var f = file.files && file.files[0];
                if (!f) return;
                fname.textContent = 'New: ' + f.name;
                if (!/^image\//.test(f.type)) return;
                var reader = new FileReader();
                reader.onload = function (e) {
                    var html = '<img src="' + e.target.result + '" alt="">';
                    prev.innerHTML = html;
                    pImg.innerHTML = html;
                };
                reader.readAsDataURL(f);
            });
            ['dragenter', 'dragover'].forEach(function (ev) { drop.addEventListener(ev, function () { drop.classList.add('is-over'); }); });
            ['dragleave', 'drop'].forEach(function (ev) { drop.addEventListener(ev, function () { drop.classList.remove('is-over'); }); });
        }
    })();
</script>
@endpush