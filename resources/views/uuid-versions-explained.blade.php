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
					There are 5 UUID version plus one common unofficial version.
					We will explain each of these versions as well as their purpose and when to use them.
					For more details, see the official <a href="https://tools.ietf.org/html/rfc4122">UUID RFC 4122</a>.
				</p>


				<a href="#" name=version-1></a>
				<h2 class="mt-4">UUID Version-1</h2>

				<p>
					<b>Version-1 is based on the current time and the MAC address for the computer or "node" generating the UUID.</b>
				</p>
				<p>
					RFC 4122 states timestamp is number of nanoseconds since October 15, 1582 at midnight UTC.
					Most computers do not have a clock that ticks fast enough to measure time in nanoseconds.
					Instead, a random number is often used to fill in timestamp digits beyond the computer's measurement accuracy.
					When multiple version-1 UUIDs are generated in a single API call the random portion may be incremented rather than regenerated for each UUID.
					This ensures uniqueness and is faster to generate.
				</p>
				<p>
					The last 12 hex digits of a UUID string represent the <a href="https://en.wikipedia.org/wiki/MAC_address" target=_blank rel="noopener">MAC address</a> of the node.
					In some implementations (including the <a href="/generate">UUID generator</a> on this site) a random MAC address is used instead of the node's actual MAC.
				</p>

				<p>
					MAC Address and creation time can be extracted using our <a href="/decode">UUID decode tool</a>.
					MAC Addresses are unique to the computer generating them.
					By including a MAC address in the UUID you can be sure that two different computers will never generate the same UUID.
					Because MAC addresses are globally unique, version-1 UUIDs can be traced back to the computer that generated them.
				</p>

				<figure class="figure border rounded border-secondary p-2">
					<img src="/img/version_1_diagram.png" class="figure-img img-fluid rounded" alt="Diagram showing records layout for UUID version-1">
					<figcaption class="figure-caption">Records Layout for UUID version-1.</figcaption>
				</figure>

				<a href="#" name=version-2></a>
				<h2 class="mt-4">UUID Version-2</h2>
				<p>
					Version-2 is called "DCE security" UUIDs in RFC 4122. Further details are not provided in the official RFC so our implementation omits version-2.
					<a href="https://pubs.opengroup.org/onlinepubs/9696989899/chap5.htm#tagcjh_08_02_01_01">Version-2 specifications</a> are, however, published by DCE.
				</p>

				<a href="#" name=version-3-version-5></a>
				<h2 class="mt-4">UUID Version-3 vs UUID Version-5</h2>

				<p>
					Version-3 and version-5 are generated based on a "namespace" and unique "name".
					<b>
						Namespace and name are concatenated and hashed.
						There is no temporal or random component to either versions so the same input produces the same output every time.
					</b>
				</p>
				<ul>
					<li>namespace &mdash; a UUID</li>
					<li>name &mdash; can be anything</li>
				</ul>

				<p><b>What is the difference between version-3 and version-5?</b></p>
				<ul>
					<li>Version-3 UUIDs are based on an <u>MD5</u> hash of the name and namespace.</li>
					<li>Version-5 UUIDs are based on a <u>SHA-1</u> hash of the name and namespace.</li>
				</ul>
				<p>
					A SHA-1 hash is too long to be used in a UUID so it is truncated.
				</p>
				<p>
					The UUID specification establishes 4 pre-defined namespaces.
					The pre-defined namespaces are:
					<ul>
						<li>DNS &mdash; <code>6ba7b810-9dad-11d1-80b4-00c04fd430c8</code></li>
						<li>URL &mdash; <code>6ba7b811-9dad-11d1-80b4-00c04fd430c8</code></li>
						<li>OID &mdash; <code>6ba7b812-9dad-11d1-80b4-00c04fd430c8</code></li>
						<li>X.500 DN &mdash; <code>6ba7b814-9dad-11d1-80b4-00c04fd430c8</code></li>
					</ul>
				</p>
				<p>
					When a pre-defined namespace identifier is used we convert that identifier to a UUID internally.
				</p>
				<p>
					When using our <a href="/generate/v3">version-3</a> or <a href="/generate/v3">version-5</a> UUID generators you will be asked to enter a "namespace" (or pre-defined UUID identifier) and "name".
				</p>

				<a href="#" name=version-4></a>
				<h2 class="mt-4">UUID Version-4</h2>
				<p>
					<b>Version-4 UUIDs are randomly generated.</b>
					There are over 5.3 x 10<sup>36</sup> unique v4 UUIDs.
					This is the most common UUID version.
				</p>
				<p>
					Version-4, variant-2 is called a "GUID" on Microsoft systems.
				</p>

				<a href="#" name=timestamp-first></a>
				<h2 class="mt-4">Timestamp-first UUIDs</h2>
				<p>
					Timestamp-first are not mentioned in the UUID RFC; however, they are a common variation of version-4 UUIDs.
					This format is sometimes called "Ordered UUIDs" or "COMB" (combined time-GUID).
				</p>
				<p>
					This version starts with the current time followed by randomness.
					There are two main reason for beginning UUIDs with the current timestamp:
					<ol>
						<li>When sorting by UUID they will appear in the order created</li>
						<li>Ordered UUIDs can be more efficiently stored indexed columns in databases compared to random UUIDs</li>
					</ol>
				</p>
				<p>
					There are several variations of timestamp-first UUIDs in different implementations because there is not agreed upon specification.
					However, generally the first 8 hex digits represent the time and the remaining digits are random. 
				</p>
				<p>
					If you are using UUIDs as a primary key in a database you should use timestamp-first UUIDs.
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