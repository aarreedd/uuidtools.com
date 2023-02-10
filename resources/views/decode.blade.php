{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>UUID Decoder | {{ config('app.name') }}</title>
	<meta name="description" content="UUID Decoder. Enter a UUID to see version information, and more."/>

	<link rel="canonical" href="https://www.uuidtools.com/decode" />
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		<h1 class="border-bottom border-primary border-3 mb-0 font-weight-bold">
			<i class="fas fa-fingerprint text-primary"></i>
			UUID Decoder
		</h1>

		<div class="card mb-0 bg-light">
			<div class="card-body text-center">

				<form id="decode-form">
					<div class="form-group">
						<label for="uuid" class="mt-2 font-weight-bold">Enter UUID to Decode:</label>
						<input type="text" required autocomplete="off" pattern="[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}" class="form-control form-control-lg text-center" id="uuid" aria-describedby="uuidHelp" placeholder="Enter UUID">
						<small id="uuidHelp" class="form-text text-muted">UUIDs are in the format 00000000-0000-0000-0000-000000000000. <a href="#" id="autofill">Autofill with random UUID <i class="fas fa-random"></i></a></small>
					</div>
					<button class="btn btn-primary btn-lg" type="submit" id="decode-submit"> Decode UUID <i class="fas fa-key"></i> </button>
				</form>

				<input id="api-copy-input" type="text" style="position:absolute; top: -9999px; z-index: -9;" value="">
			</div>
		</div>

		<div class="mb-2 mx-2 border border-top-0 border-secondary rounded-bottom" style="min-height: 20px;">
			<div id="results-wrapper" style="display:none">

				<h3 class='ml-3 pt-3 float-left'>Results:</h3>
				<div class="float-right mr-2 pt-3">
					<span id="copied-label" class="text-primary mr-2" style="display: none;">copied!</span>
					<button id="api-copy-button" class="btn btn-outline-primary btn-sm"> <i class="fas fa-code"></i> Copy API Call </button>
				</div>

				<div id="results"></div>

			</div>
		</div>

		<div class="row mb-3 mt-5">
			<div class="col-md-8 order-12 order-md-1">
				<h3 class="mb-3 font-italic border-bottom">
					How to decode a UUID
				</h3>
				<p>
					Embedded in every UUID is the <u>version</u> and <u>variant</u> of the UUID.
					Other information such as the time the UUID was generated can also be extracted in some cases.
					The tool above extracts this information automatically.
				</p>
				<p>
					The UUID <i>version</i> is represented by the 13th digit of a hexadecimal UUID string ("M" in the diagram below).
					The <i>variant</i> is represented in the 17th digit ("N" in the diagram below).
				</p>
				<figure class="figure border rounded border-secondary p-2">
					<img src="/img/version_diagram_uuidtools_com.png" class="figure-img img-fluid rounded" alt="diagram showing UUID version and variant bits">
					<figcaption class="figure-caption">The version and variant are encoding within UUIDs.</figcaption>
				</figure>

				<p>
					The version is straight forward to decode.
					If digit M is 1 then the UUID is version-1, if M is 3 then the UUID is version-3, etc.
				</p>

				<h4 class="mt-5">Version Digit ("M")</h4>
				<table class="table text-center table-bordered mb-5">
					<thead><tr><th>Hex Digit</th><th>UUID Version</th></tr></thead>
					<tobdy>
						<tr><td>1</td><td>version-1</td></tr>
						<tr><td>2</td><td>version-2</tr>
						<tr><td>3</td><td>version-3</td></tr>
						<tr><td>4</td><td>version-4</td></tr>
						<tr><td>5</td><td>version-5</td></tr>
						<tr><td>6 - f, 0</td><td class="text-muted">version unknown</td></tr>
					</tobdy>
				</table>

				<p>
					The variant is slightly more complicated.
					To understand how the variant is encoding you must first understand how hexadecimals work.
				</p>
				<p>
					UUIDs are written in hexadecimal which means each digit can be a number from 0 to 9 or a letter from a to f.
					That is 16 possibilities for each digit. So each hexadecimal digit represents 4 bits.
					There are 32 hex digits in a UUID times 4 bits gives a total of 128 bits in a UUID.
				</p>
				<p>
					To determine the variant you look at the bits of the 17th hex digit in a UUID.
					For example, if the 4 binary digits begin "10" then the variant is "DCE 1.1, ISO/IEC 11578:1996".
					If the binary digits begin "110" then the UUID is a "Microsoft GUID".
					See the table below for full break down.
				</p>

				<p>
					Only the number of leading "1"s matters.
					The bits after first 0 in the 17th hex digit are considered part of the "contents" of the UUID.
					"Contents" is a combination of time and machine identifier for version-1 UUIDS,
					for version-4 UUIDs contents is random,
					and for version-3 and version-5 the contents is a hash of the namespace and name.
				</p>
				<p>
					<a href="/uuid-versions-explained">Learn more about UUID versions &raquo;</a>
				</p>

				<h4 class="mt-5">Variant digit ("N")</h4>
				<table class="table text-center table-bordered">
					<thead><tr><th>Binary Representation <span class="text-muted">&Dagger;</span></th><th>Hex Digit</th><th>Variant</th></tr></thead>
					<tobdy>
						<tr><td class="text-monospace">0xxx</td><td>0 - 7</td><td>reserved (NCS backward compatible)</td>
						<tr><td class="text-monospace">10xx</td><td>8 - b</td><td>DCE 1.1, ISO/IEC 11578:1996</td>
						<tr><td class="text-monospace">110x</td><td>c - d</td><td>reserved (Microsoft GUID)</td>
						<tr><td class="text-monospace">1110</td><td>e</td><td>reserved (future use)</td>
						<tr><td class="text-monospace">1111</td><td>f</td><td>unknown / invalid. Must end with "0"</td>
					</tobdy>
				</table>
				<p><i class="text-muted small">&Dagger; "x" in the binary representation indicates the bit is not significant for determining the variant.</i></p>


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

<script>
	var lastLookup = "";

	$("#decode-form").submit(function(event) {
		event.preventDefault();
		if (lastLookup == $('#uuid').val()) return; // No need to lookup again..
		get_results();
	});

	function get_results() {
		lastLookup = $('#uuid').val();
		url = '/api/decode/' + $('#uuid').val();
		$("#api-copy-input").val('https://www.uuidtools.com' + url);
		$.ajax({
			url: url,
			success: function(data) {
				table = $("<table>").addClass('table mb-0 table-bordered table-hover');
				tbody = $("<tbody>");
				tbody.append($('<tr>').append("<th>Standard String Format</th><td>" +format_result(data['encode']['STR'])+ "</td>"))
				tbody.append($('<tr>').append("<th>Single Integer Value</th><td>" +format_result(data['encode']['SIV'])+ "</td>"))
				tbody.append($('<tr>').append("<th>Version</th><td>" +format_result(data['decode']['version'])+ "</td>"))
				tbody.append($('<tr>').append("<th>Variant</th><td>" +format_result(data['decode']['variant'])+ "</td>"))

				if (typeof data['decode']['contents'] == "string") {
					tbody.append($('<tr>').append("<th>Contents</th><td>" + format_result(data['decode']['contents']) + "</td>"))
				}
				else
				{
					tbody.append($('<tr>').append("<th>Contents - Time</th><td>" + format_result(data['decode']['contents']['time']) + "</td>"))
					tbody.append($('<tr>').append("<th>Contents - Clock</th><td>" + format_result(data['decode']['contents']['clock']) + "</td>"))
					tbody.append($('<tr>').append("<th>Contents - Node</th><td>" + format_result(data['decode']['contents']['node']) + "</td>"))
				}

				table.append(tbody);
				$('#results').html("");
				$('#results').append(table);
				$('#results-wrapper').slideDown();

			}
		});
	}

	function format_result(input)
	{
		parts = input.split('(');
		if (parts.length == 1) {
			return input;
		}
		return parts[0] + " <span class='text-muted font-italic'>(" + parts[1] + "</span>";
	}

	$('#api-copy-button').on('click', function() {
		$('#copied-label').show().fadeOut('slow');
		document.getElementById('api-copy-input').select();
		document.getElementById('api-copy-input').setSelectionRange(0, 99999);
		document.execCommand("copy");
	});

	$('#autofill').on('click', function(event) {
		event.preventDefault();
		versions = ['v1', 'v4'];
		version = versions[Math.floor(Math.random() * versions.length)];
		$.ajax({
			url: '/api/generate/' + version,
			success: function(data) {
				$('#uuid').val(data[0]);
			}
		})
	});
</script>
</script>
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "BreadcrumbList",
	"itemListElement": [{
		"@type": "ListItem",
		"position": 1,
		"name": "UUID Decoder",
		"item": "https://www.uuidtools.com/decode"
	}]
}
</script>
@endpush
