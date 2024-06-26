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
		Schema::create("applicant_data", function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger("user_id");
			$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

			$table->string("name");
			$table->string("student_id")->unique();
			$table->string("school");
			$table->string("provinsi");
			$table->string("distrik");
			$table->string("kecamatan");
			$table->string("kelurahan");
			$table->text("address");
			$table->string("school_mail")->nullable();
			$table->string("cv");
			$table->string("image");

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists("applicant_data");
	}
};
