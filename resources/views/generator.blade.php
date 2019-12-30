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

		<div class="card mb-0 border-2 border-top-0 border-bottom-rounded bg-light">
			<div class="card-body">

				<div class="btn-group btn-block">
					<button class="btn btn-outline-secondary dropdown-toggle btn-block font-weight-bold" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ $version->dropdownSelected }}
					</button>
					<div class="dropdown-menu w-100 text-center">
						@foreach ($otherOptions as $option)
							<a class="dropdown-item" href="{{ $option['url'] }}"><b>{{ $option['dropdownSelected'] }}</b></a>
						@endforeach
					</div>
				</div>
				<div class="clearfix mb-4">
					<a href="/uuid-versions-explained" target=_blank class="small float-right"> <i class="far fa-question-circle"></i> UUID Versions Explained &raquo;</a>
				</div>

				@include('partials.generators.' . $version->api)

			</div>
		</div>

		@include('partials.fb-like')

		<div class="row mb-3 mt-5">
			<div class="col-md-8 order-12 order-md-1">
				<h3 class="mb-3 font-italic border-bottom">
					<b>UUIDTools.com</b> - Free Online UUID Generator
				</h3>

				<p>
					Thanks for using UUIDTools.com!
					This site provides a free tool and <a href="/docs">API</a> for generating UUIDs on-the-fly.
					We do our best to make the tools and API intuitive and easy-to-use.
				</p>
				<p>
					Feedback is always welcome. <a href="/contact">Contact us</a> with suggestions or corrections.
					This project is <a href="https://github.com/aarreedd/uuidtools.com">open source</a>.
				</p>
				<h3>Why use an online UUID generator?</h3>
				<p>
					Most programming languages have a simple way to generate UUIDs.
					But, sometimes you might just need a single UUID and do not want to write any code.
				</p>
				<p>
					Additionally, we try to make these tools intuitive and explain the differences between the different UUID versions.
					Testing out the UUID generator above and the <a href="/decode">UUID decoder</a> will give you a good idea of how UUIDs work and which version to use in your own project or application.
				</p>

				<p>
					<div class="row text-center">
						<div class="col-sm-4 mb-2">
							<a href="/decode" class="btn btn-outline-primary btn-block">UUID Decoder</a>
						</div>
						<div class="col-sm-4 mb-2">
							<a href="/uuid-versions-explained" class="btn btn-outline-primary btn-block">UUID Versions</a>
						</div>
						<div class="col-sm-4 mb-2">
							<a href="/generate/bulk" class="btn btn-outline-primary btn-block text-nowrap">Bulk UUID Generator</a>
						</div>
					</div>
				</p>

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
