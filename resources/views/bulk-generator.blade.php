{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>Bulk UUID Generator | {{ config('app.name') }}</title>
	<meta name="description" content="Bulk UUID Generator and API"/>

	<link rel="canonical" href="https://www.uuidtools.com/generate/bulk" />
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		<h1 class="border-bottom border-primary border-3 mb-0 font-weight-bold">
			<i class="fas fa-fingerprint text-primary"></i>
			Bulk UUID Generator
		</h1>

		<div class="card mb-2 bg-light">
			<div class="card-body">

				<div class="row">
					<div class="col-md-6">
						<form id="bulk-form">
							<div class="form-group">
								<label for="count">Number of UUIDs to generate:</label>
								<input type="number" min=1 max=100 class="form-control" id="count" aria-describedby="countHelp" value=10>
								<small id="countHelp" class="form-text text-muted">Number between 1 and 100.</small>
							</div>
							<div class="form-group">
								<label for="version">UUID Version:</label>
								<select class="form-control" id="version" aria-describedby="versionHelp">
									<option value="v1">Version-1</option>
									<option value="v4">Version-4</option>
									<option value="timestamp-first">Timestamp-first</option>
								</select>
								<small id="versionHelp" class="form-text text-muted"><a href="/generate/v3">Version-3</a> and <a href="/generate/v5">version-5</a> are deterministic. They have no random component so all UUIDs would be the same. For this reason, they are not available in the bulk generator. <a href="/uuid-versions-explained">UUID versions explained &raquo;</a></small>
							</div>
							<p class="error text-danger"></p>
							<button type="submit" id="generate" class="btn btn-primary btn-block">Generate <i class="fas fa-redo-alt"></i></button>
						</form>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="results">Results:</label>
							<textarea class="form-control form-control-sm" id="results" rows="10"></textarea>
						</div>
						<input id="api-copy-input" type="text" style="position:absolute; top: -9999px; z-index: -9;" value="">
						<button id="api-copy-button" class="btn btn-outline-primary btn-sm float-right ml-2"> <i class="fas fa-code"></i> Copy API Call </button>
						<button id="download-button" class="btn btn-outline-primary btn-sm float-right"> <i class="fas fa-download"></i> Download </button>
						<span id="copied-label" class="float-right text-primary mr-2" style="display: none;">copied!</span>
					</div>
				</div>

			</div>
		</div>

		<div class="mb-3">
			<div class="fb-like" data-href="https://www.uuidtools.com" data-width="" data-layout="standard" data-action="recommend" data-size="large" data-show-faces="false" data-share="true"></div>
		</div>

		<div class="row mb-3 mt-5">
			<div class="col-md-8 order-12 order-md-1">
				<h3 class="mb-3 font-italic border-bottom">
					Bulk UUID Generator
				</h3>
				<p>
					The bulk UUID generate produces up to 100 UUIDs at a time.
					Use the dropdown to select the UUID version you need: version-1, version-4, or timestamp-first UUIDs (an unofficial variant of version-4).
				</p>
				<p>
					You can download the list of generated UUIDs or use our API to generate UUIDs automatically.
					There is a button above to copy the exact API call you need to generate bulk UUIDs.
					You can be confident that the UUIDs generated will be globally unique. 
					Statistically it is extraordinarily unlikely that our system will ever generate the same exact UUID twice.
				</p>
				<p>
					You cannot generate <a href="/generate/v3">version-3</a> and <a href="/generate/v3">version-5</a> UUIDs in bulk because they require unique input for each UUID.
					You must generate each one individually. 
				</p>

			</div>

			<aside class="col-md-4 order-6">

			</aside>
		</div>
	</div>
@endsection


{{-- ============================================================================== --}}
{{-- ==                               Page Scripts                               == --}}
{{-- ============================================================================== --}}
@push('scripts')
<script src="{{ mix('js/FileSaver.js') }}"></script>
<script>

	$("#bulk-form").submit(function(event) {
		event.preventDefault();
		get_results();
	});

	$(document).ready(function() {
		get_results();
	});

	$('#results').on('focus', function() {
		document.getElementById('results').select();
		document.getElementById('results').setSelectionRange(0, 99999);
		document.execCommand("copy");
		$('#copied-label').show().fadeOut('slow');
	})

	$('#download-button').on('click', function() {
		var blob = new Blob([$('#results').val()], {type: "text/plain;charset=utf-8"});
		saveAs(blob, "uuids.txt");
	});


	$('#api-copy-button').on('click', function() {
		$('#copied-label').show().fadeOut('slow');
		document.getElementById('api-copy-input').select();
		document.getElementById('api-copy-input').setSelectionRange(0, 99999);
		document.execCommand("copy");
	});

	function get_results() {
		url = "/api/generate/" + $("#version").val() + "/count/" + $("#count").val();
		$('#api-copy-input').val("https://www.uuidtools.com" + url);

		$.ajax({
			url: url,
			success: function(data) {
				$('.error').html("");
				$("#results").val(data.join("\n"))
			},
			error: function(jqXHR, textStatus, errorThrown) {
				if (jqXHR.status == 429) {
					$('.error').html('Too many requests. Please wait 1 minute.');
					$('#generate').prop('disabled', true);
					setTimeout(function() {
						$('.error').html('');
						$('#generate').prop('disabled', false);
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
