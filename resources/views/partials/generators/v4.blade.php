<div class="text-center">

	<div class="mb-5 mt-5">
		<div class="form-group row">
			<input class="form-control form-control-xl text-monospace text-center font-weight-bold form-control-clear overflow-hidden" id="single-uuid" type="text" readonly onclick="select()">
		</div>
		<div class="clearfix">
			<input id="single-copy-input" class="input-offscreen" type="text">
			<input id="api-copy-input" class="input-offscreen" type="text" value="https://www.uuidtools.com/api/generate/v4/count/1">
			<button id="api-copy-button" class="btn btn-outline-primary btn-sm float-right ml-2"> <i class="fas fa-code"></i> Copy API Call </button>
			<button id="copy-button" class="btn btn-outline-primary btn-sm float-right"> <i class="far fa-copy"></i> Copy UUID </button>
			<span id="copied-label" class="float-right text-primary mr-2" style="display: none;">copied!</span>
		</div>
		<p class="error text-danger"></p>
	</div>
	<button class="btn btn-primary btn-lg" id="generate-single"> Generate Another <i class="fas fa-redo-alt"></i> </button>

	<p class="mt-2 mb-0"><a href="/generate/bulk">Bulk UUID Generator</a></p>

</div>

@push('scripts')
<script>

	$(document).ready(function() {
		refresh_uuid();
	});

	$('#generate-single').on('click', function() {
		refresh_uuid();
	});

	$('#copy-button').on('click', function() {
		$('#copied-label').show().fadeOut('slow');
		document.getElementById('single-copy-input').select();
		document.getElementById('single-copy-input').setSelectionRange(0, 99999);
		document.execCommand("copy");
	});
	$('#api-copy-button').on('click', function() {
		$('#copied-label').show().fadeOut('slow');
		document.getElementById('api-copy-input').select();
		document.getElementById('api-copy-input').setSelectionRange(0, 99999);
		document.execCommand("copy");
	});

	function refresh_uuid() {
		$.ajax({
			url: "/api/generate/v4",
			success: function(data) {
				$('.error').html("");
				$('#single-uuid').val(data[0]);
				$('#single-copy-input').val(data[0]);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				if (jqXHR.status == 429) {
					$('.error').html('Too many requests. Please wait 1 minute.');
					$('#generate-single').prop('disabled', true);
					setTimeout(function() {
						$('.error').html('');
						$('#generate-single').prop('disabled', false);
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