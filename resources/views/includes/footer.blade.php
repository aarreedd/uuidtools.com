<div class="progress mt-4">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
</div>

<footer class="bg-light py-4">
	<div class="container">
		<p class="float-right">
			<a href="#top"> <i class="fas fa-arrow-up"></i> Back to top</a>
		</p>
		<p>
			<i>Free Online UUID/GUID Generator Tool.</i>
		</p>
		<p>
			<a href="/generate">UUID Generator</a> &bull;
			<a href="/generate/bulk">Bulk UUID Generator</a> &bull;
			<a href="/decode">UUID Decoder</a> &bull;
			<a href="/terms">Terms of service</a> &bull;
			<a href="/sitemap">Sitemap</a> &bull;
			<a href="/contact">Contact us</a>
		</p>
		<p>
			<a href="/"><i class="fas fa-fingerprint"></i> {{ config('app.name') }}</a> &copy; {{ date('Y') }}. All rights reserved.
			<a href="https://github.com/aarreedd/uuidtools.com"><i class="fab fa-github"></i> View on Github</a>
		</p>
	</div>
</footer>

<!-- Global JS here -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/fitty.js') }}"></script>

@stack('scripts')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154351443-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154351443-1');
</script>
