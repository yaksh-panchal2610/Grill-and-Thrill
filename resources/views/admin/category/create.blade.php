@extends('layouts.admin.main')

@section('content')

<section class="content-header">
    <h1>
        Category
        <small>Create new</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('category') }}">Category list</a></li>
        <li class="active">Create</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="gt-form-grid">

        <!-- FORM -->
        <div class="box gt-form-card">
            <div class="box-header with-border">
                <h3 class="box-title">Create category</h3>
            </div>

            <?php if (Session::get('success_message') != "") { ?>
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}" style="margin: 16px 22px 0;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('success_message') }}
                </div>
            <?php } ?>
            <div id="errorandsuccess" style="margin: 0 22px;"></div>

            <form method="post" id="categoryform" action="{{ URL::to('category') }}">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Burgers">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="gt-drop" id="gt-drop">
                            <input type="file" name="image" id="image" accept="image/*">
                            <span class="gt-drop__preview" id="gt-drop-preview"><i class="fa fa-image" aria-hidden="true"></i></span>
                            <span class="gt-drop__text">
                                <strong>Click or drag an image here</strong>
                                <small>Square photos look best (JPG or PNG)</small>
                                <span class="gt-drop__file" id="gt-drop-file"></span>
                            </span>
                        </div>
                        <p class="help-block">Please upload an image here.</p>
                    </div>

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
                    <a href="{{ URL::to('category') }}" class="gt-btn gt-btn--soft">Cancel</a>
                    <button type="submit" id="submitbutton" class="gt-btn gt-btn--brand">
                        <i class="fa fa-check" aria-hidden="true"></i> <span>Save category</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- PREVIEW -->
        <aside class="gt-preview">
            <div class="box" style="padding: 20px;">
                <span class="gt-preview__label">Menu preview</span>
                <span class="gt-preview__pill">
                    <span class="gt-preview__img" id="gt-prev-img"><i class="fa fa-image" aria-hidden="true"></i></span>
                    <span id="gt-prev-name">Category name</span>
                </span>
                <p>This is how the category tab will look on the website menu.</p>
            </div>
        </aside>

    </div>
</section>
@endsection

@push('script')
<script>

    $('.select2').select2();

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
                $('#submitbutton span').text('Saving…'); 
            },

            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                $('#submitbutton').removeAttr('disabled');
                $('#submitbutton span').text('Save category'); 
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

    (function () {
        var file = document.getElementById('image');
        var drop = document.getElementById('gt-drop');
        var prev = document.getElementById('gt-drop-preview');
        var fname = document.getElementById('gt-drop-file');
        var pImg = document.getElementById('gt-prev-img');
        var pName = document.getElementById('gt-prev-name');
        var name = document.getElementById('name');

        if (name && pName) {
            name.addEventListener('input', function () { pName.textContent = name.value.trim() || 'Category name'; });
        }

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