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
			"name" => "Zaidan Ariq",
			"username" => "zaidan",
			"role" => "satuan-unit",
			"email" => "zaidanariq86@gmail.com",
			"password" => bcrypt("password")
		]);

		User::create([
			"name" => "dragon",
			"username" => "dragon_knigth",
			"role" => "satuan-unit",
			"email" => "dragon@gmail.com",
			"password" => bcrypt("password")
		]);

		User::create([
			"name" => "Ariq Zaidn",
			"username" => "ariq26",
			"role" => "admin",
			"email" => "ariq26@gmail.com",
			"password" => bcrypt("password")
		]);

		User::create([
			"name" => "Ariq",
			"username" => "ariq",
			"role" => "biro-kepegawaian",
			"email" => "ariq503@gmail.com",
			"password" => bcrypt("password")
		]);

		User::create([
			"name" => "Phantom",
			"username" => "phantom",
			"role" => "user",
			"email" => "phantom@gmail.com",
			"password" => bcrypt("password")
		]);

		Internship::factory(15)->create();
	}
}
