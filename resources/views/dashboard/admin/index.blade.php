@extends('dashboard.layouts.main')

@section('container')
	{{-- alert --}}
	@if (session()->has('success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				alertToast('success', '{{ session('success') }}')
			})
		</script>
	@endif
	{{-- !!alert!! --}}
	<div class="row mt-4">
		<h3 class="fw-bold">Selamat datang, {{ auth()->user()->name }}</h3>
		<h5 class="fw-semibold dashboard-overview">SDPPI - Admin</h5>
	</div>

	<div class="row mt-4 gx-2 gy-lg-0 gy-2">
		<div class="col-lg-3 col-sm-6 admin-box">
			<div class="card p-4">
				<div class="row align-items-center">
					<div class="col-8 pe-0">
						<h3 class="fw-semibold">{{ $users->where('role', 'admin')->count() }}</h3>
						<div>Admin</div>
					</div>
					<div class="col-4">
						<div class="box d-flex justify-content-center align-items-center mx-auto">
							<i data-feather="user" width="35" height="35" stroke-width="2"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 admin-box">
			<div class="card p-4">
				<div class="row align-items-center">
					<div class="col-8 pe-0">
						<h3 class="fw-semibold">{{ $users->where('role', 'biro-kepegawaian')->count() }}</h3>
						<div>Kepegawaian</div>
					</div>
					<div class="col-4 p-0">
						<div class="box d-flex justify-content-center align-items-center mx-auto">
							<i data-feather="user" width="35" height="35" stroke-width="2"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 admin-box">
			<div class="card p-4">
				<div class="row align-items-center">
					<div class="col-8 pe-0">
						<h3 class="fw-semibold">{{ $users->where('role', 'satuan-unit')->count() }}</h3>
						<div>Satuan Unit</div>
					</div>
					<div class="col-4">
						<div class="box d-flex justify-content-center align-items-center mx-auto">
							<i data-feather="user" width="35" height="35" stroke-width="2"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-6 admin-box">
			<div class="card p-4">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="fw-semibold">{{ $users->where('role', 'user')->count() }}</h3>
						<div>User</div>
					</div>
					<div class="col-4">
						<div class="box d-flex justify-content-center align-items-center mx-auto">
							<i data-feather="user" width="35" height="35" stroke-width="2"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- <div class="row py-4 px-5 table-section m-0 my-5">
		<h4 class="fw-semibold mb-5 mt-1 lh-custom text-center">
			Status Pengajuan Pembukaan <br />
			Lowongan Magang
		</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Judul</th>
					<th scope="col">Divisi</th>
					<th scope="col">Status</th>
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
					</tr>
				@empty
					<tr>
						<td colspan="5" class="text-center py-5 text-muted ">Tidak ada riwayat pengajuan!</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div> --}}
@endsection
