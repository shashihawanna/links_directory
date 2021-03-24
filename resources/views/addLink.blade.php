@extends('layouts.app')
@section('custom_css')
<!-- Styles -->
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="section">
    <div class="container">
        <h1 class="title">
            Add your link
        </h1>
        <form id="addUrl" action="{{route('link.add')}}" redirect="{{ route('link.home')}}" method="post" class="needs-validation" novalidate>
            {{ csrf_field() }}
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" name="url" id="url" placeholder="Enter URL" required>
                <div class="invalid-feedback">
                    {{ __('link.validate.url') }}
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
                <div class="invalid-feedback">
                    {{ __('link.validate.title') }}
                </div>
            </div>
            <div class="form-row">
                <label for="inputCity">Description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" required>
                <div class="invalid-feedback">
                    {{ __('link.validate.description') }}

                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="enable" id="enable" required>
                    <label class="form-check-label" for="gridCheck">
                        enable
                    </label>
                    <div class="invalid-feedback">
                        {{ __('link.validate.enable') }}
                    </div>
                </div>
            </div>
            <button type="submit" onclick="addUrlValidation()" class="btn btn-primary">Add Link</button>
        </form>
    </div>
</section>
@section('custom_script')
<!-- JS -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
    function addUrlValidation() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $("#addUrl");
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    addStopEvent(event);
                }
                form.classList.add('was-validated');
            }, false);
        });
        if (validation) {
            if ($("#url").val() !== '' && !validateUrl($("#url").val())) {
                addStopEvent(event);
                $("#url").addClass('is-invalid hvalid');
                $("#url").next(".invalid-feedback").text("{{ __('link.validate.vurl')}}");
                $("#url").next(".invalid-feedback").show();
            } else if ($("#url").val() !== '' && validateUrl($("#url").val())) {
                addStopEvent(event);
                $("#url").removeClass('is-invalid hvalid');
                checkUrlExit(forms);
            }
        }
    }

    function addStopEvent(event) {
        event.preventDefault();
        event.stopPropagation();
    }

    function validateUrl(url) {
        return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
    }

    function checkUrlExit(form) {
        $(".overley-loader").show();
        $url = "{{route('link.checkUrlExit')}}";
        $.ajax({
            type: "POST",
            url: $url,
            data: form.serialize(), // serializes the form's elements.
            success: function(reponse) {
                $(".overley-loader").hide();
                if (reponse.success) {
                    // toastr["success"](reponse.msg);
                    addUrlDetails(form);
                } else {
                    toastr["error"](reponse.msg);
                    $("#url").addClass('is-invalid hvalid');
                    $("#url").next(".invalid-feedback").text(reponse.msg);
                    $("#url").next(".invalid-feedback").show();
                }
            },
            error: function(data) {
                $(".overley-loader").hide();
            }
        });
    }

    function addUrlDetails(form) {
        $(".overley-loader").show();
        $url = form.attr('action');
        $redirect = form.attr('redirect');
        $.ajax({
            type: "POST",
            url: $url,
            data: form.serialize(), // serializes the form's elements.
            success: function(reponse) {
                $(".overley-loader").hide();
                if (reponse.success) {
                    $('#addUrl')[0].reset();
                    toastr["success"](reponse.msg);
                    window.setTimeout(function() {
                        window.location.href = $redirect;
                    }, 3000);
                } else {
                    toastr["error"](reponse.msg);
                }
            },
            error: function(data) {
                $(".overley-loader").hide();
            }
        });
    }
</script>
@endsection
@endsection