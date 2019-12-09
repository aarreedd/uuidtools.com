<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
	<div class="container">
		<a class="navbar-brand" href="/">
			<i class="fas fa-fingerprint text-primary"></i> {{ config('app.name') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarTop">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						UUID Generator
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/generator">UUID Generator Tool</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/generator/v1">Version-1 UUID</a>
						<a class="dropdown-item" href="/generator/v3">Version-3 UUID</a>
						<a class="dropdown-item" href="/generator/v4">Version-4 UUID</a>
						<a class="dropdown-item" href="/generator/v5">Version-5 UUID</a>
						<a class="dropdown-item" href="/generator/timestamp-first">Timestamp-first UUID</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/generator/bulk">Bulk UUID Generator</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/decode">UUID Decoder </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/docs">API Docs </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/what-is-uuid">What is UUID? </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/uuid-versions-explained">Versions Explained </a>
				</li>

			</ul>

		</div>
	</div>
</nav>

<!-- facebook like button -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0"></script>