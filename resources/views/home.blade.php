{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>Online UUID Generator | UUIDTools.com</title>
	<meta name="description" content='Generate UUIDs online instantly. Supports version-1, version-3, version-4 ("Random"), and version-5 UUIDs. See which version is right for your situation.'/>

	<link rel="canonical" href="https://www.uuidtools.com" />

@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		<h1 class="border-bottom border-primary border-3 mb-3 font-weight-bold"><i class="fas fa-fingerprint text-primary"></i> Online UUID Generator</h1>

		<div class="row row-eq-height">
			<div class="col-md-6 mt-2">
				<div class="card border-2 bg-light h-100">
					<div class="card-header text-center">
						<h2 class="lead font-weight-bold font-italic mb-0">Version-1 UUID</h2>
					</div>
					<div class="card-body">

						@include('partials.generators.v1')

					</div>
				</div>
			</div>
			<div class="col-md-6 mt-2">
				<div class="card border-2 bg-light">
					<div class="card-header text-center">
						<h2 class="lead font-weight-bold font-italic mb-0">Version-4 "Random" UUID</h2>
					</div>
					<div class="card-body">

						@include('partials.generators.v4')

					</div>
				</div>
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

			</div>

			<aside class="col-md-4 order-6">
				<div class="card bg-light mb-3 text-center">
					<div class="card-body">
						<p class="lead mb-0">
							We have generated a total of <span class="lead"><u>{{ number_format($totalUuids) }}</u></span> UUIDs all-time.
						</p>
					</div>
				</div>

				<div class="card bg-light mb-3 text-center">
					<div class="card-header">
						<h5 class="mb-0"><b><i class="fas fa-bolt text-warning"></i> Top Tools</b></h5>
					</div>
					<div class="card-body">
						<ul class="list-unstyled mb-0">
							<li><a href="/decode">UUID Decoder</a></li>
							<li><a href="/uuid-versions-explained">UUID Versions Explained</a></li>
							<li><a href="/generate/bulk">Bulk Generator</a></li>
							<li><a href="/generate"><b>View all Generators</b></a></li>
						</ul>
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



@endpush
