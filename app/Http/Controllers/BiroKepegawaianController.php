<?php

namespace App\Http\Controllers;

use App\Mail\AcceptedMail;
use Illuminate\Http\Request;
use App\Models\ApplicantStatus;
use App\Mail\RejectedMail;
use App\Models\Internship;
use Illuminate\Support\Facades\Mail;

class BiroKepegawaianController extends Controller
{
	public function index()
	{
		$internship = Internship::where("status", "diterima")->get();
		return view("dashboard.biro_kepegawaian.index", [
			"title" => "Dashboard",
			"internships" => $internship
		]);
	}

	public function verify()
	{
		$internship = Internship::where("status", "menunggu")->get();

		return view("dashboard.biro_kepegawaian.verifikasi-magang", [
			"title" => "Verifikasi Magang",
			"internships" => $internship
		]);
	}

	public function accepted(Internship $internship)
	{
		$internship->status = "diterima";
		$internship->save();

		return redirect()->back();
	}

	public function rejected(Internship $internship)
	{
		$internship->status = "ditolak";
		$internship->save();

		return redirect()->back();
	}

	public function verificationHistory()
	{
		$internships = Internship::whereIn("status", ["diterima", "ditolak"])->get();

		return view("dashboard.biro_kepegawaian.riwayat-verifikasi", [
			"title" => "Riwayat Pengajuan",
			"internships" => $internships
		]);
	}

	public function verifyApplicantPage()
	{
		$applicants = ApplicantStatus::with("applicantData", "internship")->where("status", "verifikasi")->get();

		return view("dashboard.biro_kepegawaian.verifikasi-pendaftar", [
			"applicants" => $applicants,
			"title" => "Verifikasi Pendaftaran Magang"
		]);
	}

	public function verifyApplicant(ApplicantStatus $applicantStatus, Request $request)
	{
		$request->validate([
			"file" => "required|mimes:pdf|max:3000"
		]);

		if ($request->hasFile("file")) {
			$file = $request->file("file");

			// Simpan file ke dalam storage atau folder yang diinginkan
			$path = $file->store("surat-keterangan");

			// Update kolom surat_keterangan pada tabel applicant_status
			$applicantStatus->update([
				"surat_keterangan" => $path,
				"status" => "lulus"
				// Tambahkan kolom lain yang perlu diupdate
			]);

			// Ambil user_id dari aplikasi yang baru saja diterima
			$user_id = $applicantStatus->user_id;

			// Update status aplikasi lain yang memiliki user_id yang sama menjadi "gagal"
			ApplicantStatus::where("user_id", $user_id)
				->where("id", "<>", $applicantStatus->id)
				->update([
					"status" => "gagal"
				]);

			$userEmail = $applicantStatus->user->email;

			try {
				Mail::to($userEmail)->send(new AcceptedMail($applicantStatus));
				return redirect()->back()->with("success", "Penerimaan pendaftar magang berhasil dilakukan!");
			} catch (\Throwable $th) {
				return redirect()->back()->with("error", "Gagal mengirim email. Silahkan coba lagi.");
			}
		}
	}

	public function rejectVerifyApplicant(ApplicantStatus $applicantStatus)
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
}
