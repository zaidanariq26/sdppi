<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;

class UserApplicantController extends Controller
{
	public function index()
	{
		if (!auth()->check()) {
			return redirect()->route("login")->with("warning", "Login terlebih dahulu.");
		}

		$internship = Internship::where("status", "diterima")->get();
		return view("user.lowongan-magang", [
			"title" => "Lowongan Magang",
			"internships" => $internship
		]);
	}
}
