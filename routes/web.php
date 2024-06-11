<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BiroKepegawaianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\SatuanUnitController;
use App\Http\Controllers\UserApplicantController;
use App\Models\Post;

Route::get("/", function () {
	return view("home", [
		"title" => "Beranda"
	]);
});

Route::get("/about", function () {
	return view("about", [
		"title" => "About",
		"name" => "Ananda Rizky Sandika",
		"email" => "rizkysandika19@gmail.com"
		// "image" => ""
	]);
});

Route::get("/posts", function () {
	return view("posts", [
		"title" => "Lowongan Magang",
		"posts" => Post::all()
	]);
});

Route::get("/posts/{slug}", function ($slug) {
	return view("posts", [
		"title" => "Single Posts",
		"post" => Post::find($slug)
	]);
});

Route::post("/logout", [LoginController::class, "logout"])->name("logout");

Route::middleware(["guest"])->group(function () {
	Route::get("/login", [LoginController::class, "index"])->name("login");
	Route::post("/login", [LoginController::class, "authenticate"])->name("authenticate");

	Route::get("/register", [RegisterController::class, "index"])->name("register");
	Route::post("/register", [RegisterController::class, "store"])->name("register.post");

	Route::get("/forget-password", [ForgetPasswordManager::class, "forgetPassword"])->name("forget.password");
	Route::post("/forget-password", [ForgetPasswordManager::class, "forgetPasswordPost"])->name("forget.password.post");

	Route::get("/reset-password/{token}", [ForgetPasswordManager::class, "resetPassword"])->name("reset.password");
	Route::post("/reset-password", [ForgetPasswordManager::class, "resetPasswordPost"])->name("reset.password.post");
});

Route::middleware(["auth"])->group(function () {
	// Pemagang
	Route::middleware(["user_applicant"])->group(function () {
		Route::get("/lowongan-magang", [UserApplicantController::class, "index"])->name("lowongan.magang");
	});

	// Satuan Unit
	Route::middleware(["satuan_unit"])->group(function () {
		Route::get("/dashboard", [SatuanUnitController::class, "index"]);

		Route::get("/dashboard/form-pengajuan", [SatuanUnitController::class, "showForm"])->name("form.pengajuan");
		Route::post("/dashboard/form-pengajuan", [SatuanUnitController::class, "store"])->name("form.pengajuan.post");

		Route::get("/dashboard/riwayat-pengajuan", [SatuanUnitController::class, "showHistory"])->name("riwayat.index");
		Route::get("/dashboard/riwayat-pengajuan/accepted", [SatuanUnitController::class, "accepted"])->name("riwayat.accepted");
		Route::get("/dashboard/riwayat-pengajuan/rejected", [SatuanUnitController::class, "rejected"])->name("riwayat.rejected");
	});

	// Biro Kepegawaian
	Route::middleware(["biro_kepegawaian"])->group(function () {
		Route::get("/dashboard-biro", [BiroKepegawaianController::class, "index"]);

		Route::get("/dashboard-biro/verifikasi-pengajuan", [BiroKepegawaianController::class, "verify"])->name("verification.index");
		Route::put("/dashboard-biro/verifikasi-pengajuan/{internship}/accepted", [BiroKepegawaianController::class, "accepted"])->name("verification.accepted");
		Route::put("/dashboard-biro/verifikasi-pengajuan/{internship}/rejected", [BiroKepegawaianController::class, "rejected"])->name("verification.rejected");
		Route::get("/dashboard-biro/riwayat-verifikasi-pengajuan", [BiroKepegawaianController::class, "verificationHistory"])->name("verification.history");
	});

	// Admin
	Route::middleware(["admin"])->group(function () {
		Route::get("/dashboard-admin", [AdministratorController::class, "index"]);
		Route::get("/dashboard-admin/daftar-admin-sdppi", [AdministratorController::class, "showAdmin"])->name("list.admin");
		Route::delete("/dashboard-admin/daftar-admin-sdppi/{user}/delete", [AdministratorController::class, "deleteAdmin"])->name("list.admin.delete");

		Route::get("/dashboard-admin/lowongan-magang", [AdministratorController::class, "showAvailableInternship"])->name("list.internship");
	});
});
