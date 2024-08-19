<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
			<a class="navbar-brand" href="index.html">EmployeeHUB</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
					</li>	
					<li class="nav-item">
						<a class="nav-link" aria-current="page" onclick="scrollToSection('featured-jobs')">Find Jobs</a>
					</li>	
          			{{-- <li class="nav-item">
						<a class="nav-link" aria-current="page" href="jobs.html">Resume Builder</a>
					</li>	 --}}
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('front.user.resume_builder') }}">Resume Builder</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{route('front.user.appliedjobs')}}">Applications</a>
					</li>
					
          			<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{route('front.user.notifications')}}">Notification</a>
					</li>	



				</ul>	
				<div class="dropdown">
					<button class="btn btn-outline-primary me-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
						{{ Auth::user()->email }}
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
						<li><a class="dropdown-item" href="{{ route('account.logout') }}">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>