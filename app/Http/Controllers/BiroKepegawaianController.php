<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;

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

		return redirect()->route("verification.index")->with("success", "Pengajuan magang diterima.");
	}

	public function rejected(Internship $internship)
	{
		$internship->status = "ditolak";
		$internship->save();

		return redirect()->route("verification.index")->with("warning", "Pengajuan magang telah ditolak.");
	}

	public function verificationHistory()
	{
		$internships = Internship::whereIn("status", ["diterima", "ditolak"])->get();

		return view("dashboard.biro_kepegawaian.riwayat-verifikasi", [
			"title" => "Riwayat Pengajuan",
			"internships" => $internships
		]);
	}
}
