@extends('layouts.main')

@section('container')
	@if (session()->has('register_success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				Swal.fire({
					title: "Pendaftaran berhasil",
					text: "{{ session('register_success') }}",
					icon: "success"
				});
			})
		</script>
	@endif

	@if (session()->has('success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				alertToast('success', '{{ session('success') }}')
			})
		</script>
	@endif

	@if (session()->has('error'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				Swal.fire({
					title: "Data belum lengkap",
					text: "{{ session('error') }}",
					icon: "error",
					confirmButtonText: "Lengkapi Data",
					allowOutsideClick: false,
					allowEscapeKey: false,
					allowEnterKey: false,
				}).then((result) => {
					if (result.isConfirmed) {
						// Redirect to the form page
						window.location.href = "{{ route('profil') }}";
					}
				});
			})
		</script>
	@endif

	@if (session()->has('fill_data'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				Swal.fire({
					title: "Data belum lengkap",
					text: "{{ session('fill_data') }}",
					icon: "warning",
					confirmButtonText: "Lengkapi Data",
					allowOutsideClick: false,
					allowEscapeKey: false,
					allowEnterKey: false,
				}).then((result) => {
					if (result.isConfirmed) {
						// Redirect to the form page
						window.location.href = "{{ route('applicant.data.form') }}";
					}
				});
			});
		</script>
	@endif

	<section class="pt-4">
		<h1 class="mb-5 text-center">Lowongan Magang</h1>
		<div class="row g-3">
			@forelse ($internships as $intern)
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title fw-semibold" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
								{{ $intern->title }}</h5>
							<p class="card-text mb-0 text-secondary">Divisi {{ $intern->division }}</p>
							<p class="card-text text-secondary">{{ $intern->duration }}</p>
							<button class="btn btn-primary float-end" data-bs-toggle="modal"
								data-bs-target="#exampleModal{{ $loop->iteration }}">Daftar</button>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<form action="{{ route('daftar.magang', $intern->id) }}" class="daftar-magang" method="post">
								@csrf
								<div class="modal-dialog ">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="modal-title fw-semibold" id="exampleModalLabel">{{ $intern->title }} </h3>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body ">
											<div class="row gap-sm-0 gap-3">
												<div class="col-sm-6 d-flex flex-column gap-3">
													<div class="row">
														<span class="text-secondary">Divisi</span>
														<span class="fw-semibold">{{ $intern->division }}</span>
													</div>
													<div class="row">
														<span class="text-secondary">Waktu Magang</span>
														<span class="fw-semibold">{{ $intern->duration }}</span>
													</div>
													<div class="row">
														<span class="text-secondary">Slot Pemagang</span>
														<span class="fw-semibold">{{ $intern->vacancy_slots }} orang</span>
													</div>
												</div>
											</div>

											<hr>

											<div class="row">
												<h5 class="fw-semibold"> Deskripsi </h5>
												<span>{!! $intern->description !!}</span>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
											<button type="submit" class="btn btn-primary">Daftar</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			@empty
				<h3 class="text-center text-secondary">Tidak ada lowongan</h3>
			@endforelse
		</div>
		</div>
	</section>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const registerIntern = document.querySelectorAll(".daftar-magang");
			registerIntern.forEach(btn => {
				btn.addEventListener("submit", function(event) {
					event.preventDefault();
					Swal.fire({
						title: "Apakah Anda yakin?",
						text: "Pastikan data diri Anda sudah lengkap.",
						icon: "warning",
						showCancelButton: true,
						cancelButtonText: "Batal",
						confirmButtonText: "Daftar",
						reverseButtons: true,
					}).then((result) => {
						if (result.isConfirmed) {
							btn.submit();
						}
					});
				});
			});
		});
	</script>
@endsection
