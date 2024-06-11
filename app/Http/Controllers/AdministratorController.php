<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Internship;

class AdministratorController extends Controller
{
	public function index()
	{
		$user = User::all();
		return view("dashboard.admin.index", [
			"title" => "Dashboard",
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
}
