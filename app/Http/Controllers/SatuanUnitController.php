<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;
use Carbon\Carbon;

class SatuanUnitController extends Controller
{
	public function index()
	{
		return view("dashboard.satuan-unit.index", [
			"internships" => Internship::where("user_id", auth()->id())->orderBy("created_at", "desc")->get(),
			"title" => "Dashboard"
		]);
	}

	public function showForm()
	{
		return view("dashboard.satuan-unit.form-pengajuan", [
			"title" => "Form Pengajuan"
		]);
	}

	public function store(Request $request)
	{
		$validatedData = $request->validate([
			"title" => "required|max:255",
			"slug" => "required|max:255",
			"division" => "required",
			"duration_in_months" => "required",
			"vacancy_slots" => "required",
			"description" => "required"
		]);

		// Tanggal posting saat ini
		$currentDate = Carbon::now();

		// Tambahkan 30 hari untuk mendapatkan tanggal pemberitahuan
		$notificationDate = $currentDate->copy()->addDays(30);

		// Durasi magang dalam bulan
		$internshipDurationInMonths = (int) $request->duration_in_months;

		// Tambahkan satu bulan ke tanggal pemberitahuan untuk mendapatkan tanggal mulai magang
		$internshipStartDate = $notificationDate;

		// Tambahkan durasi magang dalam bulan untuk mendapatkan tanggal akhir magang
		$internshipEndDate = $internshipStartDate->copy()->addMonths($internshipDurationInMonths);

		// Format tanggal
		$formattedStartDate = $internshipStartDate->format("j M Y");
		$formattedEndDate = $internshipEndDate->format("j M Y");

		$validatedData["intern_start"] = $formattedStartDate;
		$validatedData["intern_end"] = $formattedEndDate;
		$validatedData["user_id"] = auth()->user()->id;

		Internship::create($validatedData);

		return redirect()->back()->with("success", "Formulir pengajuan lowongan berhasil dikirim");
	}

	public function showHistory()
	{
		// Dapatkan semua data magang
		$internships = Internship::where("user_id", auth()->id())->get();

		return view("dashboard.satuan-unit.riwayat", [
			"internships" => $internships,
			"title" => "Riwayat Pengajuan"
		]);
	}
	public function accepted()
	{
		$internships = Internship::where("user_id", auth()->id())->where("status", "diterima")->get();
		return view("dashboard.satuan-unit.riwayat", [
			"internships" => $internships,
			"title" => "Riwayat Pengajuan"
		]);
	}

	public function rejected()
	{
		$internships = Internship::where("user_id", auth()->id())->where("status", "ditolak")->get();
		return view("dashboard.satuan-unit.riwayat", [
			"internships" => $internships,
			"title" => "Riwayat Pengajuan"
		]);
	}
}
