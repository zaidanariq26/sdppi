@extends('dashboard.layouts.main')

@section('container')
	<div class="row py-4 px-5 table-section m-0 my-5">
		<h4 class="fw-semibold mb-5 mt-1 lh-custom text-center">
			Daftar Admin SDPPI
		</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama</th>
					<th scope="col" class="d-none d-md-flex">Email</th>
					<th scope="col">Peran</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($users as $user)
					<tr>
						<th scope="row">{{ $loop->iteration }}</th>
						<td>{{ $user->name }}</td>
						<td class="d-none d-md-flex">{{ $user->email }}</td>
						<td>{{ $user->role }}</td>
						<td>
							<form action='{{ route('list.admin.delete', $user->id) }}' method="post" class="delete-admin">
								@method('delete')
								@csrf
								<button class="badge bg-danger border-0" title="Hapus" type="submit">
									<span data-feather="trash-2" width="18" height="18" class="align-text-bottom"></span>
								</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-center py-5 text-muted ">Tidak ada admin yang terdaftar!</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const deleteAdminBtn = document.querySelectorAll(".delete-admin");

			deleteAdminBtn.forEach(function(deleteAdmin) {
				deleteAdmin.addEventListener("submit", function(event) {
					event.preventDefault();

					Swal.fire({
						title: "Apakah Anda yakin?",
						text: "Pastikan admin yang akan Anda hapus sudah benar.",
						icon: "warning",
						showCancelButton: true,
						cancelButtonText: "Batal",
						confirmButtonText: "Hapus",
						reverseButtons: true,
					}).then((result) => {
						if (result.isConfirmed) {
							// Use AJAX to submit the form
							$.ajax({
								url: deleteAdmin.action,
								type: deleteAdmin.method,
								data: $(deleteAdmin).serialize(),
								success: function(response) {
									Swal.fire({
										title: "Berhasil!",
										text: "Admin berhasil dihapus.",
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
