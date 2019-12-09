{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>UUID Versions Explained | {{ config('app.name') }}</title>

	<link rel="canonical" href="https://www.uuidtools.com/uuid-versions-explained" />
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">UUID Versions Explained</h1>
			<p class="lead text-muted">Why are there so many UUID versions and when to use them?</p>
		</div>
	</section>

	<div class="container mt-4">

		@component('components.breadcrumbs')
			<li class="breadcrumb-item active" aria-current="page">UUID Versions Explained</li>
		@endcomponent

		<div class="row">
			<div class="col-md-8 order-12 order-md-1">

				<p>
					There are 5 UUID version, each with 2 variants, plus one common unofficial version.
					We will explain each of these versions as well as their purpose and when to use them.
					For more details, see the official <a href="https://tools.ietf.org/html/rfc4122">UUID RFC 4122</a>.
				</p>


				<a href="#" name=version-1></a>
				<h2 class="mt-4">UUID Version-1</h2>

				<p>
					<b>Version-1 is based on the current time and the MAC address for the computer or "node" generating the UUID.</b>
				</p>
				<p>
					Per RFC 4122, timestamp is number of nanoseconds since October 15, 1582 at midnight UTC.
					Most computers do not have a clock that ticks fast enough to measure time in nanoseconds.
					Instead, a random number is often used to fill in timestamp digits beyond the computer's measurement accuracy.
					When multiple version-1 UUIDs are generated in a single API call the random portion may be incremented rather than regenerated for each UUID.
					This ensures uniqueness and is faster to generate.
				</p>
				<p>
					The last 12 hex digits of a UUID string represent the MAC address of the node.
					In some implementations (including the UUID generator on this site) a random MAC address is used instead of the node's actual MAC.
				</p>

				<p>
					MAC Address and creation time can be extracted using our <a href="/decode">UUID decode tool</a>.
					MAC Addresses are unique to the computer generating them.
					By including a MAC address in the UUID you can be sure that no 2 computers will generate the same UUID.
					Because MAC addresses are unique, version-1 UUIDs can be traced back to the computer that generated them.
				</p>

				<a href="#" name=version-2></a>
				<h2 class="mt-4">UUID Version-2</h2>
				<p>
					Version-2 is called "DCE security" UUIDs in RFC 4122. Further details are not provided in the RFC so our implementation omits version-2.
				</p>

				<a href="#" name=version-3-version-5></a>
				<h2 class="mt-4">UUID Version-3 vs UUID Version-5</h2>

				<p>
					Version-3 and version-5 are based on "namespace" and unique "name".
					There is no temporal or random component to either versions.
					<b>
						Namespace and name and concatenated and hashed. The same input produces the same output every time.
					</b>
					The "namespace" is itself a UUID. The "name" can be anything.
				</p>

				<p>
					The key difference between version-3 and version-5 is that version-3 uses MD5 hash algorithm while version-5 uses SHA-1 hashes.
					SHA-1 hash is too long to be used in a UUID so the SHA-1 hash is truncated before generating the final UUID.
				</p>
				<p>
					There are also 4 pre-defined namespace UUIDs from the RFC specification.
					These pre-defined namespaces are:
					<ul>
						<li>DNS &mdash; <code>6ba7b810-9dad-11d1-80b4-00c04fd430c8</code></li>
						<li>URL &mdash; <code>6ba7b811-9dad-11d1-80b4-00c04fd430c8</code></li>
						<li>OID &mdash; <code>6ba7b812-9dad-11d1-80b4-00c04fd430c8</code></li>
						<li>X.500 DN &mdash; <code>6ba7b814-9dad-11d1-80b4-00c04fd430c8</code></li>
					</ul>
				</p>
				<p>
					When a pre-defined namespace identifier is used  we convert the identifier to UUID internally.
				</p>
				<p>
					When using our <a href="/generator/v3">version-3</a> or <a href="/generator/v3">version-5</a> UUID generators you will be asked to enter a "namespace" and "name".
				</p>

				<a href="#" name=version-4></a>
				<h2 class="mt-4">UUID Version-4</h2>
				<p>
					UUID is randomly generated.
					There are over 5.3 x 10<sup>36</sup> unique v4 UUIDs.
					This is the most common UUID version.
					Version-4, variant-2 is called a "GUID" on Microsoft systems.
				</p>

				<a href="#" name=timestamp-first></a>
				<h2 class="mt-4">Timestamp-first UUIDs</h2>
				<p>
					Not an official RFC 4122 compliant UUID.
					This version starts with the current time followed by randomness.
					The reason for beginning UUIDs with the current timestamp is to make them ordered which makes storing in an indexed database column more efficient.
				</p>
				<p>
					If you are using UUIDs as a primary key in a database then timestamp-first UUIDs should be used.
				</p>

				<a href="#" name=nil-uuid></a>
				<h2 class="mt-4">Nil UUIDs</h2>

				<p>
					 This special case UUID is guaranteed to <u>not</u> be unique. <b>The Nil UUID is all zeros: 00000000-0000-0000-0000-000000000000</b>
				</p>
				<p>
					This UUID might be used as a template for the format of UUIDs or when you need an easily identified UUID that is guaranteed to not be unique.
				</p>

				<hr class="my-4">

				<p>
					<b>To determine the version of a UUID and to extract any information such as creation time (when available) use our <a href="/decode">UUID decode tool</a>.</b>
				</p>

			</div>
			<div class="col-md-4 order-6">
				<div class="card bg-light mb-4">
					<div class="card-body">
						<h4 class="font-italic">Table of Contents</h4>
						<ul class="mb-0">
							<li><a href="#version-1">Version-1 UUID</a></li>
							<li><a href="#version-2">Version-2 UUID</a></li>
							<li><a href="#version-3-version-5">Version-3 vs Verion-5 UUID</a></li>
							<li><a href="#version-4">Version-4 UUID</a></li>
							<li><a href="#timestamp-first">Timestamp-first UUID</a></li>
							<li><a href="#nil-uuid">Nil UUID</a></li>
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
<script>
	// Page specific JS goes here...
</script>
@endpush