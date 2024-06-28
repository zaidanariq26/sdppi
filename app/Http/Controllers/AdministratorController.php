<?php

namespace App\Http\Controllers;

use App\Mail\RejectedMail;
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

		try {
			Mail::to($userEmail)->send(new RejectedMail($applicantStatus));

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

	public function uploadCertificate(ApplicantStatus $applicantStatus, Request $request)
	{
		// Validasi file upload
		$request->validate([
			"file" => "required|mimes:pdf|max:3000"
		]);

		// Cek apakah file ada dalam request
		if ($request->hasFile("file")) {
			$file = $request->file("file");

			try {
				// Simpan file ke dalam storage atau folder yang diinginkan
				$path = $file->store("certificate");

				// Update kolom certificate pada tabel applicant_status
				$applicantStatus->update([
					"certificate" => $path
				]);

				// Redirect kembali dengan pesan sukses
				return redirect()->back()->with("success", "Pengunggahan sertifikat kelulusan berhasil dilakukan");
			} catch (\Exception $e) {
				// Jika terjadi error saat penyimpanan atau update database, tangani error
				return redirect()
					->back()
					->withErrors(["error" => "Terjadi kesalahan saat mengunggah sertifikat: " . $e->getMessage()]);
			}
		} else {
			// Jika file tidak ditemukan dalam request, kembalikan dengan pesan error
			return redirect()
				->back()
				->withErrors(["error" => "File sertifikat tidak ditemukan dalam request."]);
		}
	}
}
