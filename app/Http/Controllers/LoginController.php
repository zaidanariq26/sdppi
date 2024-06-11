<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
	public function index()
	{
		return view("login.index", [
			"title" => "Log in"
		]);
	}

	public function authenticate(Request $request)
	{
		$credentials = $request->validate([
			"email" => ["required", "email:dns"],
			"password" => ["required"]
		]);

		$remember = $request->has("remember");

		if (Auth::attempt($credentials, $remember)) {
			$request->session()->regenerate();

			$user = Auth::user();
			if ($user->role === "biro-kepegawaian") {
				return redirect()
					->intended("dashboard-biro")
					->with("success", "Selamat datang, " . auth()->user()->name);
			} elseif ($user->role === "satuan-unit") {
				return redirect()
					->intended("dashboard")
					->with("success", "Selamat datang, " . auth()->user()->name);
			} elseif ($user->role === "admin") {
				return redirect()
					->intended("dashboard-admin")
					->with("success", "Selamat datang, " . auth()->user()->name);
			} elseif ($user->role === "user") {
				return redirect()
					->intended("/")
					->with("success", "Selamat datang, " . auth()->user()->name);
			}
		}

		return back()->with("loginError", "Login gagal!");
	}

	public function logout(Request $request)
	{
		$user = $request->user();
		$user->update(["remember_token" => null]);

		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect(route("login"));
	}
}
