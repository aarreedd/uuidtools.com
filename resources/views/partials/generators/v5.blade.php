<div class="text-center">

	<form id="generate-form">

		<div class="custom-control custom-switch">
			<input type="checkbox" class="custom-control-input" id="ns-switch">
			<label class="custom-control-label cursor-pointer" for="ns-switch">Enter identifier for pre-defined UUIDs</label>
			<span class="cursor-pointer text-primary" data-toggle="tooltip" title='The namespace must be a valid UUID or an identifier for internally pre-defined namespace UUIDs (currently known are "ns:DNS", "ns:URL", "ns:OID", and "ns:X500"). Check this toggle to select a pre-defined UUID identifier.'><i class="fas fa-question-circle"></i></span>
		</div>

		<div class="form-group" id="custom-namespace">
			<input type="text" autocomplete="off" class="form-control form-control-lg text-center" id="namespace-custom-input" aria-describedby="namespaceHelpCustom" placeholder="Enter Namespace UUID" required pattern="[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}">
			<small id="namespaceHelpCustom" class="form-text text-muted">
				The namespace must be a valid UUIDs in the format 00000000-0000-0000-0000-000000000000. Toggle the switch above to select a pre-defined UUID or <a href="#" id="autofill">autofill with random UUID <i class="fas fa-random"></i></a>
			</small>
		</div>

		<div class="form-group" id="predefined-namespace" style="display:none;">
			<select class="form-control form-control-lg text-center" style="text-align-last: center;" id="namespace-predefined-input" aria-describedby="namespaceHelpPredefined">
				<option class="text-center" value="ns:dns">ns:DNS - for domain names</option>
				<option class="text-center" value="ns:url">ns:URL - for URLs</option>
				<option class="text-center" value="ns:oid">ns:OID - for ISO OID </option>
				<option class="text-center" value="ns:x500">ns:X500 - for X.500 DN</option>
			</select>
			<small id="namespaceHelpPredefined" class="form-text text-muted">
				Select pre-defined UUID identifier. We translate the selected identifier to the corresponding well-known UUID internally. Toggle the switch above to enter your own namespace UUID.
			</small>
		</div>

		<div class="form-group">
			<input type="text" autocomplete="off" class="form-control form-control-lg text-center" id="name" aria-describedby="nameHelp" placeholder="Enter Name" required>
			<small id="nameHelp" class="form-text text-muted">
				Required. Name can be anything. The same namespace with the same name will always produce the same UUID.
			</small>
		</div>

		<p class="error text-danger"></p>

		<button class="btn btn-primary btn-lg" type="submit" id="generate-single"> Generate UUID <i class="fas fa-redo-alt"></i> </button>
	</form>
</div>

</div></div> <!-- ughh... close surrounding card so we can place results outside of the card... -->

		<div class="mb-2 mx-2 border border-top-0 border-secondary rounded-bottom" style="min-height: 20px;">
			<div id="results-wrapper" style="display:none">

				<div class="clearfix">
					<h3 class='ml-3 pt-3 float-left'>Results:</h3>
					<div class="float-right mr-2 pt-3">
						<span id="copied-label" class="text-primary mr-2" style="display: none;">copied!</span>
						<input id="api-copy-input" type="text" style="position:absolute; top: -9999px; z-index: -9;" value="">
						<input id="single-copy-input" type="text" style="position:absolute; top: -9999px; z-index: -9;" value="">
						<button id="api-copy-button" class="btn btn-outline-primary btn-sm"> <i class="fas fa-code"></i> Copy API Call </button>
						<button id="uuid-copy-button" class="btn btn-outline-primary btn-sm"> <i class="fas fa-code"></i> Copy UUID </button>
					</div>
				</div>

				<div class="text-center mx-4 my-5">
					<code id="results"></code>
				</div>

			</div>
		</div>


<div><div> <!-- Okay, then reopen two more div so divs match up in the final document -->

@push('scripts')
<script>

	$('#ns-switch').on('change', function() {
		if ($('#ns-switch').is(":checked")) {
			$('#custom-namespace').hide();
			$('#namespace-custom-input').remove();
			$('#predefined-namespace').show();
		} else {
			input = $('<input>').attr({
				autocomplete: "off", class: "form-control form-control-lg text-center",
				id: "namespace-custom-input", type: "text", placeholder: "Enter Namespace UUID",
				required: 'true', pattern: "[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}",
				"aria-describedby": "namespaceHelpCustom"
			})
			$('#custom-namespace').prepend(input);
			$('#custom-namespace').show();
			$('#predefined-namespace').hide();
		}
	});

	$('#autofill').on('click', function(event) {
		event.preventDefault();
		versions = ['v1', 'v4'];
		version = versions[Math.floor(Math.random() * versions.length)];
		$.ajax({
			url: '/api/generate/' + version,
			success: function(data) {
				$('#namespace-custom-input').val(data[0]);
			}
		})
	});

	var lastNamespace = "";
	var lastName = "";
	$("#generate-form").submit(function(event) {
		event.preventDefault();
		if (lastNamespace == getNamespace() && lastName == $('#name').val()) return;
		get_results();
	});

	function getNamespace() {
		if ($('#ns-switch').is(":checked")) {
			return $('#namespace-predefined-input').val();
		} else {
			return $('#namespace-custom-input').val();
		}
	}

	$('#uuid-copy-button').on('click', function() {
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

	function get_results() {
		lastNamespace = getNamespace();
		lastName = $('#name').val();
		url = "/api/generate/v5/namespace/" + getNamespace() + "/name/" + $('#name').val();
		$('#api-copy-input').val('https://www.uuidtools.com' + url);

		$.ajax({
			url: url,
			success: function(data) {
				$('.error').html("");
				fitty('#results');
				$('#results').html(data[0]);
				$('#single-copy-input').val(data[0]);
				$('#results-wrapper').slideDown();
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
