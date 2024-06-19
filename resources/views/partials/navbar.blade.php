<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #012850;">
	<div class="container">
		<a class="navbar-brand" href="/"><img class="logo" src="img/kominfo-logo.png" alt=""></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
			aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-between" id="navbarNav">

			@auth
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link {{ request()->is('beranda') ? 'active' : '' }}" href="/beranda">Beranda</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ request()->is('lowongan-magang*') ? 'active' : '' }}"
							href="{{ route('lowongan.magang') }}">Lowongan Magang</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ request()->is('kegiatanku*') ? 'active' : '' }}"
							href="{{ route('kegiatanku') }}">Kegiatanku</a>
					</li>
				</ul>
			@endauth

			@auth
				<div class="dropdown">
					<div class="profile {{ !optional(auth()->user()->applicant_data)->image ? 'd-none' : '' }}"
						data-bs-toggle="dropdown" aria-expanded="false">
						@if (optional(auth()->user()->applicant_data)->image)
							<img src="{{ asset('storage/' . auth()->user()->applicant_data->image) }}" />
						@endif
					</div>

					<ul class="dropdown-menu dropdown-menu-end mt-2">
						<li><a class="dropdown-item" href="{{ route('profil') }}">Profil</a></li>
						<li>
							<form id="logout-btn-user" action="{{ route('logout') }}" method="post">
								@csrf
								<button type="submit" class="dropdown-item logout-btn">Log out</button>
							</form>
						</li>
					</ul>
				</div>
			@else
				<ul class="navbar-nav ms-auto gap-2 flex-row d-flex py-lg-0 py-3 justify-content-end">
					<li class="nav-item" title="Register">
						<a href="{{ route('register') }}" class="btn btn-outline-primary ">
							Register
						</a>
					</li>
					<li class="nav-item" title="Login ke akun Anda">
						<a href="{{ route('login') }}" class="btn btn-primary">
							Log in
						</a>
					</li>
				</ul>
			@endauth
		</div>
	</div>
</nav>

<script>
	// Button Logout User
	document.addEventListener("DOMContentLoaded", function() {
		const logoutBtn = document.getElementById("logout-btn-user");

		logoutBtn.addEventListener("submit", function(event) {
			event.preventDefault();

			Swal.fire({
				title: "Apakah Anda yakin?",
				text: "Anda akan segera log out dari akun Anda",
				icon: "warning",
				showCancelButton: true,
				cancelButtonText: "Batal",
				confirmButtonText: "Log out",
				reverseButtons: true,
			}).then((result) => {
				if (result.isConfirmed) {
					logoutBtn.submit();
				}
			});
		});
	});
</script>
