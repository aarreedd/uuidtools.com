{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>List of UUID Generators | UUIDTools.com</title>
	<meta name="description" content="List of UUID Generator Tools. Generate version-1, version-3, version-4, version-5, and time-based UUIDs. "/>

	<link rel="canonical" href="https://www.uuidtools.com/generate" />

@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		@component('components.breadcrumbs')
			<li class="breadcrumb-item active" aria-current="page">Generate</li>
		@endcomponent

		<h1 class="border-bottom border-primary border-3 font-weight-bold"><i class="fas fa-fingerprint text-primary"></i> List of UUID Generators </h1>

		<div class="row">

			<div class="col-md-6 mt-3">
				<div class="card bg-light-hover h-100">
					<div class="card-body">
						<h5 class="card-title font-weight-bold">Version-1 UUID Generator</h5>
						<p class="card-text">Version-1 UUIDs are a generated based on the current time, MAC Address, and a randomly generated number.</p>
						<a href="/generate/v1" class="btn btn-primary stretched-link">Generate v1 UUIDs &raquo;</a>
					</div>
				</div>
			</div>

			<div class="col-md-6 mt-3">
				<div class="card bg-light-hover h-100">
					<div class="card-body">
						<h5 class="card-title font-weight-bold">Version-3 UUID Generator</h5>
						<p class="card-text">Version-3 UUIDs are deterministic based on MD5 hash of name and namespace.</p>
						<a href="/generate/v3" class="btn btn-primary stretched-link">Generate v3 UUIDs &raquo;</a>
					</div>
				</div>
			</div>

			<div class="col-md-6 mt-3">
				<div class="card bg-light-hover h-100">
					<div class="card-body">
						<h5 class="card-title font-weight-bold">Version-4 UUID Generator</h5>
						<p class="card-text">Version-4 UUIDs randomly generated for when uniqueness is needed.</p>
						<a href="/generate/v4" class="btn btn-primary stretched-link">Generate v4 UUIDs &raquo;</a>
					</div>
				</div>
			</div>

			<div class="col-md-6 mt-3">
				<div class="card bg-light-hover h-100">
					<div class="card-body">
						<h5 class="card-title font-weight-bold">Version-5 UUID Generator</h5>
						<p class="card-text">Version-5 UUIDs are deterministic based on SHA-1 hash of name and namespace.</p>
						<a href="/generate/v5" class="btn btn-primary stretched-link">Generate v5 UUIDs &raquo;</a>
					</div>
				</div>
			</div>

			<div class="col-md-6 mt-3">
				<div class="card bg-light-hover h-100">
					<div class="card-body">
						<h5 class="card-title font-weight-bold">Timestamp-First UUID Generator</h5>
						<p class="card-text">Timestamp-first UUIDs are designed to be stored efficiently in indexed database columns.</p>
						<a href="/generate/timestamp-first" class="btn btn-primary stretched-link">Timestamp-first UUIDs &raquo;</a>
					</div>
				</div>
			</div>

			<div class="col-md-6 mt-3">
				<div class="card bg-light-hover h-100">
					<div class="card-body">
						<h5 class="card-title font-weight-bold">Bulk UUID Generator</h5>
						<p class="card-text">Generate up to 100 version-1, version-4 or timestamp-first UUIDs instantly.</p>
						<a href="/generate/bulk" class="btn btn-primary stretched-link">Bulk UUIDs &raquo;</a>
					</div>
				</div>
			</div>


			<div class="col-md-6 mt-3">
				<div class="card bg-light-hover h-100">
					<div class="card-body">
						<h5 class="card-title font-weight-bold">UUID Decoder</h5>
						<p class="card-text">Decode UUIDs to extract version number, variation, and (in some cases) MAC Address and creation time.</p>
						<a href="/decode" class="btn btn-primary stretched-link">UUID Decoder &raquo;</a>
					</div>
				</div>
			</div>
		</div>

		<p class="mt-3">
			<a href="/uuid-versions-explained#version-2" target=_blank><i class="fas fa-question-circle"></i> Why is version-2 missing?</a>
		</p>
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
			"name": "Generate Tools",
			"item": "https://www.uuidtools.com/generate"
		}]
	}
	</script>

@endpush
