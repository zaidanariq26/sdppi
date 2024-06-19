@extends('layouts.main')

@section('container')
	@if (session()->has('success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				alertToast('success', '{{ session('success') }}')
			})
		</script>
	@endif
	<section class="pt-4">
		<h1 class="mb-5 text-center">Kegiatanku</h1>
		<div class="row g-3">
			@forelse ($applicants as $applicant)
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title fw-semibold" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
								{{ $applicant->internship->title }}</h5>
							<p class="card-text mb-0">Divisi {{ $applicant->internship->division }}</p>
							<p class="card-text mb-0"> {{ $applicant->internship->duration }}</p>
							<p class="card-text mt-3"> Status:
								@php
									$classMap = [
									    'mendaftar' => 'bg-secondary',
									    'lulus' => 'bg-success',
									    'gagal' => 'bg-danger',
									    'verifikasi' => 'bg-warning',
									];
								@endphp
								<span
									class="badge {{ $classMap[$applicant->status] ?? 'bg-secondary' }}">{{ ucfirst($applicant->status) }}</span>
							</p>
							<button class="btn btn-primary float-end" data-bs-toggle="modal"
								data-bs-target="#exampleModal{{ $loop->iteration }}">Lihat Selengkapnya</button>
						</div>

						{{-- Modal --}}
						<div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog ">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title fw-semibold" id="exampleModalLabel">{{ $applicant->internship->title }} </h3>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body ">
										<div class="row gap-sm-0 gap-3">
											<div class="col-sm-6 d-flex flex-column gap-3">
												<div class="row">
													<span class="text-secondary">Divisi</span>
													<span class="fw-semibold">{{ $applicant->internship->division }}</span>
												</div>
												<div class="row">
													<span class="text-secondary">Waktu Magang</span>
													<span class="fw-semibold">{{ $applicant->internship->duration }}</span>
												</div>
												<div class="row">
													<span class="text-secondary">Slot Pemagang</span>
													<span class="fw-semibold">{{ $applicant->internship->vacancy_slots }} orang</span>
												</div>
											</div>
											<div class="col-sm-6 d-flex justify-content-sm-end align-items-start">
												<h6>Status: </h6>
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
											</div>
										</div>

										<hr>

										<div class="row">
											<h5 class="fw-semibold"> Deskripsi </h5>
											<span>{!! $applicant->internship->description !!}</span>
										</div>

										<hr>

										<div class="row g-2 mt-4">
											<a href="{{ asset('storage/' . $applicant->surat_keterangan) }}" class="btn btn-primary">Surat Keterangan</a>
											<button type="button" class="btn btn-success">Sertifikat Kelulusan</button>
										</div>
									</div>
									<div class="modal-footer">

										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@empty
				<h3 class="text-center text-secondary">Tidak ada kegiatan</h3>
			@endforelse
		</div>
		</div>
	</section>
@endsection
