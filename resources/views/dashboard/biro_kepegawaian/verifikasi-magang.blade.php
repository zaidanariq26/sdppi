{{-- @dd($internships) --}}
@extends('dashboard.layouts.main')

@section('container')
	<div class="row py-4 px-md-5 px-3 table-section m-0 my-5">
		<h4 class="fw-semibold mb-5 mt-1 lh-custom text-center">
			Verifikasi Pengajuan Pembukaan <br />
			Lowongan Magang
		</h4>


		<div class="table-responsive-lg">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Judul</th>
						<th scope="col">Divisi</th>
						<th scope="col">Status</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($internships as $intern)
						<tr>
							<th scope="row">{{ $loop->iteration }}</th>
							<td>{{ $intern->title }}</td>
							<td>{{ $intern->division }}</td>
							<td>
								@php
									$classMap = [
									    'menunggu' => 'bg-secondary',
									    'diterima' => 'bg-success',
									    'ditolak' => 'bg-danger',
									];
								@endphp
								<span class="badge {{ $classMap[$intern->status] ?? 'bg-secondary' }}">{{ ucfirst($intern->status) }}</span>
							</td>
							<td style="min-width: 130px">
								<div class="d-inline d-md-none">
									<button type="button" class="badge bg-primary border-0" data-bs-toggle="dropdown" aria-expanded="false">
										<span data-feather="more-horizontal" width="18" height="18" class="align-text-bottom"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-end mt-2">
										<li>
											<button type="button" class="dropdown-item" data-bs-toggle="modal"
												data-bs-target="#exampleModal{{ $loop->iteration }}">
												Lihat
											</button>
										</li>
										<li>
											<form action='{{ route('verification.accepted', $intern->id) }}' method="post"
												class="d-inline verification-accepted">
												@method('put')
												@csrf
												<button class="dropdown-item" type="submit">
													Terima
												</button>
											</form>
										</li>
										<li>
											<form action='{{ route('verification.rejected', $intern->id) }}' method="post"
												class="d-inline verification-rejected">
												@method('put')
												@csrf
												<button class="dropdown-item delete-btn" type="submit">
													Tolak
												</button>
											</form>
										</li>
									</ul>
								</div>

								<div class="d-md-inline d-none" title="Lihat Selengkapnya">
									<button type="button" class="badge bg-warning border-0" data-bs-toggle="modal"
										data-bs-target="#exampleModal{{ $loop->iteration }}">
										<span data-feather="eye" width="18" height="18" class="align-text-bottom"></span>
									</button>
								</div>

								<form action='{{ route('verification.accepted', $intern->id) }}' method="post"
									class="d-md-inline d-none verification-accepted" title="Terima Pengajuan">
									@method('put')
									@csrf
									<button class="badge bg-success border-0" type="submit">
										<span data-feather="check-circle" width="18" height="18" class="align-text-bottom"></span>
									</button>
								</form>

								<form action='{{ route('verification.rejected', $intern->id) }}' method="post"
									class="d-md-inline d-none verification-rejected" title="Tolak Pengajuan">
									@method('put')
									@csrf
									<button class="badge bg-danger border-0" type="submit">
										<span data-feather="x-circle" width="18" height="18" class="align-text-bottom"></span>
									</button>
								</form>
							</td>
						</tr>
						<!-- Modal -->
						<div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
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
											<div class="col-sm-6 d-flex justify-content-sm-end align-items-start">
												<h6 class="text-secondary">Status:</h6>
												@php
													$classMap = [
													    'menunggu' => 'bg-secondary',
													    'diterima' => 'bg-success',
													    'ditolak' => 'bg-danger',
													];
												@endphp
												<span
													class="ms-2 badge {{ $classMap[$intern->status] ?? 'bg-secondary' }}">{{ ucfirst($intern->status) }}</span>
											</div>
										</div>

										<hr>

										<div class="row">
											<h5 class="fw-semibold"> Deskripsi </h5>
											<span>{!! $intern->description !!}</span>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Kembali</button>
									</div>
								</div>
							</div>
						</div>
					@empty
						<tr>
							<td colspan="5" class="text-center py-5 text-muted ">Tidak ada pengajuan lowongan magang!</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>

	<script>
		// Button Verification Accepted
		document.addEventListener("DOMContentLoaded", function() {
			const acceptedVerificationBtn = document.querySelectorAll(".verification-accepted");

			acceptedVerificationBtn.forEach(function(acceptedBtn) {
				acceptedBtn.addEventListener("submit", function(event) {
					event.preventDefault();

					Swal.fire({
						title: "Apakah Anda yakin?",
						text: "Pastikan data pengajuan yang akan diterima sudah benar.",
						icon: "warning",
						showCancelButton: true,
						cancelButtonText: "Batal",
						confirmButtonText: "Terima",
						reverseButtons: true,
					}).then((result) => {
						if (result.isConfirmed) {
							// Use AJAX to submit the form
							$.ajax({
								url: acceptedBtn.action,
								type: acceptedBtn.method,
								data: $(acceptedBtn).serialize(),
								success: function(response) {
									Swal.fire({
										title: "Berhasil!",
										text: "Pengajuan pembukaan lowongan magang diterima.",
										icon: "success"
									}).then(() => {
										// Optionally reload the page or redirect
										location
											.reload(); // Uncomment if you want to reload the page
									});
								},
								error: function(xhr) {
									Swal.fire({
										title: "Gagal!",
										text: "Terjadi kesalahan saat melakukan verifikasi.",
										icon: "error"
									});
								}
							});
						}
					});
				});
			});
		});


		// Button Verification Rejected
		document.addEventListener("DOMContentLoaded", function() {
			const rejectedVerificationBtn = document.querySelectorAll(".verification-rejected");

			rejectedVerificationBtn.forEach(function(rejectedBtn) {
				rejectedBtn.addEventListener("submit", function(event) {
					event.preventDefault();

					Swal.fire({
						title: "Apakah Anda yakin?",
						text: "Pastikan data pengajuan yang akan ditolak sudah benar.",
						icon: "warning",
						showCancelButton: true,
						cancelButtonText: "Batal",
						confirmButtonText: "Tolak",
						reverseButtons: true,
					}).then((result) => {
						if (result.isConfirmed) {
							// Use AJAX to submit the form
							$.ajax({
								url: rejectedBtn.action,
								type: rejectedBtn.method,
								data: $(rejectedBtn).serialize(),
								success: function(response) {
									Swal.fire({
										title: "Berhasil!",
										text: "Pengajuan pembukaan lowongan magang berhasil ditolak.",
										icon: "success"
									}).then(() => {
										// Optionally reload the page or redirect
										location
											.reload(); // Uncomment if you want to reload the page
									});
								},
								error: function(xhr) {
									Swal.fire({
										title: "Gagal!",
										text: "Terjadi kesalahan saat melakukan verifikasi.",
										icon: "error"
									});
								}
							});
						}
					});
				});
			})
		});
	</script>
@endsection
