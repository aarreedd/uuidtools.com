{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>UUID Generator API | {{ config('app.name') }}</title>
	<meta name="description" content="Free UUID/GUID Generator API. Create single or bulk UUIDs. UUID v1, v3, v4, and v5. "/>

	<link rel="canonical" href="https://www.uuidtools.com/docs" />
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		@component('components.breadcrumbs')
			<li class="breadcrumb-item active" aria-current="page">API Documentation</li>
		@endcomponent

		<h1 class="border-bottom border-primary border-3 font-weight-bold"><i class="fas fa-fingerprint text-primary"></i> API Documentation <span class="text-muted small">Free UUID Generator API</span></h1>

		<div class="row my-4">
			<div class="col-md-8 order-12 order-md-1">
				<a href="#" name=intro></a>
				<p>
					Welcome to our super simple UUID API.
					This API allows you to create UUIDs and GUIDs quickly on-the-fly for testing purposes.
					<b>No authentication is required.</b>
				</p>
				<p>
					We support generating all major UUID versions including <u>version-1, version-3, version-4, version-5 and "timestamp-first" UUIDs</u>.
					Read more about <a href="/uuid-versions-explained">different UUID versions</a>.
					No authentication is required. This is the same API that powers our <a href="/generate">UUID generator</a>.
				</p>
				<p>
					Endpoints that accept a count argument allow you to create up to 100 UUIDs at once.
					All endpoints are limited to 60 requests per minute per IP address.
				</p>

				<hr>

				@include('partials.fb-like')

				<a href="#" name=version-1></a>
				<h3 class="mt-5 font-weight-bold">Version-1 UUID API</h3>

				<p>
					Version-1 UUIDs are based on time, the computer generating the UUID (in this case, it's our server), and pseudo-randomness.
				</p>

				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v1</pre></code>
				</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v1/count/10</pre></code>
				</p>

				<hr>
				<a href="#" name=version-2></a>
				<h3 class="mt-5 font-weight-bold">Version-2 UUID API</h3>
				<p>
					We do not provide a version-2 UUID generator. Learn more about the <a href="/uuid-verions-explained">different UUID versions</a>.
				</p>

				<hr>
				<a href="#" name=version-3></a>
				<h3 class="mt-5 font-weight-bold">Version-3 UUID API</h3>
				<p>
					Version-3 UUIDs are deterministic and are based on an MD5 hash of the namespace place name you supply.
					If you provide the same input you will get the same output every time.
					This API does not allow you to generate multiple UUIDs at once because they would all be the same.
				</p>
				<p>Namespace must be "ns:url", "ns:dns", "ns:OID", "ns:X500" or a properly formatted UUID. Name is a string of any length.</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v3/namespace/ns:url/name/https://www.google.com/</pre></code>
				</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v3/namespace/b01eb720-171a-11ea-b949-73c91bba743d/name/anything-goes-here</pre></code>
				</p>


				<hr>
				<a href="#" name=version-4></a>
				<h3 class="mt-5 font-weight-bold">Version-4 UUID API</h3>
				<p>
					Version-4 UUIDs are similar to version-1. Both are randomly generated. Version-1 is based, in part, on the time while version-4 is not.
				</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v4</pre></code>
				</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v4/count/10</pre></code>
				</p>

				<hr>
				<a href="#" name=version-5></a>
				<h3 class="mt-5 font-weight-bold">Version-5 UUID API</h3>

				<p>
					Version-5 UUIDs are similar to version-3. Both versions are deterministic based on a namespace and name.
					The main differences is SHA-1 algorithm is used instead of MD5.
				</p>
				<p>Namespace must be "ns:url", "ns:dns", "ns:OID", "ns:X500" or a properly formatted UUID. Name is a string of any length.</p>

				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v5/namespace/ns:url/name/https://www.uuidtools.com/generate</pre></code>
				</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/generate/v5/namespace/b01eb720-171a-11ea-b949-73c91bba743d/name/anything-goes-here</pre></code>
				</p>

				<hr>
				<a href="#" name=timestamp-first></a>
				<h3 class="mt-5 font-weight-bold">Timestamp-first UUID API</h3>
				<p>
					Timestamp-first (also, called "timestamp-first" or "ordered UUIDs") are similar to version-1 and version-4 UUIDs.
					These UUIDs have the current timestamp embedded in them to insure uniqueness.
					What is special about Timestamp-first UUIDs is that timestamp is at the beginning of the UUID so when stored in a database they will appear in the order they were created.
					This can be useful for many purposes and also is more efficient for storing in indexed database columns.
				</p>

				<p>
					<code><pre>https://www.uuidtools.com/api/generate/timestamp-first</pre></code>
				</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/generate/timestamp-first/count/10</pre></code>
				</p>

				<hr>
				<a href="#" name=decode></a>
				<h3 class="mt-5 font-weight-bold">Decode UUID API</h3>
				<p>
					This fun API endpoint will tell you what version a specific UUID is.
				</p>
				<p>
					<code><pre>https://www.uuidtools.com/api/decode/b01eb720-171a-11ea-b949-73c91bba743d</pre></code>
				</p>
				<h4>Response</h4>
				<p>
					<code>
<pre>{
	encode: {
		STR: "b01eb720-171a-11ea-b949-73c91bba743d",
		SIV: "234103610387309579079392911688732406845"
	},
	decode: {
		variant: "DCE 1.1, ISO/IEC 11578:1996",
		version: "1 (time and node based)",
		content: {
			time: "2019-12-05 04:49:57.961296.0 UTC",
			clock: "14665 (usually random)",
			node: "73:c9:1b:ba:74:3d (local multicast)"
		}
	}
}</pre>
					</code>
				</p>
			</div>
			<div class="col-md-4 order-6">
				<div class="card bg-light mb-3">
					<div class="card-body">
						<h4 class="font-italic">Table of Contents</h4>
						<ul>
							<li><a href="#intro">Introduction</a>
							<li><a href="#version-1">Version-1 UUID API</a>
							<li><a href="#version-2">Version-2 UUID API</a>
							<li><a href="#version-3">Version-3 UUID API</a>
							<li><a href="#version-4">Version-4 UUID API</a>
							<li><a href="#version-5">Version-5 UUID API</a>
							<li><a href="#timestamp-first">Timestamp-first UUID API</a>
							<li><a href="#decode">Decode UUID API</a>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection


{{-- ============================================================================== --}}
{{-- ==                               Page Scripts                               == --}}
{{-- ============================================================================== --}}
@push('scripts')
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "BreadcrumbList",
		"itemListElement": [{
			"@type": "ListItem",
			"position": 1,
			"name": "API Documentation",
			"item": "https://www.uuidtools.com/docs"
		}]
	}
	</script>
@endpush