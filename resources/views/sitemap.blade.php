{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>Sitemap | {{ config('app.name') }}</title>
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Sitemap</h1>
		</div>
	</section>

	<div class="container mt-4">

		@component('components.breadcrumbs')
			<li class="breadcrumb-item active" aria-current="page">Sitemap</li>
		@endcomponent

		<div class="row">
			<div class="col-md-8 order-12 order-md-1">
				<h3>All Pages:</h3>
				<ul>
					@foreach($urls as $url)
					<li><a href="{{ $url }}">{{ $url }}</a></li>
					@endforeach
				</ul>

			</div>

			<aside class="col-md-4 order-6">
			</aside>
		</div>

	</div>

@endsection
