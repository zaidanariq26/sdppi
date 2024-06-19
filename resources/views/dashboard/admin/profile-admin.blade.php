@extends('dashboard.layouts.main')

@section('container')
	<section class="pt-4">
		<h1 class="mb-5 text-center">Profil Admin</h1>
		<section class="card p-5">
			<div class="d-flex align-items-center flex-md-row flex-column">
				<div class="profile-user d-block">
					<img src="/img/logo-admin3.png" class="img-fluid rounded-circle">
				</div>

				<div class="data-user ms-5 mt-md-0 mt-4 mx-auto text-md-start text-center">
					<ul style="list-style: none" class="p-0 mb-0">
						<li class="fs-3 fw-semibold">{{ $data->name }}</li>
						<li class="fs-5 text-secondary">{{ $data->username }}</li>
						<li class="fs-5 text-secondary">{{ $data->email }}</li>
					</ul>
				</div>
			</div>
		</section>
	</section>
@endsection
