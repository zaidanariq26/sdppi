<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SDPPI Magang | {{ $title }}</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link rel="shortcut icon" href="img/kominfo-logo.png" type="image/x-icon">
		{{-- My Style --}}
		<link rel="stylesheet" href="/css/styles.css">
	</head>

	<body class="overflow-x-hidden">
		{{-- Navbar --}}
		@include('partials.navbar')
		{{-- End Navbar --}}

		<div class="container" style="padding-top: 5rem">
			@yield('container')
		</div>

		@include('partials.footer')
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
		</script>
		<script src="https://unpkg.com/feather-icons"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"
			integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="/js/script.js"></script>
	</body>

</html>
