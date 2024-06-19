{{-- <!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Notifikasi Penerimaan Magang</title>
	</head>

	<body>
		<p>Kepada {{ $applicant->user->name }},</p>
		<p>Selamat! Kami dengan senang hati menginformasikan bahwa Anda telah diterima untuk bergabung dalam lowongan magang
			{{ $applicant->internship->title }} di SDPPI.</p>
		<p>Kami percaya bahwa Anda akan memberikan kontribusi yang berharga dan memiliki pengalaman yang berharga dalam
			program ini.</p>
		<p>Silakan siapkan diri Anda untuk memulai perjalanan ini. Klik link di bawah ini untuk melihat info lebih lanjut.</p>

		<div>
			<a href="{{ route('kegiatanku') }}">Kegiatanku</a>
		</div>

		<p>Terima kasih atas minat dan dedikasi Anda.</p>
		<p>Salam hangat,</p>
		<p>Tim SDPPI</p>
	</body>

</html> --}}


<!DOCTYPE html>
<html>

	<head>
		<title>Pemberitahuan Magang</title>
		<style>
			/* Styling untuk konten email */
			body {
				font-family: Arial, sans-serif;
				margin: 0;
				padding: 0;
				background-color: #f4f4f4;
				text-align: center;
			}

			.container {
				max-width: 600px;
				margin: 20px auto;
				padding: 20px;
				background-color: #fff;
				border-radius: 8px;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			}

			img {
				max-width: 100%;
				height: auto;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<img src="{{ asset('img/KOMINFO.png') }}" alt="Logo Perusahaan" style="max-width: 150px;">
			<h2>Selamat! Anda Diterima untuk Magang di Perusahaan Kami</h2>
			<p>Halo {{ $applicant->user->name }},</p>
			<p>Kami senang untuk memberitahu bahwa Anda telah diterima untuk magang di perusahaan kami. Kami yakin Anda akan
				memiliki pengalaman yang berharga dan berharga selama magang Anda.</p>
			<p>Berikut adalah detail penting terkait magang Anda:</p>
			<ul>
				<li><strong>Tanggal Magang:</strong> {{ $applicant->internship->duration }}</li>
				<li><strong>Kontak Person:</strong> +628123456789</li>
				<li><strong>Informasi Tambahan:</strong> Kirim melalui email yang kami sediakan untuk informasi tambahan</li>
			</ul>
			<p>Jika Anda memiliki pertanyaan lebih lanjut atau perlu informasi tambahan, jangan ragu untuk menghubungi kami di <a
					href="">admin@gmail.com</a> atau +628123456789.</p>
			<p>Salam hangat,<br>Tim Magang SDPPI</p>
		</div>
	</body>

</html>
