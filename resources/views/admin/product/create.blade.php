@extends('layouts.admin.main')

@section('content')

<section class="content-header">
    <h1>
        Product
        <small>Create new</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('product') }}">Product list</a></li>
        <li class="active">Create</li>
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
    <div id="errorandsuccess"></div>

    <form method="post" id="categoryform" action="{{ URL::to('product') }}">
        @csrf
        <div class="gt-form-grid">

            <!-- FORM -->
            <div class="box gt-form-card">
                <div class="box-header with-border">
                    <h3 class="box-title">Create product</h3>
                </div>

                <!-- 1. BASICS -->
                <div class="gt-fsec">
                    <div class="gt-fsec__head">
                        <span class="gt-fsec__title"><span class="gt-fsec__num">1</span><h4>Basics</h4></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Smash Burger">
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control select2" style="width: 100%;">
                            <option value="">Please select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" class="form-control" rows="3" placeholder="e.g. Double beef patty, cheese, pickles and burger sauce"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="gt-drop" id="gt-drop">
                            <input type="file" name="image" id="image" accept="image/*">
                            <span class="gt-drop__preview" id="gt-drop-preview"><i class="fa fa-image" aria-hidden="true"></i></span>
                            <span class="gt-drop__text">
                                <strong>Click or drag a photo here</strong>
                                <small>Landscape food photos look best (JPG or PNG)</small>
                                <span class="gt-drop__file" id="gt-drop-file"></span>
                            </span>
                        </div>
                        <p class="help-block">Please upload an image here.</p>
                    </div>
                </div>

                <!-- 2. SIZES & PRICES -->
                <div class="gt-fsec">
                    <div class="gt-fsec__head">
                        <span class="gt-fsec__title"><span class="gt-fsec__num">2</span><span><h4>Sizes &amp; prices</h4><small>"Meal" types show the drink choice to customers</small></span></span>
                    </div>

                    <div class="gt-var-head" aria-hidden="true">
                        <span>Type</span><span>Name</span><span>Price</span><span></span>
                    </div>

                    <div id="price_modify">
                        <div class="form-group gt-var-row">
                            <select class="form-control" name="variation_type[]" required="required" aria-label="Variation type">
                                <option value="regular">Regular</option>
                                <option value="meal">Meal</option>
                            </select>
                            <input type="text" class="form-control" name="variation_name[]" placeholder="Variation name" autocomplete="off" value="On Its Own" aria-label="Variation name" />
                            <span class="gt-money"><input type="number" class="form-control" name="variation_price[]" placeholder="0.00" autocomplete="off" step="0.01" aria-label="Variation price" /></span>
                            <span class="gt-row-lock" title="At least one price is needed"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        </div>

                        <div class="form-group gt-var-row">
                            <select class="form-control" name="variation_type[]" required="required" aria-label="Variation type">
                                <option value="regular">Regular</option>
                                <option value="meal" selected>Meal</option>
                            </select>
                            <input type="text" class="form-control" name="variation_name[]" placeholder="Variation name" autocomplete="off" value="Medium Meal" aria-label="Variation name">
                            <span class="gt-money"><input type="number" class="form-control" name="variation_price[]" placeholder="0.00" autocomplete="off" step="0.01" aria-label="Variation price"></span>
                            <button class="gt-row-x" title="Remove" type="button" onclick="removePrice(this)"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>

                        <div class="form-group gt-var-row">
                            <select class="form-control" name="variation_type[]" required="required" aria-label="Variation type">
                                <option value="regular">Regular</option>
                                <option value="meal" selected>Meal</option>
                            </select>
                            <input type="text" class="form-control" name="variation_name[]" placeholder="Variation name" autocomplete="off" value="Large Meal" aria-label="Variation name">
                            <span class="gt-money"><input type="number" class="form-control" name="variation_price[]" placeholder="0.00" autocomplete="off" step="0.01" aria-label="Variation price"></span>
                            <button class="gt-row-x" title="Remove" type="button" onclick="removePrice(this)"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <button class="gt-add-row" type="button" onclick="addMorePrice()" style="margin-top: 4px;">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add variation
                    </button>
                </div>

                <!-- 3. CUSTOMER OPTIONS -->
                <div class="gt-fsec">
                    <div class="gt-fsec__head">
                        <span class="gt-fsec__title"><span class="gt-fsec__num">3</span><span><h4>Customer options</h4><small>Only fill in what applies to this product</small></span></span>
                    </div>

                    <div class="gt-opt-grid">
                        <div class="form-group">
                            <label>Flavour (If applicable)</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Flavours" style="width: 100%;" name="product_flavours[]">
                                <option value="Lemon">Lemon</option>
                                <option value="Lemon & Herb">Lemon & Herb</option>
                                <option value="BBQ">BBQ</option>
                                <option value="Sweet Chilli">Sweet Chilli</option>
                                <option value="Mild">Mild</option>
                                <option value="Medium Hot">Medium Hot</option>
                                <option value="Hot">Hot</option>
                                <option value="Extra Hot">Extra Hot</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sides (If applicable)</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Sides" style="width: 100%;" name="product_sides[]">
                                <option value="Rice">Rice</option>
                                <option value="Fries">Fries</option>
                                <option value="Chips">Chips</option>
                                <option value="Wedges">Wedges</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Drinks (If applicable)</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Drinks" style="width: 100%;" name="product_drinks[]">
                                <option value="Fruit Shoot Blackcurrant 200ml">Fruit Shoot Blackcurrant 200ml</option>
                                <option value="Fruit Shoot Orange 200ml">Fruit Shoot Orange 200ml</option>
                                <option value="Capri Sun Orange 200ml">Capri Sun Orange 200ml</option>

                                <option value="Coke 330ml">Coke 330ml</option>
                                <option value="Diet Coke 330ml">Diet Coke 330ml</option>
                                <option value="Sprite 330ml">Sprite 330ml</option>
                                <option value="7UP 330ml">7UP 330ml</option>
                                <option value="Coke Zero 330ml">Coke Zero 330ml</option>
                                <option value="Fanta 330ml">Fanta 330ml</option>
                                <option value="Pepsi 330ml">Pepsi 330ml</option>
                                <option value="Mirinda Orange 330ml">Mirinda Orange 330ml</option>
                                <option value="Mirinda Strawberry 330ml">Mirinda Strawberry 330ml</option>
                                <option value="Dr Pepper 330ml">Dr Pepper 330ml</option>
                                <option value="Dr Pepper Zero 330ml">Dr Pepper Zero 330ml</option>

                                <option value="Water Volvic 500ml">Water Volvic 500ml</option>
                                <option value="Coke 500ml">Coke 500ml</option>
                                <option value="Diet Coke 500ml">Diet Coke 500ml</option>

                                <option value="Coke 1 Litre">Coke 1 Litre</option>
                                <option value="Diet Coke 1 Litre">Diet Coke 1 Litre</option>
                                <option value="Fanta 1 Litre">Fanta 1 Litre</option>
                                <option value="Pepsi 1 Litre">Pepsi 1 Litre</option>
                                <option value="Sprite 1 Litre">Sprite 1 Litre</option>
                                <option value="7UP 1 Litre">7UP 1 Litre</option>
                                <option value="Coke Zero 1 Litre">Coke Zero 1 Litre</option>

                                <option value="Water Volvic 1.5 Litre">Water Volvic 1.5 Litre</option>
                                <option value="Coke 1.5 Litre">Coke 1.5 Litre</option>
                                <option value="Diet Coke 1.5 Litre">Diet Coke 1.5 Litre</option>
                                <option value="Sprite 1.5 Litre">Sprite 1.5 Litre</option>
                                <option value="7UP 1.5 Litre">7UP 1.5 Litre</option>
                                <option value="Coke Zero 1.5 Litre">Coke Zero 1.5 Litre</option>
                                <option value="Fanta 1.5 Litre">Fanta 1.5 Litre</option>
                                <option value="Pepsi 1.5 Litre">Pepsi 1.5 Litre</option>

                                <option value="Still Water 1.75 Litre">Still Water 1.75 Litre</option>
                                <option value="Coke 1.75 Litre">Coke 1.75 Litre</option>
                                <option value="Diet Coke 1.75 Litre">Diet Coke 1.75 Litre</option>
                                <option value="Pepsi 1.75 Litre">Pepsi 1.75 Litre</option>
                                <option value="Fanta 1.75 Litre">Fanta 1.75 Litre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sauce (If applicable)</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Select Sauces" style="width: 100%;" name="product_sauces[]">
                                <option value="Mayo">Mayo</option>
                                <option value="Ketchup">Ketchup</option>
                                <option value="Burger Sauce">Burger Sauce</option>
                                <option value="Garlic Mayo">Garlic Mayo</option>
                                <option value="Hot Sauce">Hot Sauce</option>
                                <option value="BBQ Sauce">BBQ Sauce</option>
                                <option value="G & T Special Sauce">G & T Special Sauce</option>
                                <option value="Sweet Chilli Sauce">Sweet Chilli Sauce</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 4. REMOVABLES -->
                <div class="gt-fsec">
                    <div class="gt-fsec__head">
                        <span class="gt-fsec__title"><span class="gt-fsec__num">4</span><span><h4>Remove options</h4><small>Things customers can ask to leave out, e.g. Onion</small></span></span>
                    </div>
                    <div id="removable_list"></div>
                    <button class="gt-add-row" title="Add Removables" type="button" onclick="addRemovableItem()">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add removable item
                    </button>
                </div>

                <!-- STATUS + SAVE -->
                <div class="gt-fsec">
                    <div class="form-group">
                        <label style="display:block;">Status</label>
                        <div class="gt-switch" role="radiogroup" aria-label="Status">
                            <label>
                                <input type="radio" name="status" value="active" checked>
                                <i class="fa fa-check-circle" aria-hidden="true"></i> Active
                            </label>
                            <label>
                                <input type="radio" name="status" value="inactive">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i> Inactive
                            </label>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::to('product') }}" class="gt-btn gt-btn--soft">Cancel</a>
                    <button type="submit" id="submitbutton" class="gt-btn gt-btn--brand">
                        <i class="fa fa-check" aria-hidden="true"></i> <span>Save product</span>
                    </button>
                </div>
            </div>

            <!-- PREVIEW -->
            <aside class="gt-preview">
                <span class="gt-preview__label">Menu preview</span>
                <div class="gt-pcard">
                    <div class="gt-pcard__img" id="gt-prev-img"><i class="fa fa-image" aria-hidden="true"></i></div>
                    <div class="gt-pcard__body">
                        <strong id="gt-prev-name">Product name</strong>
                        <p id="gt-prev-details">The product description will show here.</p>
                        <div class="gt-pcard__foot">
                            <span><small id="gt-prev-from">From</small><b id="gt-prev-price">£0.00</b></span>
                            <span class="gt-pcard__add"><i class="fa fa-plus" aria-hidden="true"></i> Add</span>
                        </div>
                    </div>
                </div>
                <p style="margin-top: 12px; font-size: 13px; color: var(--gt-soft);">This is how the product card will look on the website menu.</p>
            </aside>

        </div>
    </form>
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

    $("#categoryform").on('submit', function(e) {
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
                $('#submitbutton').attr('disabled', '');
                $('#submitbutton span').text('Saving…'); // UI only
            },

            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                $('#submitbutton').removeAttr('disabled');
                $('#submitbutton span').text('Save product'); // UI only
                console.log(error);
                var count = 0;
                $.each(xhr.responseJSON.errors, function(key, item) {
                    if (count == 0) {
                        $("#errorandsuccess").html("<div class='alert alert-danger' role='alert'>" + item + "</div>");
                        $("#" + key).focus();
                        $('html, body').animate({ scrollTop: 0 }, 'fast'); // UI only
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
        gtUpdatePrice();

        if (file) {
            file.addEventListener('change', function () {
                var f = file.files && file.files[0];
                if (!f) return;
                fname.textContent = f.name;
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