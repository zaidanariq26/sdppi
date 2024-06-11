<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>SDPPI Magang | {{ $title }}</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

		{{-- My CSS --}}
		<link rel="stylesheet" href="/css/dashboard-style.css" />

		{{-- Bootstrap Icon --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

		{{-- Jquery Confirm --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">

		{{-- Trix --}}
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
	</head>
	<style>
		trix-toolbar [data-trix-button-group="file-tools"] {
			display: none
		}
	</style>

	<body>
		<div class="row h-100">
			<!-- SIDEBAR -->
			@include('dashboard.layouts.sidebar')
			<!-- !!SIDEBAR!! -->

			<div class="col-sm-10 mx-auto px-sm-0 px-3">
				{{-- Header --}}
				@include('dashboard.layouts.header')
				{{-- !!Header!! --}}

				{{-- Content --}}
				<main>
					@yield('container')
				</main>
				{{-- !!Content!! --}}
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
		</script>
		<script src="https://unpkg.com/feather-icons"></script>
		<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"
			integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="/js/script.js"></script>
	</body>

</html>
