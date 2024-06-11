@extends('layouts.main')

@section('container')
	<section class="pt-4">
		<h1 class="mb-4">Lowongan Magang</h1>
		<div class="row">
			@forelse ($internships as $intern)
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
								{{ $intern->title }}</h5>
							<p class="card-text">Divisi {{ $intern->division }}</p>
							<a href="" class="btn btn-primary">Submit</a>
						</div>
					</div>
				</div>
			@empty
				<p class="text-center">Tidak ada lowongan</p>
			@endforelse

		</div>
		</div>
	</section>
@endsection
