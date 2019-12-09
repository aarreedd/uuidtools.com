{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>404 Not Found | {{ config('app.name') }}</title>
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">404 - Page Not Found</h1>
		</div>
	</section>

	<div class="container mt-4 text-center">

		<br>
		<br>
		<h4 class="font-italic">Oops! We could not find the page you were looking for.</h4>
		<br>
		<br>

		<p class="lead">
			Please double-check the URL you typed for errors.
			If you clicked a broken link, please <a href="/contact">contact us</a> so we can fix in.
		</p>
		<p class="lead">
			You can try visiting the <a href="/">homepage</a> to find what you were looking for.
		</p>
		<br>
		<br>
		<br>
		<p class="small">Here is a UUID for your troubles: {{ Str::uuid() }}</p>
		<br>

	</div>

@endsection