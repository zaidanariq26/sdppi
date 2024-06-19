<?php

namespace App\Http\Controllers;

use App\Models\ApplicantStatus;
use App\Models\ApplicantData;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Internship;

class AdministratorController extends Controller
{
	public function index()
	{
		$user = User::all();
		$internship = Internship::where("status", "diterima")->get();
		return view("dashboard.admin.index", [
			"title" => "Dashboard",
			"internships" => $internship,
			"users" => $user
		]);
	}
	public function showAdmin()
	{
		$user = User::whereNotIn("role", ["user"])->get();
		return view("dashboard.admin.daftar-admin", [
			"title" => "Daftar Admin SDPPI",
			"users" => $user
		]);
	}

	public function deleteAdmin(User $user)
	{
		$user->delete();
		return redirect()->back();
	}

	public function showAvailableInternship()
	{
		$internship = Internship::where("status", "diterima")->get();
		return view("dashboard.admin.lowongan-magang", [
			"title" => "Lowongan Magang",
			"internships" => $internship
		]);
	}

	public function deleteInternship(Internship $internship)
	{
		$internship->delete();
		return redirect()->back()->with("deleteInternship", "Lowongan magang berhasil dihapus.");
	}

	public function userRegisterInternship()
	{
		$applicants = ApplicantStatus::with("applicantData", "internship")->where("status", "mendaftar")->get();

		return view("dashboard.admin.pendaftar-magang", [
			"applicants" => $applicants,
			"title" => "Pendaftaran Magang"
		]);
	}

	public function acceptedApplicant(ApplicantStatus $applicantStatus)
	{
		$applicantStatus->status = "verifikasi";
		$applicantStatus->save();

		return redirect()->back()->with("success", "Penerimaan pendaftar magang berhasil dilakukan!");
	}

	public function rejectedApplicant(ApplicantStatus $applicantStatus)
	{
		$userEmail = $applicantStatus->user->email;

		$applicantStatus->status = "gagal";
		$applicantStatus->save();

		Mail::send("emails.reject-applicant", ["applicant" => $applicantStatus], function ($message) use ($userEmail) {
			$message->to($userEmail);
			$message->subject("Pengumumam Hasil Seleksi Magang SDPPI");
		});

		try {
			Mail::send("emails.reject-applicant", ["applicant" => $applicantStatus], function ($message) use ($userEmail) {
				$message->to($userEmail);
				$message->subject("Pengumumam Hasil Seleksi Magang SDPPI");
			});

			return redirect()->back()->with("success", "Penolakan pendaftar magang berhasil dilakukan!");
		} catch (\Exception $e) {
			// Hapus token yang baru saja dibuat jika pengiriman email gagal
			return redirect()->back()->with("error", "Gagal mengirim email. Silahkan coba lagi.");
		}
	}

	public function listUserIntern()
	{
		$userIntern = ApplicantStatus::where("status", "lulus")->get();

		return view("dashboard.admin.peserta-magang", [
			"title" => "Peserta Magang",
			"userIntern" => $userIntern
		]);
	}

	public function showProfileAdmin()
	{
		$adminId = auth()->user()->id; // Mengambil ID admin yang sedang login

		// Mengambil data admin berdasarkan ID
		$dataAdmin = User::where("id", $adminId)->first();

		if (!$dataAdmin) {
			abort(404); // Handle jika data admin tidak ditemukan
		}

		return view("dashboard.admin.profile-admin", [
			"title" => "Profil Admin",
			"data" => $dataAdmin
		]);
	}
}
