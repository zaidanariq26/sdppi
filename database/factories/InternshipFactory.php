<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internship>
 */
class InternshipFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$judul = $this->faker->sentence;
		$divisi = $this->faker->randomElement(["Informatika", "Komunikasi", "UI/UX Design"]);
		$deskripsi = $this->faker->paragraph;
		// $status = $this->faker->randomElement(["menunggu", "diterima", "ditolak"]);
		$jumlah_orang = $this->faker->randomDigit + 1;
		$duration = $this->faker->randomDigit + 1;

		// Tanggal posting saat ini
		$currentDate = Carbon::now();

		// Tambahkan 30 hari untuk mendapatkan tanggal pemberitahuan
		$notificationDate = $currentDate->copy()->addDays(30);

		// Durasi magang dalam bulan
		$internshipDurationInMonths = $duration;

		// Tambahkan durasi magang dalam bulan untuk mendapatkan tanggal akhir magang
		$internshipStartDate = $notificationDate->copy()->addMonth();
		$internshipEndDate = $internshipStartDate->copy()->addMonths($internshipDurationInMonths);

		// Format tanggal
		$formattedStartDate = $internshipStartDate->format("Y-m-d");
		$formattedEndDate = $internshipEndDate->format("Y-m-d");

		return [
			"title" => $judul,
			"user_id" => 1,
			"slug" => Str::slug($judul),
			"division" => $divisi,
			"vacancy_slots" => $jumlah_orang,
			"description" => $deskripsi,
			"duration_in_months" => $duration,
			"intern_start" => $formattedStartDate,
			"intern_end" => $formattedEndDate,
			"status" => "diterima"
		];
	}
}
