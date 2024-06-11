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
		<h5 class="fw-semibold dashboard-overview">SDPPI - Biro Kepegawaian</h5>
	</div>

	<div class="row py-4 px-5 table-section m-0 my-5">
		<h4 class="fw-semibold mb-5 mt-1 lh-custom text-center">
			Daftar Lowongan Magang yang Terverifikasi
		</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Judul</th>
					<th scope="col">Divisi</th>
					<th scope="col">Slot</th>
					<th scope="col">Durasi</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($internships as $intern)
					<tr>
						<th scope="row">{{ $loop->iteration }}</th>
						<td>{{ $intern->title }}</td>
						<td>{{ $intern->division }}</td>
						<td>{{ $intern->vacancy_slots }} orang</td>
						<td>{{ $intern->duration_in_months }} bulan</td>
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
						<td colspan="6" class="text-center py-5 text-muted ">Tidak ada pengajuan lowongan magang!</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
@endsection
