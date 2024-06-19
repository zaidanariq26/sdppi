<?php

namespace App\Http\Controllers;

use App\Models\ApplicantData;
use Illuminate\Http\Request;
use App\Models\ApplicantStatus;
use App\Models\Internship;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserApplicantController extends Controller
{
	public function index()
	{
		$user = auth()->user();
		$internshipIdsOwnedByUser = $user->applicantStatuses->pluck("internship_id")->toArray();

		$internshipsNotOwnedByUser = Internship::where("status", "diterima")->whereNotIn("id", $internshipIdsOwnedByUser)->get();
		return view("user.lowongan-magang", [
			"title" => "Lowongan Magang",
			"internships" => $internshipsNotOwnedByUser
		]);
	}

	public function showStatusIntern()
	{
		// Mengambil user yang sedang login
		$user = auth()->user();

		// Mengambil informasi lowongan magang berdasarkan id yang sudah diapply
		$applicantStatuses = ApplicantStatus::where("user_id", $user->id)
			->with("internship")
			->get();

		return view("user.kegiatanku", [
			"title" => "Kegiatanku",
			"applicants" => $applicantStatuses
		]);
	}

	public function formApplicant()
	{
		return view("user.form-data-pemagang", [
			"title" => "Form Data Pemagang"
		]);
	}

	public function storeApplicantData(Request $request)
	{
		$validatedData = $request->validate([
			"name" => "required|string|max:255",
			"student_id" => "required|string|max:255|unique:applicant_data",
			"school" => "required|string|max:255",
			"provinsi" => "required|string",
			"distrik" => "required|string",
			"kecamatan" => "required|string",
			"kelurahan" => "required|string",
			"address" => "required|string|max:255",
			"school_mail" => "file|mimes:pdf|max:3000",
			"cv" => "required|file|mimes:pdf|max:3000",
			"image" => "required|file|mimes:jpg,jpeg,png|max:3000"
		]);

		if ($request->file("cv")) {
			$validatedData["cv"] = $request->file("cv")->store("applicant-cv");
		}

		if ($request->file("school_mail")) {
			$validatedData["school_mail"] = $request->file("school_mail")->store("school-mail");
		}

		if ($request->file("image")) {
			$validatedData["image"] = $request->file("image")->store("profile-image");
		}

		$validatedData["user_id"] = auth()->user()->id;

		ApplicantData::create($validatedData);

		return redirect()->to("/beranda")->with("update-data", "Data diri telah berhasil diperbarui.");
	}

	public function showProfil()
	{
		$applicant_data = ApplicantData::where("user_id", auth()->user()->id)->first();

		return view("user.profile", [
			"applicant_data" => $applicant_data,
			"title" => "Profil Saya"
		]);
	}

	public function updateProfilePhoto(Request $request)
	{
		$request->validate([
			"image" => "required|file|mimes:jpg,jpeg,png|max:3000"
		]);

		if (auth()->user()->applicant_data && auth()->user()->applicant_data->image) {
			Storage::delete(auth()->user()->applicant_data->image);
		}

		// // Simpan foto baru di penyimpanan
		$imagePath = $request->file("image")->store("profile-image");

		// // Perbarui URL foto baru di basis data
		auth()
			->user()
			->applicant_data->update(["image" => $imagePath]);

		return redirect()->back()->with("success", "Foto berhasil diperbarui");
	}

	public function registerInternship(Internship $internship)
	{
		$user = auth()->user();

		// Periksa apakah applicant_data dan cv ada
		if (!$user->applicant_data || !$user->applicant_data->cv) {
			return redirect()->route("profil")->with("error", "Lengkapi data diri terlebih dahulu.");
		}

		// Persiapkan data untuk disimpan
		$data = [
			"user_id" => $user->id,
			"internship_id" => $internship->id
		];

		// Buat entri baru di tabel applicant_statuses
		ApplicantStatus::create($data);

		return redirect()->back()->with("register_success", "Pendaftaran berhasil. Silahkan cek akun email Anda untuk pemberitahuan kelulusan.");
	}

	public function showUpdateData()
	{
		$user = auth()->user()->id;
		$data = ApplicantData::where("user_id", $user)->first();
		return view("user.update-data-user", [
			"title" => "Perbarui Data Diri",
			"data" => $data
		]);
	}

	public function updateDataUser(ApplicantData $applicantData, Request $request)
	{
		$validatedData = $request->validate([
			"name" => "required|string|max:255",
			"student_id" => "required|string|max:255|unique:applicant_data,student_id," . $applicantData->id,
			"school" => "required|string|max:255",
			"provinsi" => "required|string",
			"distrik" => "required|string",
			"kecamatan" => "required|string",
			"kelurahan" => "required|string",
			"address" => "required|string|max:255",
			"school_mail" => "file|mimes:pdf|max:3000",
			"cv" => "file|mimes:pdf|max:3000"
		]);

		// Handle CV update
		if ($request->hasFile("cv")) {
			if ($applicantData->cv) {
				Storage::delete($applicantData->cv);
			}

			$validatedData["cv"] = $request->file("cv")->store("applicant-cv");
		}

		// Handle school mail update
		if ($request->hasFile("school_mail")) {
			if ($applicantData->school_mail) {
				Storage::delete($applicantData->school_mail);
			}

			$validatedData["school_mail"] = $request->file("school_mail")->store("school-mail");
		}

		$applicantData->update($validatedData);
		return redirect()->route("profil")->with("success", "Data berhasil diperbarui.");
	}
}
