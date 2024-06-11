<section class="sidebar" id="sidebar">
	<aside>
		<div class="row py-4 border-bottom border-1 position-relative">
			<h4>SDPPI Magang</h4>
			<div class="x-btn">
				<i class="x-btn" data-feather="x" width="25" height="25" stroke-width="2"></i>
			</div>
		</div>

		<nav>
			<div class="row mt-4">
				{{-- Satuan Unit Sidebar --}}
				@can('satuan_unit')
					<h6 class="label-nav">BERANDA</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0 ">
							<a href="/dashboard" class="d-flex align-items-center {{ request()->is('dashboard') ? 'link-active' : '' }}">
								<i data-feather="grid" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Dashboard</span>
							</a>
						</li>
					</ul>
					<h6 class="label-nav">PENGAJUAN LOWONGAN</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0">
							<a href="{{ route('form.pengajuan') }}"
								class="d-flex align-items-center {{ request()->is('dashboard/form-pengajuan') ? 'link-active' : '' }}">
								<i data-feather="file-plus" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Form Pengajuan</span>
							</a>
						</li>
						<li class="link d-flex mb-1 p-0">
							<a href="{{ route('riwayat.index') }}"
								class="d-flex align-items-center {{ request()->is('dashboard/riwayat-pengajuan') ? 'link-active' : '' }}">
								<i data-feather="bookmark" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Riwayat Pengajuan</span>
							</a>
						</li>
					</ul>
				@endcan

				{{-- Biro Kepegawaian Sidebar --}}
				@can('biro_kepegawaian')
					<h6 class="label-nav">BERANDA</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0 ">
							<a href="/dashboard-biro" class="d-flex align-items-center {{ request()->is('dashboard') ? 'link-active' : '' }}">
								<i data-feather="grid" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Dashboard</span>
							</a>
						</li>
					</ul>
					<h6 class="label-nav">LOWONGAN MAGANG</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0">
							<a href="{{ route('verification.index') }}"
								class="d-flex align-items-center {{ request()->is('dashboard-biro/verifikasi-pengajuan') ? 'link-active' : '' }}">
								<i data-feather="check-square" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Verifikasi Lowongan</span>
							</a>
						</li>
						<li class="link d-flex mb-1 p-0">
							<a href="{{ route('verification.history') }}" class="d-flex align-items-center">
								<i data-feather="clipboard" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Riwayat Verifikasi</span>
							</a>
						</li>
					</ul>

					<h6 class="label-nav">PENDAFTARAN MAGANG</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0">
							<a href="" class="d-flex align-items-center">
								<i data-feather="user-check" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Verifikasi Pemagang</span>
							</a>
						</li>
					</ul>
				@endcan

				{{-- Admin Sidebar --}}
				@can('admin')
					<h6 class="label-nav">BERANDA</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0 ">
							<a href="/dashboard-admin"
								class="d-flex align-items-center {{ request()->is('dashboard') ? 'link-active' : '' }}">
								<i data-feather="grid" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Dashboard</span>
							</a>
						</li>
					</ul>
					<h6 class="label-nav">ADMINISTRATOR</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0 ">
							<a href="{{ route('list.admin') }}"
								class="d-flex align-items-center {{ request()->is('dashboard-admin/daftar-admin-sdppi') ? 'link-active' : '' }}">
								<i data-feather="user" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Daftar Admin SDPPI</span>
							</a>
						</li>
					</ul>
					<h6 class="label-nav">LOWONGAN MAGANG</h6>
					<ul class="mx-auto d-flex align-items-center flex-column">
						<li class="link d-flex mb-1 p-0 ">
							<a href="{{ route('list.internship') }}" class="d-flex align-items-center">
								<i data-feather="file-text" width="23" height="23" stroke-width="1.5"></i>
								<span class="ms-3">Lowongan Magang</span>
							</a>
						</li>
					</ul>
				@endcan
			</div>
		</nav>
	</aside>
</section>
