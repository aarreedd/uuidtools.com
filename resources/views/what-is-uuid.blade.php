{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>Complete guide to Universal Unique Identifiers (UUID) | {{ config('app.name') }}</title>

	<link rel="canonical" href="https://www.uuidtools.com/what-is-uuid" />
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		@component('components.breadcrumbs')
			<li class="breadcrumb-item active" aria-current="page">What are UUIDs?</li>
		@endcomponent

		<h1 class="border-bottom mb-4 border-primary border-3 font-weight-bold">
			<i class="fas fa-fingerprint text-primary"></i>
			What's a UUID? <br>
			<span class="text-muted small">What are Universal Unique Identifiers and how do they work?</span>
		</h1>

		<div class="row">
			<div class="col-md-8 order-12 order-md-1">

				<a href="#" name=overview></a>
				<h2>Overview</h2>

				<p>
					UUID stands for <b>Universally Unique Identifier</b> (sometimes called "GUID" or "Globally Unique Identifiers").
					UUIDs are 36 character strings containing numbers, letters and dashes.
					UUIDs are designed to be globally unique.
				</p>
				<p>
					There are several <a href="/uuid-versions-explained">UUID versions</a> with slightly different purposes.
					In UUID version-4, which is completely random, there are approximately 5.3 x 10<sup>36</sup> possible UUIDs.
					This number is so large that if you were to generate 1 billion UUIDs per second for 85 you have a 50% chance of creating a duplicate.
				</p>
				<p>
					The chances of a duplicate UUID are so low it is safe to assume each ID will be unique.
					Separate computers can generate UUIDs at the same time with no communication and still be confident the UUIDs are unique.
					Independent systems that use UUIDs can be safely merged at any time without worrying about collisions.
				</p>
					This is an extremely useful property as many computer systems today are distributed.
				</p>
				<p>
					UUIDs can be generated locally; there is no central authority for coordination or registration.
					UUIDs have the lowest minting cost of any system of unique identification.
					Most programming languages have a way to generate UUIDs which makes makes them useful for compatibility across systems.
				</p>
				<p>
					You can even use an <a href="/generate">online UUID generator</a> and still be confident the ID is globally unique.
				</p>
				<p>
					UUID standards are formalized in <a href="https://tools.ietf.org/html/rfc4122">RCF 4122</a> published in 2005.
				</p>


				<a href="#" name=format></a>
				<h2 class="mt-4">UUID Format</h2>

				<p>
					UUIDs are written in 5 groups of hexadecimal digits separated by hyphens.
					The length of each group is: 8-4-4-4-12.
					UUIDs are fixed length.
					For example: 123e4567-e89b-12d3-a456-426655440000
				</p>
				<p>
					UUIDs have 32 digits plus 4 hyphens for a total of 36 characters. UUIDs are fixed length.
					UUIDs are 128-bits in binary. (32 hex digits x 4 bits per hex digit = 128-bits).
				</p>

				<p>
					UUIDs may also be represented in decimal or binary format.
				</p>

				<table class="table table-bordered table-hover">
					<thead><tr><th>Format</th><th>Example</th></tr></thead>
					<tbody>
						<tr><th>Hexadecimal</th><td>123e4567-e89b-12d3-a456-426655440000</td></tr>
						<tr><th>Decimal</th><td>190464649652423269416550308090595239059</td></tr>
						<tr><th>Binary</th><td>10001111 01001010 00101000 00111110 11111111 10100101 01001010 00100100 10100010 01110111 00000001 11000110 00001000 10010011 11100100 10010011</td></tr>
					</tbody>
				</table>


				<a href="#" name=collisions></a>
				<h2 class="mt-4">Can a UUID be repeated?</h2>
				<p>
					UUID collisions are extremely unlikely.
				</p>
				<p>
					With UUID version-1 the MAC address of the computer generating the UUID in embedded in the UUID.
					MAC Addresses are unique on every computer with a network card.
					This makes it impossible for 2 different computers to generate the same UUID if both adhere to the specification.
					The timestamp is also including in the UUID to ensure uniqueness.
					The timestamp field will rollover in 5236 AD. So there is no chance of duplicate until then.
				</p>
				<p>
					With version-4 there is an exceptionally small chance of duplicate.
				</p>
				<p>
					With version-4 UUIDs, which are totally random, there are approximately 5.3 x 10<sup>36</sup> possible UUIDs.
					With numbers that large the chances of any two people in the whole world ever generating the same UUID are astronomically small.
					The chances are so small that it is generally safe to assume it will never happen.
				</p>
				<p>
					With version-3 and version-5, the UUID output is based on the input you provide.
					As long as the input provided is random, the chances of duplication are the same as for version-4.
				</p>
				<p>
					<a href="/uuid-versions-explained">Learn more about UUID Versions &raquo;</a>
				</p>

				<a href="#" name=regular-expression></a>
				<h2>UUID Regular Expression (REGEX)</h2>
				<p>
					The regex below can be used to validate the format of UUIDs:
				</p>
				<p>
					<code>[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}</code>
				</p>

				<a href="#" name=case-sensitive></a>
				<h2 class="mt-4">Are UUIDs Case-sensitive?</h2>
				<p>
					No, UUIDs are written in base 16 which uses numbers 0-9 and characters a-f.
					There is no distinction between upper and lowercase letters.
					However, <a href="https://tools.ietf.org/html/rfc4122#section-3">RCF 4122 section 3</a> requires that UUID generators output in lowercase and systems accept UUIDs in upper and lowercase.
				</p>


			</div>
			<div class="col-md-4 order-6">
				<div class="card bg-light mb-4">
					<div class="card-body">
						<h4 class="font-italic">Table of Contents</h4>
						<ul class="mb-0">
							<li><a href="#overview">Overview</a></li>
							<li><a href="#format">UUID Format</a></li>
							<li><a href="#collisions">Can UUIDs Repeat?</a></li>
							<li><a href="#regular-expression">UUID Regular Expression</a></li>
							<li><a href="#case-sensitive">Case Sensitivity</a></li>

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
			"name": "What are UUIDs?",
			"item": "https://www.uuidtools.com/what-is-uuid"
		}]
	}
	</script>
@endpush