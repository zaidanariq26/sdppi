<div class="d-flex mt-2 p-3 nav justify-content-between align-items-center">
	<div class="d-flex">
		<div class="nav-icon me-2 d-flex justify-content-center align-items-center justify-btn">
			<i data-feather="menu" width="21" height="21" stroke-width="1.5"></i>
		</div>
		@can('satuan_unit')
			<a href="{{ route('riwayat.index') }}" class="text-dark">
				<div class="nav-icon me-2 d-flex justify-content-center align-items-center" title="Riwayat Pengajuan"
					data-bs-placement="bottom">
					<i data-feather="bookmark" width="21" height="21" stroke-width="1.5"></i>
				</div>
			</a>
		@endcan
		@can('biro_kepegawaian')
			<a href="{{ route('verification.history') }}" class="text-dark">
				<div class="nav-icon me-2 d-flex justify-content-center align-items-center" title="Riwayat Verifikasi"
					data-bs-placement="bottom">
					<i data-feather="bookmark" width="21" height="21" stroke-width="1.5"></i>
				</div>
			</a>
		@endcan
	</div>

	<div class="dropdown">
		<div class="profile" data-bs-toggle="dropdown" aria-expanded="false">
			<img src="/img/logo-admin3.png" alt="" />
		</div>

		<ul class="dropdown-menu dropdown-menu-end mt-2">
			<li><a class="dropdown-item" href="{{ route('profile.admin') }}">Profil</a></li>
			<li>
				<form id="logout-btn" action="{{ route('logout') }}" method="post">
					@csrf
					<button type="submit" class="dropdown-item logout-btn">Log out</button>
				</form>
			</li>
		</ul>
	</div>
</div>

<script>
	// Button Logout
	document.addEventListener("DOMContentLoaded", function() {
		const logoutBtn = document.getElementById("logout-btn");

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
