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

	<div class="row m-0 my-4 form-pembukaan">
		<h4 class="fw-semibold lh-custom text-center">
			Form Pengajuan Pembukaan <br />
			Lowongan Magang
		</h4>
		<form id="form-pengajuan" class="mt-5" method="post" action="{{ route('form.pengajuan.post') }}">
			@csrf
			<div class="mb-3">
				<label for="title" class="form-label">Judul</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
					placeholder="Tuliskan judul di sini" value="{{ old('title') }}" required autofocus />

				@error('title')
					<div class="invalid-feedback my-1">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="slug" class="form-label">Slug</label>
				<input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required />
			</div>
			<div class="mb-3">
				<label for="division" class="form-label">Divisi</label>
				<select class="form-select @error('division') is-invalid @enderror" id="division" name="division">
					<option value="" selected disabled>Pilih divisi</option>
					<option value="Informatika">Informatika</option>
					<option value="Komunikasi">Komunikasi</option>
					<option value="UI/UX Design">UI/UX Design</option>
				</select>

				@error('division')
					<div class="invalid-feedback my-1">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="vacancy_slots" class="form-label">Jumlah Orang yang Dibutuhkan</label>
						<select class="form-select" id="vacancy_slots" name="vacancy_slots">
							@for ($i = 1; $i <= 10; $i++)
								<option value="{{ $i }}">{{ $i }} orang</option>
							@endfor
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-3">
						<label for="duration" class="form-label">Waktu Magang</label>
						<select class="form-select" id="duration" name="duration_in_months">
							@for ($i = 1; $i <= 6; $i++)
								<option value="{{ $i }}">{{ $i }} bulan</option>
							@endfor
						</select>
					</div>
				</div>
			</div>
			<div class="mb-3">
				<label for="description" class="form-label">Deskripsi</label>
				@error('description')
					<p class="text-danger">{{ $message }}</p>
				@enderror
				<input id="description" type="hidden" name="description" value="{{ old('description') }}">
				<trix-editor input="description"></trix-editor>
			</div>

			<button type="submit" class="btn btn-primary mt-2">Kirim</button>
		</form>
	</div>

	<script>
		// Mengisi field Slug secara ototmatis berdasarkan Judul
		const judulInput = document.querySelector('#title');
		const slugInput = document.querySelector('#slug');

		judulInput.addEventListener('change', () => {
			let slug = judulInput.value.toLowerCase().split(' ').join('-')
			slugInput.value = slug
		})

		// Matiin ikon upload di trix
		document.addEventListener('trix-file-accept', function(e) {
			e.preventDefault()
		})

		document.addEventListener("DOMContentLoaded", function() {
			const formPengajuanBtn = document.getElementById("form-pengajuan");

			formPengajuanBtn.addEventListener("submit", function(event) {
				event.preventDefault();
				Swal.fire({
					title: "Apakah Anda yakin?",
					text: "Pastikan data pengajuan Anda sudah benar.",
					icon: "warning",
					showCancelButton: true,
					cancelButtonText: "Batal",
					confirmButtonText: "Kirim",
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						// Formulir akan disubmit secara otomatis
						formPengajuanBtn.submit();
					}
				});
			});
		});
	</script>
@endsection
