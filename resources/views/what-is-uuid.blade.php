{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>Ultimate guide to Universal Unique Identifiers (UUID) | {{ config('app.name') }}</title>

	<link rel="canonical" href="https://www.uuidtools.com/what-is-uuid" />
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">What's a UUID?</h1>
			<p class="lead text-muted">What are Universal Unique Identifiers and how to use them?</p>
		</div>
	</section>

	<div class="container mt-4">

		@component('components.breadcrumbs')
			<li class="breadcrumb-item active" aria-current="page">UUID Versions Explained</li>
		@endcomponent

		<div class="row">
			<div class="col-md-8 order-12 order-md-1">

				<p>
					UUID stands for <b>Universally Unique IDentifier</b>.
					Sometimes also called GUID (Globally Unique IDentifier) in Windows systems.
					UUIDs are 128-bit numbers used to unique identify information in computer systems.
				</p>

				<p>
					Anyone creating UUIDs can safely assume each ID will be unique.
					This means that independent systems that use UUIDs can be merged at a later date or transmitted through the same medium without worrying about collisions.
				</p>

				<p>
					UUIDs are also generated without relying on a central authority for coordination or registration.
					This means UUIDs can be generated quickly and locally.
					UUIDs have one of the lowest minting costs of any system of unique identification.
				</p>

				<p>
					UUIDs are written in the format 8-4-4-4-12 e.g. 123e4567-e89b-12d3-a456-426655440000.
					UUIDs are made up of 32 hexadecimal digits plus 4 hyphens for a total of 36 characters.
					UUIDs are fixed length.
				</p>

				<p>
					Due to their small format, UUIDs are ideal for sorting, ordering, hashing, and indexing.
					UUIDs are also quickly and easily distinguished by humans.
				</p>

				<p>
					UUIDs can by generated in any programming language.
					Due to their wide adoption, most programming languages have native support or, at the least, popular libraries for generating UUIDs.
					This makes UUIDs ideal for interoperability between independent systems, especially across the Internet.
				</p>

				<p>
					UUID specification is formalized in <a href="https://tools.ietf.org/html/rfc4122">RCF 4122</a> published in 2005.
				</p>

				<a href="#" name=collisions></a>
				<h2 class="mt-4">Can a UUID be repeated?</h2>
				<p>
					In computer science, this is called a collision.
				</p>
				<p>
					With UUID version-1 the MAC address of the computer generating the UUID in embedded in the UUID.
					This makes it impossible for 2 different computers to generate the same UUID if both adhere to the specification.
					The timestamp is also including in the UUID to ensure uniqueness.
					The timestamp field will rollover in 5236 AD. So there is no chance of duplicate until then.
				</p>
				<p>
					With version-3, version-4, and version-5 there is an exceptionally small chance of duplicate.
				</p>
				<p>
					With version-4 UUIDs, which are totally random, there are approximately 5.3 x 10<sup>36</sup> possible UUIDs.
					With numbers that large the chances of any two people in the whole world ever generating the same UUID are astronomically small.
					The chances are so small that it is generally safe to assume it will never happen.
				</p>
				<p>
					<a href="/uuid-versions-explained">Learn more about UUID Versions &raquo;</a>
				</p>


				<a href="#" name=format></a>
				<h2 class="mt-4">UUID Format</h2>

				<p>
					UUIDs are written in 5 groups of hexadecimal numbers separated by hyphens.
					The length of each group is: 8-4-4-4-12.
					For example: 123e4567-e89b-12d3-a456-426655440000
				</p>

				<p>
					UUIDs are 128-bits and although there is a standard format, UUIDs can be written in any number format, such as decimal or binary.
					Below is an example of the same UUID written in standard UUID format, decimal format, and binary.
				</p>

				<table class="table table-bordered table-hover">
					<thead><tr><th>Format</th><th>Example</th></tr></thead>
					<tbody>
						<tr><th>Hexadecimal</th><td>123e4567-e89b-12d3-a456-426655440000</td></tr>
						<tr><th>Decimal</th><td>190464649652423269416550308090595239059</td></tr>
						<tr><th>Binary</th><td>10001111 01001010 00101000 00111110 11111111 10100101 01001010 00100100 10100010 01110111 00000001 11000110 00001000 10010011 11100100 10010011</td></tr>
					</tbody>
				</table>

				<a href="#" name=regular-expression></a>
				<h2>UUID Regular Expression (REGEX)</h2>
				<p>
					The regex below can be used to validate the format of UUIDs:
				</p>
				<p>
					<code>[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}</code>
				</p>

				<a href="#" name=csae-sensitive></a>
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
							<li><a href="#version-1">Version-1 UUID</a></li>

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