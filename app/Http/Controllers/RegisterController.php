<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class RegisterController extends Controller
{
	public function index()
	{
		return view("register.index", [
			"title" => "Register",
			"active" => "register"
		]);
	}

	public function store(Request $request)
	{
		$validatedData = $request->validate(
			[
				"name" => "required|max:255",
				"username" => "required|min:6| max:255|unique:users",
				"email" => "required|email:dns|unique:users",
				"password" => "required|min:8|max:255|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/"
			],
			[
				"password.regex" => "Passwords must contain at least one uppercase letter, one lowercase letter, and one number."
			]
		);

		User::create($validatedData);
		return redirect()->to(route("login"))->with("success", "Akun berhasil dibuat");
	}
}
