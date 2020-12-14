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
						UUID Versions
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/generate">List All Generators</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/generate/v1" title="Version-1 UUID Generator">Version-1</a>
						<a class="dropdown-item" href="/generate/v3" title="Version-3 UUID Generator">Version-3</a>
						<a class="dropdown-item" href="/generate/v4" title="Version-4 UUID Generator">Version-4</a>
						<a class="dropdown-item" href="/generate/v5" title="Version-5 UUID Generator">Version-5</a>
						<a class="dropdown-item" href="/generate/timestamp-first" title="Timestamp-First UUID Generator">Timestamp-First</a>
						<a class="dropdown-item" href="/generate/minecraft" title="Minecraft UUID Generator">Minecraft UUIDs</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/generate/bulk">Bulk Generator</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/decode">Decode UUIDs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/docs">API Docs </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/what-is-uuid">What's a UUID? </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/uuid-versions-explained">Versions Explained </a>
				</li>

			</ul>

		</div>
	</div>
</nav>
