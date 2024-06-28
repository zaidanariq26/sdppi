@extends('layouts.main')

@section('container')
	<section class="pt-4">
		<h1 class="mb-4 text-center">Form Data Diri</h1>
		<form id="form-data-pemagang" class="mt-5" method="post" action="{{ route('applicant.data.form.post') }}""
			enctype="multipart/form-data">
			@csrf
			<div class="mb-4">
				<label for="name" class="form-label">Nama Lengkap</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
					placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus autocomplete="off" />
				@error('name')
					<div class="invalid-feedback my-1">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="student_id" class="form-label">ID Pelajar</label>
				<input type="number" class="form-control @error('student_id') is-invalid @enderror" id="student_id"
					name="student_id" placeholder="Masukkan ID pelajar" value="{{ old('student_id') }}" required autocomplete="off" />
				@error('student_id')
					<div class="invalid-feedback my-1">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="school" class="form-label">Asal Sekolah/Universitas</label>
				<input type="text" class="form-control @error('school') is-invalid @enderror" id="school" name="school"
					placeholder="Masukkan asal sekolah/universitas" value="{{ old('school') }}" required autocomplete="off" />
				@error('school')
					<div class="invalid-feedback my-1">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="row mb-4">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="provinsi" class="form-label">Provinsi</label>
						<select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
							<option value="">--Pilih Provinsi--</option>
						</select>
						@error('provinsi')
							<div class="invalid-feedback my-1">
								{{ $message }}
							</div>
						@enderror
					</div>
				</div>

				<div class="col-md-6">
					<div class="mb-3">
						<label for="distrik" class="form-label">Kabupaten/Kota</label>
						<select class="form-select @error('distrik') is-invalid @enderror" id="distrik" name="distrik">
							<option value="" selected disabled>--Pilih Kabupaten/Kota--</option>
						</select>
						@error('distrik')
							<div class="invalid-feedback my-1">
								{{ $message }}
							</div>
						@enderror
					</div>
				</div>

				<div class="col-md-6">
					<div class="mb-3">
						<label for="kecamatan" class="form-label">Kecamatan</label>
						<select class="form-select @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
							<option value="" selected disabled>--Pilih Kecamatan--</option>
						</select>
						@error('kecamatan')
							<div class="invalid-feedback my-1">
								{{ $message }}
							</div>
						@enderror
					</div>
				</div>


				<div class="col-md-6">
					<div class="mb-3">
						<label for="kelurahan" class="form-label">Kelurahan</label>
						<select class="form-select @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan">
							<option value="" selected disabled>--Pilih Kelurahan--</option>
						</select>
						@error('kelurahan')
							<div class="invalid-feedback my-1">
								{{ $message }}
							</div>
						@enderror
					</div>
				</div>
			</div>

			<div class="mb-4">
				<label for="address" class="form-label @error('address') is-invalid @enderror">Alamat Rumah</label>
				<textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat rumah"
				 required></textarea>
				@error('address')
					<div class="invalid-feedback my-1">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="school_mail" class="form-label">Surat Tembusan Sekolah (jika ada)</label>
				<input id="input-id" name="school_mail" type="file" class="file" data-browse-on-zone-click="true"
					data-show-upload="false" data-show-caption="true" data-msg-placeholder="Pilih {files} untuk diunggah..."
					data-allowed-file-extensions='["pdf"]'>
				@error('school_mail')
					<div class="invalid-feedback my-1">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="row mb-4">
				<div class="col-md-6">
					<div class="mb-3">
						<label for="image" class="form-label">Foto Profil</label>
						<input id="input-b1" name="image" type="file" class="file" data-browse-on-zone-click="true"
							data-show-upload="false" data-show-caption="true" data-msg-placeholder="Pilih {files} untuk diunggah..."
							data-allowed-file-extensions='["jpg", "png", "jpeg"]' required>
						@error('image')
							<div class="invalid-feedback my-1">
								{{ $message }}
							</div>
						@enderror
					</div>
				</div>

				<div class="col-md-6">
					<div class="mb-3">
						<label for="cv" class="form-label">Unggah CV</label>
						<input id="input-id" name="cv" type="file" class="file" data-browse-on-zone-click="true"
							data-show-upload="false" data-show-caption="true" data-msg-placeholder="Pilih {files} untuk diunggah..."
							data-allowed-file-extensions='["pdf"]' required>
						@error('cv')
							<div class="invalid-feedback my-1">
								{{ $message }}
							</div>
						@enderror
					</div>
				</div>
			</div>

			<button type="submit" class="btn btn-primary mt-2" style="">Submit</button>
		</form>

	</section>
	<script>
		// Button Submit
		document.addEventListener("DOMContentLoaded", function() {
			const formPemagang = document.getElementById("form-data-pemagang");

			formPemagang.addEventListener("submit", function(event) {
				event.preventDefault();

				Swal.fire({
					title: "Apakah Anda yakin?",
					text: "Pastikan data pribadi Anda sudah benar.",
					icon: "warning",
					showCancelButton: true,
					cancelButtonText: "Batal",
					confirmButtonText: "Submit",
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						// Formulir akan disubmit secara otomatis
						formPemagang.submit();
					}
				});
			});
		});
	</script>
@endsection
