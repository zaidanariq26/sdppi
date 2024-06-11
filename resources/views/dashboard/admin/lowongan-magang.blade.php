@extends('dashboard.layouts.main')

@section('container')
	@if (session()->has('success'))
		<div class="alert alert-success d-flex align-items-center alert-dismissible fade show centered-alert col-md-8 col-10"
			role="alert">
			<i class="bi bi-check-circle-fill"></i>
			<div class="ms-md-2 ms-3">
				{{ session('success') }}
			</div>
		</div>
	@endif

	<div class="row py-4 px-md-5 px-3 table-section m-0 my-5">
		<h4 class="fw-semibold mb-5 mt-1 lh-custom text-center">
			Lowongan Magang
		</h4>
		<div class="d-flex justify-content-between align-items-center mb-4" style="padding-inline: 8px">
			{{-- <form id="deleteForm" action="{{ route('riwayat.delete.all') }}" method="post">
				@csrf
				@method('delete')
				<button type="submit" class="btn btn-outline-danger p-md-2">
					<span class="d-sm-block d-none">Hapus Riwayat</span>
					<span data-bs-toggle="tooltip" data-bs-title="Hapus Riwayat" data-feather="trash-2" width="18" height="18"
						class="align-text-bottom d-sm-none"></span>
				</button>
			</form> --}}
		</div>

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
							<td>

								<div>
									<button type="button" data-bs-title="Lihat" class="badge bg-warning border-0" data-bs-toggle="modal"
										data-bs-target="#exampleModal{{ $loop->iteration }}">
										<span data-feather="eye" width="18" height="18" class="align-text-bottom"></span>
									</button>
								</div>

								{{-- <form action='{{ route('riwayat.delete', $intern->id) }}' method="post" class="d-md-inline d-none">
									@method('delete')
									@csrf
									<button class="badge bg-danger border-0" data-bs-toggle="tooltip" data-bs-title="Hapus"
										onclick="return confirm('Apakah Anda yakin?')">
										<span data-feather="trash-2" width="18" height="18" class="align-text-bottom"></span>
									</button>
								</form> --}}
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
												<h6>Status:</h6>
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
							<td colspan="5" class="text-center py-5 text-muted ">Tidak ada riwayat pengajuan!</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>

	<script>
		// Button Hapus Riwayat
		document.getElementById('deleteForm').addEventListener('submit', function(event) {
			if (!confirm('Apakah Anda yakin?')) {
				event.preventDefault(); // Mencegah pengiriman form
			}
		});
	</script>
@endsection
