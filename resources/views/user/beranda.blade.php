@extends('layouts.main')

@section('container')
	{{-- alert --}}
	@if (session()->has('success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				alertToast('success', '{{ session('success') }}')
			})
		</script>
	@endif

	@if (session()->has('update-data'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				alertToast('success', '{{ session('update-data') }}')
			})
		</script>
	@endif

	@if (session()->has('fill_data'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				Swal.fire({
					title: "Data belum lengkap",
					text: "{{ session('fill_data') }}",
					icon: "warning",
					confirmButtonText: "Lengkapi Data",
					allowOutsideClick: false,
					allowEscapeKey: false,
					allowEnterKey: false,
				}).then((result) => {
					if (result.isConfirmed) {
						// Redirect to the form page
						window.location.href = "{{ route('applicant.data.form') }}";
					}
				});
			});
		</script>
	@endif
	{{-- !!alert!! --}}
	<section class="row align-items-start " style="height:100vh; padding-top: 10%; margin-bottom:200px;">
		<div class="col-lg-6 order-2
		order-lg-1 mt-lg-0 mt-1">
			<h2 class="fw-semibold mb-3" style="line-height: 40px">Selamat Datang di SDPPI <br> Magang Kominfo</h2>
			<p class="mb-4">Daftarkan diri Anda dan bergabunglah dengan tim kami <br> untuk memulai pengalaman magang yang luar
				biasa!</p>
			<a href="{{ route('lowongan.magang') }}" class="btn btn-primary py-3 px-2 fw-semibold" style="width:250px">Cek Lowongan
				Magang</a>
		</div>

		<div class="col-lg-5 order-1 order-lg-2 mb-4 mb-md-0 offset-lg-1">
			<div class="row">
				<div class="slider-container">
					<div class="slider">
						<img id="dynamic-img2" src="img/SDPPI.png" alt="" class="img-fluid rounded-img">
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="row">
			<div class="col-12">
				<img id="sejarah" src="img/logo-sdppi-2019.png" alt="" class="img-fluid">
			</div>
		</div>

		<div class="row mt-5 justify-content-center">
			<div class="col-lg-8 text-center">
				<h1 class="text-center mb-5 fw-semibold" id="sejarah-singkat">Sejarah Singkat</h1>
				<p>Dalam rangka melaksanakan mandat dari Peraturan Presiden Nomor 24 Tahun 2010 tentang Kedudukan, Tugas, dan Fungsi
					Kementerian Negara serta Susunan Organisasi, Tugas, dan Fungsi Eselon I Kementerian Negara, maka pada tanggal 28
					Oktober 2010 ditetapkan struktur baru Kementerian Komunikasi dan Informatika berdasarkan Peraturan Menteri
					Komunikasi
					dan Informatika (Permenkominfo) Nomor 17/PER/M.KOMINFO/10/2010 tentang Organisasi dan Tata Kerja Kementerian
					Komunikasi dan Informatika sebagai pengganti dari Peraturan Menteri Kominfo Nomor 25/PER/M.KOMINFO/07/2008.
					<br><br>
					Struktur yang baru Kementerian Komunikasi dan Informatika terdiri dari Sekretariat Jenderal, Inspektorat Jenderal,
					Direktorat Jenderal Sumber Daya dan Perangkat Pos dan Informatika (Ditjen SDPPI), Direktorat Jenderal
					Penyelenggaraan
					Pos dan Informatika (Ditjen PPI), Direktorat Jenderal Aplikasi Informatika (Ditjen Aptika), Direktorat Jenderal
					Informasi dan Komunikasi Publik (Ditjen IKP) dan Badan Penelitian dan Pengembangan Sumber Daya Manusia. Dua
					Direktorat Jenderal yang baru yaitu Direktorat Jenderal Sumber Daya dan Perangkat Pos dan Informatika bersama
					Direktorat Jenderal Penyelenggaraan Pos dan Informatika merupakan hasil pemekaran dari Direktorat Jenderal Pos dan
					Telekomunikasi pada struktur organisasi yang lama.
				</p>
			</div>
		</div>

		<div class="row" id="fungsi" style="padding-top: 10%">
			<div class="p-3 text-light col-lg-3" style="background-color: #012850; border-radius: 10px">
				<h2 class="text-center fw-semibold">Fungsi SDPPI</h2>
			</div>
		</div>

		<div class="row mt-5 align-items-center justify-content-center">
			<div class="col-lg-4 offset-lg-1 text-center">
				<img class="mb-3" style="border-radius: 16px" src="img/image6.png" alt="" class="img-fluid">
			</div>
			<div class="col-lg-5 offset-lg-1 mt-3 mt-lg-0">
				<ol style="list-style-type: upper-alpha;" class="d-flex flex-column gap-3 list-fungsi">
					<li>Perumusan kebijakan di bidang penataan, perizinan, monitoring dan evaluasi, serta
						penegakan hukum penggunaan spektrum frekuensi radio dan orbit satelit, serta standardisasi perangkat pos dan
						informatika.
					</li>
					<li>Pelaksanaan kebijakan di bidang penataan, perizinan, monitoring dan evaluasi, serta penegakan hukum penggunaan
						spektrum frekuensi radio dan orbit satelit, serta standardisasi perangkat pos dan informatika.</li>
				</ol>
			</div>
		</div>

		<div class="row mt-5 align-items-center">
			<div class="col-lg-5 offset-lg-1 order-2 mt-3 mt-lg-0">
				<ol style="list-style-type: upper-alpha;" class="d-flex flex-column gap-3 list-fungsi" start="3">
					<li>Penyusunan norma, standar, prosedur, dan kriteria di bidang pengawasan standardisasi
						perangkat telekomunikasi.
					</li>
					<li>Pelaksanaan pemberian bimbingan teknis dan supervisi di bidang pengawasan standardisasi perangkat
						telekomunikasi.</li>
				</ol>
			</div>

			<div class="col-lg-4 offset-lg-1 order-lg-2 order-1 text-center">
				<img class="mb-3" style="border-radius: 16px" src="img/image7.png" alt="" class="img-fluid">
			</div>
		</div>


		<div class="row mt-5 align-items-center">
			<div class="col-lg-4 offset-lg-1 text-center">
				<img class="mb-3" style="border-radius: 16px" src="img/image8.png" alt="" class="img-fluid">
			</div>

			<div class="col-lg-5 offset-lg-1 mt-3 mt-lg-0">
				<ol style="list-style-type: upper-alpha;" class="d-flex flex-column gap-3 list-fungsi" start="5">
					<li>Pelaksanaan evaluasi dan pelaporan di bidang penataan, perizinan, monitoring dan evaluasi,
						serta penegakan hukum penggunaan spektrum frekuensi radio dan orbit satelit, serta standardisasi perangkat pos dan
						informatika.
					</li>
					<li>Pelaksanaan administrasi Direktorat Jenderal Sumber Daya dan Perangkat Pos dan Informatika.</li>
					<li>Pelaksanaan fungsi lain yang diberikan oleh Menteri.</li>
				</ol>
			</div>
		</div>
	</section>


	<script>
		// Array of image sources
		const images = ["img/SDPPI.png", "img/SDPPI2.png", "img/SDPPI3.png"];

		// Initial index
		let currentIndex = 0;

		// Function to change the image
		function changeImage() {
			currentIndex = (currentIndex + 1) % images.length;
			const dynamicImg = document.getElementById('dynamic-img2');
			if (dynamicImg) {
				dynamicImg.src = images[currentIndex];
			} else {
				console.error('Element with id "dynamic-img" not found.');
			}
		}

		// Change image every 3 seconds (3000 milliseconds)
		document.addEventListener("DOMContentLoaded", () => {
			setInterval(changeImage, 2000);
		});
	</script>
@endsection
