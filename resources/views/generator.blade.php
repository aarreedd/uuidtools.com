{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>{{ $version->meta_title }}</title>
	<meta name="description" content="{{ $version->description }}"/>

	<link rel="canonical" href="{{ $version->canonical }}" />

@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		<h1 class="border-bottom border-primary border-3 mb-0 font-weight-bold"><i class="fas fa-fingerprint text-primary"></i> {{ $version->title }}</h1>

		<div class="card mb-0 border-2 border-top-0 border-bottom-rounded bg-light pt-4">
			<div class="card-body">

				@include('partials.generators.' . $version->api)

			</div>
		</div>

		@include('partials.fb-like')

		<div class="row mb-3 mt-5">
			<div class="col-md-8 order-12 order-md-1">
				<h3 class="mb-3 font-italic border-bottom">
					<b>UUIDTools.com</b> - {{ $version->title }}
				</h3>

				<p>
					{{ $version->description }}
					<a href="/uuid-versions-explained">Learn more about UUID Versions &raquo;</a>
				</p>


				<h3 class="border-bottom"> Other UUID Tools </h3>

				<div class="row">
				@foreach ($otherOptions as $option)
					<div class="col-6 mb-3">
						<a class="btn btn-outline-primary btn-block" href="{{ $option['url'] }}">{{ $option['dropdownSelected'] }}</a>
					</div>
				@endforeach

					<div class="col-6 mb-3">
						<a href="/decode" class="btn btn-outline-primary btn-block">UUID Decoder</a>
					</div>
					<div class="col-6 mb-3">
						<a href="/uuid-versions-explained" class="btn btn-outline-primary btn-block">UUID Versions Explained</a>
					</div>
					<div class="col-6 mb-3">
						<a href="/generate/bulk" class="btn btn-outline-primary btn-block text-nowrap">Bulk Generator</a>
					</div>
					<div class="col-6 mb-3">
						<a href="/generate" class="btn btn-outline-primary btn-block text-nowrap">View All UUID Tools</a>
					</div>
				</div>

			</div>

			<aside class="col-md-4 order-6">
				<div class="card bg-light mb-3 text-center">
					<div class="card-body">
						<p class="lead mb-0">
							We have generated a total of <span class="lead"><u>{{ number_format($totalUuids) }}</u></span> UUIDs all-time.
						</p>
					</div>
				</div>

			</aside>
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
			"name": "Generate Tools List",
			"item": "https://www.uuidtools.com/generate"
		},{
			"@type": "ListItem",
			"position": 2,
			"name": "{{ $version->title }}",
			"item": "{{ $version->canonical }}"
		}]
	}
	</script>

@endpush
