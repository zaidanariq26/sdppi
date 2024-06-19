@extends('dashboard.layouts.main')

@section('container')
	<div class="row py-4 px-md-5 px-3 table-section m-0 my-5">
		<h4 class="fw-semibold mb-5 mt-1 lh-custom text-center">
			Peserta Magang
		</h4>

		<div class="table-responsive-lg">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Lengkap</th>
						<th scope="col">Email</th>
						<th scope="col">Lowongan Magang</th>
						<th scope="col">Waktu Magang</th>
						<th scope="col">Status</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($userIntern as $user)
						<tr>
							<th scope="row">{{ $loop->iteration }}</th>
							<td>{{ $user->applicantData->name }}</td>
							<td>{{ $user->user->email }}</td>
							<td>{{ $user->internship->title }}</td>
							<td>{{ $user->internship->duration }}</td>
							<td>
								@php
									$classMap = [
									    'mendaftar' => 'bg-secondary',
									    'lulus' => 'bg-success',
									    'gagal' => 'bg-danger',
									    'verifikasi' => 'bg-warning',
									];
								@endphp
								<span class="ms-1 badge {{ $classMap[$user->status] ?? 'bg-secondary' }}">{{ ucfirst($user->status) }}</span>
							</td>
							<td>
								<button type="button" class="badge bg-primary border-0" data-bs-toggle="modal"
									data-bs-target="#exampleModal{{ $loop->iteration }}">
									Lihat
								</button>
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
												<span class="fw-semibold">{{ $user->applicantData->name }}</span>
											</div>
											<div class="row">
												<span class="text-secondary">ID Pelajar</span>
												<span class="fw-semibold">{{ $user->applicantData->student_id }}</span>
											</div>
											<div class="row">
												<span class="text-secondary">Email</span>
												<span class="fw-semibold">{{ $user->user->email }}</span>
											</div>
											<div class="row">
												<span class="text-secondary">Asal Sekolah/Instansi</span>
												<span class="fw-semibold">{{ $user->applicantData->school }}</span>
											</div>
											<div class="row">
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Provinsi</span>
													<span class="fw-semibold">{{ $user->applicantData->provinsi }}</span>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Kabupaten</span>
													<span class="fw-semibold">{{ $user->applicantData->distrik }}</span>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Kecamatan</span>
													<span class="fw-semibold">{{ $user->applicantData->kecamatan }}</span>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Kelurahan</span>
													<span class="fw-semibold">{{ $user->applicantData->kelurahan }}</span>
												</div>
											</div>
											<div class="row">
												<span class="text-secondary">Alamat Rumah</span>
												<span class="fw-semibold">{{ $user->applicantData->address }}</span>
											</div>
											<div class="row mb-3">
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">CV</span>
													<a href="{{ asset('storage/' . $user->applicantData->cv) }}" target="_blank" class="badge bg-primary py-2">
														<span>Lihat CV</span>
													</a>
												</div>
												<div class="col-md-6 mb-md-0 mb-3">
													<span class="text-secondary d-block">Surat Tembusan</span>
													<div>
														@if ($user->applicant_data && $user->applicant_data->school_mail)
															<a href="{{ asset('storage/' . $user->applicant_data->school_mail) }}" target="_blank"
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
								<td colspan="7" class="text-center py-5 text-muted ">Tida ada peserta magang.</td>
							</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection
