@extends('layouts.main')

@section('container')
	<main class="container">
		{{-- alert --}}
		@if (session()->has('success'))
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					alertToast('success', "{{ session('success') }}")
				})
			</script>
		@endif

		@if (session()->has('loginError'))
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					alertToast('error', "{{ session('loginError') }}")
				})
			</script>
		@endif
		{{-- !!alert!! --}}

		<div class="row align-items-center h-100">
			<div class="col-lg-7">
				<img src="img/image5.png" alt="" class="img-fluid">
			</div>
			<div class="col-lg-5">
				<div class="">
					<h1 class="mb-3">Selamat Datang</h1>
					<p>Selamat datang di halaman login, registrasi terlebih dahulu jika tidak memiliki akun.</p>
				</div>
				<form method="post" action="{{ route('authenticate') }}">
					@csrf
					<div class="form-floating mb-3">
						<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email"
							autocomplete="off">
						<label for="floatingInput">Email address</label>
					</div>
					<div class="form-floating mb-3">
						<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
						<label for="floatingPassword">Password</label>
					</div>
					<div class="form-check mb-3">
						<label class="form-check-label" for="flexCheckDefault">Remember me</label>
						<input class="form-check-input" type="checkbox" name="remember" value="1" id="flexCheckDefault">
						<a href="/forget-password" class="float-end" style="text-decoration: none;">Lupa Password?</a>
					</div>
					<button class="btn btn-primary w-100 mb-2" style="background-color: #012850; border: none; padding-block: 10px"
						type="submit">Log in</button>
				</form>
				<small class="d-block text-center mt-2">Belum Terdaftar? <a style="text-decoration: none;" href="/register">Daftar
						Sekarang!</a></small>
			</div>

		</div>
	</main>
@endsection
