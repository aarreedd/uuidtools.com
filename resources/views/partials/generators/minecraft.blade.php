<div class="text-center">
    <div class="mb-5 mt-5">
        <div class="form-group row">
            <input class="form-control form-control-xl text-monospace text-center font-weight-bold form-control-clear overflow-hidden" id="single-uuid-v4" type="text" readonly onclick="select()">
        </div>
        <div class="clearfix">
            <input id="single-copy-input-v4" class="input-offscreen" type="text">
            <input id="api-copy-input-v4" class="input-offscreen" type="text" value="https://www.uuidtools.com/api/generate/v4/count/1">
            <button id="api-copy-button-v4" class="btn btn-outline-primary btn-sm float-right ml-2"> <i class="fas fa-code"></i> Copy API Call </button>
            <button id="copy-button-v4" class="btn btn-outline-primary btn-sm float-right"> <i class="far fa-copy"></i> Copy UUID </button>
            <span id="copied-label-v4" class="float-right text-primary mr-2" style="display: none;">copied!</span>
        </div>
        <p class="error text-danger"></p>
    </div>
    <button class="btn btn-primary btn-lg" id="generate-single-v4"> Generate Another <i class="fas fa-redo-alt"></i> </button>

    <p class="mt-2 mb-0"><a href="/generate/bulk">Bulk UUID Generator</a></p>

</div>

@push('scripts')
<script>

    $(document).ready(function() {
        refresh_uuid_v4();
    });

    $('#generate-single-v4').on('click', function() {
        refresh_uuid_v4();
    });

    $('#copy-button-v4').on('click', function() {
        $('#copied-label-v4').show().fadeOut('slow');
        document.getElementById('single-copy-input-v4').select();
        document.getElementById('single-copy-input-v4').setSelectionRange(0, 99999);
        document.execCommand("copy");
    });
    $('#api-copy-button-v4').on('click', function() {
        $('#copied-label-v4').show().fadeOut('slow');
        document.getElementById('api-copy-input-v4').select();
        document.getElementById('api-copy-input-v4').setSelectionRange(0, 99999);
        document.execCommand("copy");
    });

    function refresh_uuid_v4() {
        $.ajax({
            url: "/api/generate/v4",
            success: function(data) {
                $('.error').html("");
                $('#single-uuid-v4').val(data[0]);
                $('#single-copy-input-v4').val(data[0]);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 429) {
                    $('.error').html('Too many requests. Please wait 1 minute.');
                    $('#generate-single-v4').prop('disabled', true);
                    setTimeout(function() {
                        $('.error').html('');
                        $('#generate-single-v4').prop('disabled', false);
                    }, 60000);
                } else if (jqXHR.responseJSON && "errors" in jqXHR.responseJSON && Object.keys(jqXHR.responseJSON['errors']).length) {
                    $('.error').html("");
                    error = [];
                    for (key in jqXHR.responseJSON['errors']) {
                        error.push(jqXHR.responseJSON['errors'][key].join(' '));
                    }
                    $('.error').html(error.join(' '));
                } else {
                    $('.error').html(errorThrown + ". Please contact us if this problem continues.");
                }
            }
        });
    }

</script>
@endpush
