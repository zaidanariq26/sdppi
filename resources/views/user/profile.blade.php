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
		<h1 class="mb-5 text-center">Profil</h1>

		<section class="card p-5">
			<div class="d-flex align-items-center flex-md-row flex-column">
				<div class="profile-user d-block">
					<img src="{{ asset('storage/' . $applicant_data->image) }}" class="img-fluid rounded-circle">
				</div>

				<div class="data-user ms-5 mt-md-0 mt-4 mx-auto text-md-start text-center">
					<ul style="list-style: none" class="p-0 mb-0">
						<li class="fs-3 fw-semibold">{{ $applicant_data->name }}</li>
						<li class="fs-5 text-secondary">{{ $applicant_data->user->username }}</li>
						<li class="fs-5 text-secondary">{{ $applicant_data->user->email }}</li>
						<li class="mt-4">
							<button id="change-photo-btn" class="btn btn-outline-primary fw-semibold" data-bs-toggle="modal"
								data-bs-target="#exampleModal">GANTI FOTO</button>
							<a href="{{ route('update.data') }}" class="btn btn-outline-primary fw-semibold">PERBARUI DATA</a>
						</li>
					</ul>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<form action="{{ route('update.foto.profil') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="modal-dialog modal-lg modal-fullscreen-lg-down">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Perbarui Foto Profil</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="file-loading">
											<input id="input-b9" name="image" multiple type="file"'>
										</div>
										<div id="kartik-file-errors"></div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-primary">Perbarui</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

		<section class="mt-5">
			<div class="mb-4">
				<label for="name" class="form-label">Nama Lengkap</label>
				<input type="text" class="form-control" value="{{ $applicant_data->name }}" disabled />
			</div>

			<div class="mb-4">
				<label class="form-label">ID Pelajar</label>
				<input type="number" class="form-control" value="{{ $applicant_data->student_id }}" disabled />
			</div>

			<div class="mb-4">
				<label class="form-label">Asal Sekolah</label>
				<input type="text" class="form-control" value="{{ $applicant_data->school }}" disabled />
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="mb-4">
						<label class="form-label">Provinsi</label>
						<input type="text" class="form-control" value="{{ $applicant_data->provinsi }}" disabled />
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-4">
						<label class="form-label">Kabupaten/Kota</label>
						<input type="text" class="form-control" value="{{ $applicant_data->distrik }}" disabled />
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-4">
						<label class="form-label">Kecamatan</label>
						<input type="text" class="form-control" value="{{ $applicant_data->kecamatan }}" disabled />
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-4">
						<label class="form-label">Kelurahan</label>
						<input type="text" class="form-control" value="{{ $applicant_data->kelurahan }}" disabled />
					</div>
				</div>
			</div>

			<div class="mb-4">
				<label class="form-label">Alamat Rumah</label>
				<textarea class="form-control" rows="3" disabled>{{ $applicant_data->address }}</textarea>
			</div>

			<div class="row gy-4">
				<div class="col-md-6">
					<label class="form-label">CV</label>
					<div>
						@if (auth()->user()->applicant_data && auth()->user()->applicant_data->cv)
							<a href="{{ asset('storage/' . auth()->user()->applicant_data->cv) }}" target="_blank"
								class="btn btn-primary py-2">
								<span>Lihat CV</span>
							</a>
						@else
							<button class="btn btn-secondary py-2">Tidak ada CV</button>
						@endif
					</div>

				</div>
				<div class="col-md-6">
					<label class="form-label">Surat Tembusan</label>
					<div>
						@if (auth()->user()->applicant_data && auth()->user()->applicant_data->school_mail)
							<a href="{{ asset('storage/' . auth()->user()->applicant_data->school_mail) }}" target="_blank"
								class="btn btn-primary py-2 ">
								<span>Lihat Surat Tembusan</span>
							</a>
						@else
							<button class="btn btn-secondary py-2">Tidak ada surat</button>
						@endif
					</div>
				</div>
			</div>
		</section>
	</section>
@endsection
