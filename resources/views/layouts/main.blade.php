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

		{{-- Bootstrap Icon --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

		<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
			rel="stylesheet" type="text/css" />
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

		{{-- Plugin Fileinput --}}
		<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js"
			type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js"
			type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
			type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
			type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

		<script src="/js/script.js"></script>

		<script>
			$(document).ready(function() {
				$("#input-b9").fileinput({
					showPreview: true,
					showUpload: false,
					elErrorContainer: '#kartik-file-errors',
					allowedFileExtensions: ["jpg", "png", "jpeg"],
				});
			});
		</script>

		{{-- API WILAYAH --}}
		<script>
			// API Provinsi
			$.ajax({
				url: "https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json",
				type: "GET",
				dataType: "json",
				success: function(data) {
					let optionProvince = '<option value="">--Pilih Provinsi--</option>';
					data.forEach((province) => {
						optionProvince +=
							`<option data-reg="${province.id}" value="${province.name}">${province.name}</option>`;
					});
					document.getElementById("provinsi").innerHTML = optionProvince;
				},
				error: function(error) {
					console.error("Error fetching data:", error);
				},
			});

			// API Kabupaten/Kota
			const selectProvince = document.getElementById("provinsi");
			selectProvince.addEventListener("change", (e) => {
				let province = e.target.options[e.target.selectedIndex].dataset.reg;
				$.ajax({
					url: `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${province}.json`,
					type: "GET",
					dataType: "json",
					success: function(data) {
						let optionDistrict = '<option value="">--Pilih Kabupaten/Kota--</option>';
						data.forEach((dist) => {
							optionDistrict +=
								`<option data-dist="${dist.id}" value="${dist.name}">${dist.name}</option>`;
						});
						document.getElementById("distrik").innerHTML = optionDistrict;
					},
					error: function(error) {
						console.error("Error fetching data:", error);
					},
				});
			});

			// API Kecamatan
			const selectDistrict = document.getElementById('distrik');
			selectDistrict.addEventListener('change', (e) => {
				let district = e.target.options[e.target.selectedIndex].dataset.dist;

				$.ajax({
					url: `https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${district}.json`,
					type: 'GET',
					dataType: 'json',
					success: function(data) {
						let optionKecamatan = '<option value="">--Pilih Kecamatan--</option>';
						data.forEach((kec) => {
							optionKecamatan +=
								`<option data-kec="${kec.id}" value="${kec.name}">${kec.name}</option>`;
						});
						document.getElementById("kecamatan").innerHTML = optionKecamatan;
					},
					error: function(error) {
						console.error("Error fetching data:", error);
					},
				})
			})

			// API Kelurahan
			const selectKecamatan = document.getElementById('kecamatan');
			selectKecamatan.addEventListener('change', (e) => {
				let kecamatan = e.target.options[e.target.selectedIndex].dataset.kec;

				$.ajax({
					url: `https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`,
					type: 'GET',
					dataType: 'json',
					success: function(data) {
						let optionKelurahan = '<option value="">--Pilih Kelurahan--</option>';
						data.forEach((kel) => {
							optionKelurahan +=
								`<option data-kel="${kel.id}" value="${kel.name}">${kel.name}</option>`;
						});
						document.getElementById("kelurahan").innerHTML = optionKelurahan;
					},
					error: function(error) {
						console.error("Error fetching data:", error);
					},
				})
			})
		</script>
	</body>

</html>
