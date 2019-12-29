{{-- ============================================================================== --}}
{{-- ==                                 Config                                   == --}}
{{-- ============================================================================== --}}

@extends('layouts.master')

@section('seo-meta')
	<!-- Page-specific meta tags -->
	<title>Contact Us | {{ config('app.name') }}</title>
@endsection

{{-- ============================================================================== --}}
{{-- ==                                Page Content                              == --}}
{{-- ============================================================================== --}}
@section('content')

	<div class="container mt-4">

		<div class="row">
			<iframe src="https://docs.google.com/forms/d/e/1FAIpQLScxoeA8XMJE-ybji8lT1_RselJp8xhd6ZynvUdruxr06f_Img/viewform?embedded=true" style="width:100%" height="800" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
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