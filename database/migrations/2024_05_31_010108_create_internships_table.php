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
		Schema::create("internships", function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger("user_id");

			// Mendefinisikan foreign key constraint dengan onDelete cascade
			$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

			$table->string("title");
			$table->string("slug");
			$table->string("division");
			$table->integer("vacancy_slots");
			$table->integer("duration_in_months");
			$table->text("description");
			$table->enum("status", ["menunggu", "diterima", "ditolak"])->default("menunggu");
			$table->date("intern_start")->nullable();
			$table->date("intern_end")->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists("internships");
	}
};
