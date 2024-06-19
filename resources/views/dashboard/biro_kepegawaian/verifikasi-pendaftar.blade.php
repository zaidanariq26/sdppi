@extends('dashboard.layouts.main')

@section('container')
	@if (session()->has('success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				Swal.fire({
					title: "Berhasil!",
					text: "{{ session('success') }}",
					icon: "success"
				});
			})
		</script>
	@endif
	<div class="row py-4 px-md-5 px-3 table-section m-0 my-5">
		<h4 class="fw-semibold mb-5 mt-1 lh-custom text-center">
			Verifikasi Pendaftaran Magang
		</h4>

		<div class="table-responsive-lg">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Lengkap</th>
						<th scope="col">Email</th>
						<th scope="col">Lowongan Magang</th>
						<th scope="col">Status</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($applicants as $applicant)
						<tr>
							<th scope="row">{{ $loop->iteration }}</th>
							<td>{{ $applicant->applicantData->name }}</td>
							<td>{{ $applicant->user->email }}</td>
							<td>{{ $applicant->internship->title }}</td>
							<td>
								@php
									$classMap = [
									    'mendaftar' => 'bg-secondary',
									    'lulus' => 'bg-success',
									    'gagal' => 'bg-danger',
									    'verifikasi' => 'bg-warning',
									];
								@endphp
								<span
									class="ms-1 badge {{ $classMap[$applicant->status] ?? 'bg-secondary' }}">{{ ucfirst($applicant->status) }}</span>
							</td>
							<td>
								<div>
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
											<form action='{{ route('verify.applicant', $applicant->id) }}' method="post"
												class="d-inline verify-applicant" enctype="multipart/form-data">
												@csrf
												<button class="dropdown-item success-btn" type="submit">
													Verifikasi
												</button>
												<input type="hidden" name="applicant_status_id" value="{{ $applicant->id }}">
												<input type="file" name="file" style="display:none;">
											</form>
										</li>
										<li>
											<form action='{{ route('reject.verify.applicant', $applicant->id) }}' method="post"
												class="d-inline reject-verify">
												@method('put')
												@csrf
												<button class="dropdown-item delete-btn" type="submit">
													Tolak
												</button>
											</form>
										</li>
									</ul>
								</div>
							</td>
						</tr>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog ">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title fw-semibold" id="exampleModalLabel">Data Pendaftar</h3>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="row d-flex flex-column gap-3">
											<div class="row">
												<span class="text-secondary">Nama Lengkap</span>
												<span class="fw-semibold">{{ $applicant->applicantData->name }}</span>
											</div>
											<div class="row">
												<span class="text-secondary">ID Pelajar</span>
												<span class="fw-semibold">{{ $applicant->applicantData->student_id }}</span>
											</div>
											<div class="row">
												<span class="text-secondary">Email</span>
												<span class="fw-semibold">{{ $applicant->user->email }}</span>
											</div>
											<div class="row">
												<span class="text-secondary">Asal Sekolah/Instansi</span>
												<span class="fw-semibold">{{ $applicant->applicantData->school }}</span>
											</div>
											<div class="row">
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Provinsi</span>
													<span class="fw-semibold">{{ $applicant->applicantData->provinsi }}</span>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Kabupaten</span>
													<span class="fw-semibold">{{ $applicant->applicantData->distrik }}</span>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Kecamatan</span>
													<span class="fw-semibold">{{ $applicant->applicantData->kecamatan }}</span>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Kelurahan</span>
													<span class="fw-semibold">{{ $applicant->applicantData->kelurahan }}</span>
												</div>
											</div>
											<div class="row">
												<span class="text-secondary">Alamat Rumah</span>
												<span class="fw-semibold">{{ $applicant->applicantData->address }}</span>
											</div>
											<div class="row mb-3">
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">CV</span>
													<a href="{{ asset('storage/' . $applicant->applicantData->cv) }}" target="_blank"
														class="badge bg-primary py-2">
														<span>Lihat CV</span>
													</a>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Surat Tembusan</span>
													<div>
														@if ($applicant->applicant_data && $applicant->applicant_data->school_mail)
															<a href="{{ asset('storage/' . $applicant->applicant_data->school_mail) }}" target="_blank"
																class="badge bg-primary py-2 ">
																<span>Lihat Surat Tembusan</span>
															</a>
														@else
															<span class="fw-semibold">Tidak ada surat tembusan</span>
														@endif
													</div>
												</div>
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
								<td colspan="6" class="text-center py-5 text-muted ">Pendaftaran kosong.</td>
							</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const verifyApplicants = document.querySelectorAll(".verify-applicant");

			verifyApplicants.forEach(form => {
				form.querySelector('.dropdown-item').addEventListener('click', function(event) {
					event.preventDefault(); // Prevent default form submission

					Swal.fire({
						title: 'Unggah Surat Keterangan Magang',
						text: "Silahkan unggah Surat Keterangan Magang terlebih dahulu.",
						input: 'file',
						inputAttributes: {
							'accept': 'image/*,application/pdf' // Sesuaikan dengan tipe file yang Anda butuhkan
						},
						showCancelButton: true,
						confirmButtonText: 'Unggah',
						cancelButtonText: 'Batal',
						preConfirm: (file) => {
							return new Promise((resolve, reject) => {
								if (file) {
									resolve(file);
								} else {
									reject('No file selected');
								}
							});
						}
					}).then((result) => {
						if (result.isConfirmed && result.value) {
							// Buat input file sementara untuk mengunggah file yang dipilih
							const fileInput = form.querySelector('input[type="file"]');
							const dataTransfer = new DataTransfer();
							dataTransfer.items.add(result.value);
							fileInput.files = dataTransfer.files;

							// Kirimkan formulir
							form.submit();
						}
					});
				});
			});
		});


		// Reject Applicant
		document.addEventListener("DOMContentLoaded", function() {
			const rejectApplicant = document.querySelectorAll(".reject-verify");

			rejectApplicant.forEach(btn => {
				btn.addEventListener("submit", function(event) {
					event.preventDefault();
					Swal.fire({
						title: "Menolak Verifikasi Pendaftar",
						text: "Apakah Anda yakin akan menolak memverifikasi pendaftar ini?",
						icon: "warning",
						showCancelButton: true,
						cancelButtonText: "Batal",
						confirmButtonText: "Tolak",
						reverseButtons: true,
					}).then((result) => {
						if (result.isConfirmed) {
							// Formulir akan disubmit secara otomatis
							btn.submit();
						}
					});
				});
			});
		});
	</script>
@endsection
