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

Route::get("/about", function () {
	return view("about", [
		"title" => "About",
		"name" => "Ananda Rizky Sandika",
		"email" => "rizkysandika19@gmail.com"
		// "image" => ""
	]);
});

Route::post("/logout", [LoginController::class, "logout"])->name("logout");

Route::middleware(["redirect.if.auth"])->group(function () {
	Route::get("/", function () {
		return view("home", [
			"title" => "Beranda"
		]);
	});

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
		Route::get("/beranda", function () {
			return view("user.beranda", [
				"title" => "Beranda"
			]);
		})
			->name("beranda")
			->middleware("check.user.data");

		Route::get("/lowongan-magang", [UserApplicantController::class, "index"])
			->name("lowongan.magang")
			->middleware("check.user.data");

		Route::get("/kegiatanku", [UserApplicantController::class, "showStatusIntern"])
			->name("kegiatanku")
			->middleware("check.user.data");

		Route::get("/form-data-pemagang", [UserApplicantController::class, "formApplicant"])->name("applicant.data.form");
		Route::post("/form-data-pemagang", [UserApplicantController::class, "storeApplicantData"])->name("applicant.data.form.post");

		Route::get("/profil", [UserApplicantController::class, "showProfil"])->name("profil");
		Route::post("/update-foto-profil", [UserApplicantController::class, "updateProfilePhoto"])->name("update.foto.profil");

		Route::post("/daftar-magang/{internship}", [UserApplicantController::class, "registerInternship"])->name("daftar.magang");

		Route::get("/update-data-diri", [UserApplicantController::class, "showUpdateData"])->name("update.data");
		Route::put("/update-data-diri/{applicantData}", [UserApplicantController::class, "updateDataUser"])->name("update.data.put");
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

		Route::get("/dashboard-biro/verifikasi-pendaftar-magang", [BiroKepegawaianController::class, "verifyApplicantPage"])->name("verify.applicant.page");
		Route::post("/dashboard-biro/verifikasi-pendaftar-magang/{applicantStatus}/verifikasi", [BiroKepegawaianController::class, "verifyApplicant"])->name("verify.applicant");
		Route::put("/dashboard-biro/verifikasi-pendaftar-magang/{applicantStatus}/pendaftar-ditolak", [BiroKepegawaianController::class, "rejectVerifyApplicant"])->name("reject.verify.applicant");
	});

	// Admin
	Route::middleware(["admin"])->group(function () {
		Route::get("/dashboard-admin", [AdministratorController::class, "index"]);
		Route::get("/dashboard-admin/daftar-admin-sdppi", [AdministratorController::class, "showAdmin"])->name("list.admin");
		Route::delete("/dashboard-admin/daftar-admin-sdppi/{user}/delete", [AdministratorController::class, "deleteAdmin"])->name("list.admin.delete");

		Route::get("/dashboard-admin/lowongan-magang", [AdministratorController::class, "showAvailableInternship"])->name("list.internship");
		Route::delete("/dashboard-admin/lowongan-magang/{internship}", [AdministratorController::class, "deleteInternship"])->name("delete.internship");

		Route::get("/dashboard-admin/pendaftaran-magang", [AdministratorController::class, "userRegisterInternship"])->name("user.register.intern");
		Route::put("/dashboard-admin/pendaftaran-magang/{applicantStatus}/accepted", [AdministratorController::class, "acceptedApplicant"])->name("accept.applicant");
		Route::put("/dashboard-admin/pendaftaran-magang/{applicantStatus}/rejected", [AdministratorController::class, "rejectedApplicant"])->name("reject.applicant");

		Route::get("/dashboard-admin/peserta-magang", [AdministratorController::class, "listUserIntern"])->name("list.user.intern");
		Route::put("/dashboard-admin/peserta-magang/unggah-sertifikat/{applicantStatus}", [AdministratorController::class, "uploadCertificate"])->name("upload.certificate");
	});
	Route::get("/dashboard-admin/profil-admin", [AdministratorController::class, "showProfileAdmin"])->name("profile.admin");
});
