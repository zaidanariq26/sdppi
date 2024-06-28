<?php

namespace Database\Seeders;

use App\Models\Internship;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::create([
			"name" => "Satuan Unit",
			"username" => "satuan_unit",
			"role" => "satuan-unit",
			"email" => "satuanunit@gmail.com",
			"password" => bcrypt("password")
		]);

		User::create([
			"name" => "Admin",
			"username" => "admin",
			"role" => "admin",
			"email" => "admin@gmail.com",
			"password" => bcrypt("password")
		]);

		User::create([
			"name" => "Biro Kepegawaian",
			"username" => "biro_kepegawaian",
			"role" => "biro-kepegawaian",
			"email" => "birokepegawaian@gmail.com",
			"password" => bcrypt("password")
		]);

		User::create([
			"name" => "Phantom",
			"username" => "phantom",
			"role" => "user",
			"email" => "usersatu789456@gmail.com",
			"password" => bcrypt("password")
		]);

		Internship::factory(20)->create();
	}
}
