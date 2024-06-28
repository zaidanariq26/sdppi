<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Terima Kasih atas Pengajuan Magang Anda di SDPPI</title>
	</head>

	<body>
		<p>Kepada {{ $applicantStatus->user->name }},</p>
		<p>
			Terima kasih telah mengajukan permohonan untuk program magang di SDPPI. Kami sangat menghargai minat dan usaha
			yang Anda berikan.
		</p>
		<p>
			Setelah mempertimbangkan dengan cermat, kami mohon maaf karena saat ini kami belum dapat menerima Anda sebagai
			peserta magang di bagian {{ $applicantStatus->internship->title }}. Kami mendorong Anda untuk tetap bersemangat dan
			terus mencoba peluang lain yang mungkin sesuai dengan minat dan bakat Anda.
		</p>
		<p>Semoga Anda sukses dalam setiap usaha Anda ke depan.</p>
		<p>Salam hangat,</p>
		<p>Admin SDPPI</p>
	</body>

</html>
