<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;

class InternshipAdministratorController extends Controller
{
	public function index()
	{
		$internship = Internship::where("status", "diterima")->get();
		return view("dashboard.admin.lowongan-magang", [
			"title" => "Lowongan Magang",
			"internships" => $internship
		]);
	}
}
