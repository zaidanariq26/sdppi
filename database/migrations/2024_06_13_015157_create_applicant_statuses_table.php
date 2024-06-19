<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create("applicant_statuses", function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger("user_id");
			$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
			$table->unsignedBigInteger("internship_id");
			$table->foreign("internship_id")->references("id")->on("internships")->onDelete("cascade");

			$table->enum("status", ["mendaftar", "verifikasi", "gagal", "lulus"])->default("mendaftar");
			$table->string("certificate")->nullable();
			$table->string("surat_keterangan")->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists("applicant_statuses");
	}
};
