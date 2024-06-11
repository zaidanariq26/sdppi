<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordManager extends Controller
{
	function forgetPassword()
	{
		return view("forget-password.index", [
			"title" => "Forget Password"
		]);
	}

	function forgetPasswordPost(Request $request)
	{
		$request->validate([
			"email" => "required|email|exists:users"
		]);

		$token = Str::random(64);

		DB::table("password_reset_tokens")->insert([
			"email" => $request->email,
			"token" => $token,
			"created_at" => Carbon::now()
		]);

		Mail::send("emails.forget-password", ["token" => $token], function ($message) use ($request) {
			$message->to($request->email);
			$message->subject("Reset Password");
		});

		try {
			Mail::send("emails.forget-password", ["token" => $token], function ($message) use ($request) {
				$message->to($request->email);
				$message->subject("Reset Password");
			});

			return redirect()->back()->with("success", "Link verifikasi telah dikirim. Silahkan cek akun email Anda.");
		} catch (\Exception $e) {
			// Hapus token yang baru saja dibuat jika pengiriman email gagal
			DB::table("password_reset_tokens")
				->where("email", $request->email)
				->delete();

			return redirect()->back()->with("error", "Gagal mengirim link verifikasi. Silahkan coba lagi nanti.");
		}
	}

	function resetPassword($token)
	{
		return view("forget-password.reset", compact("token"), [
			"title" => "Forget Password"
		]);
	}
	function resetPasswordPost(Request $request)
	{
		$request->validate([
			"email" => "required|email:dns|exists:users",
			"password" => "required|string|min:6|confirmed",
			"password_confirmation" => "required"
		]);

		try {
			$updatePassword = DB::table("password_reset_tokens")
				->where([
					"email" => $request->email,
					"token" => $request->token
				])
				->first();

			if (!$updatePassword) {
				return back()->with("error", "Data tidak valid");
			}

			User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);
			DB::table("password_reset_tokens")
				->where(["email" => $request->email])
				->delete();

			return redirect()->to(route("login"))->with("success", "Password berhasil diganti");
		} catch (\Exception $e) {
			return back()->with("error", "Terjadi kesalahan saat mengubah password. Silahkan coba lagi nanti.");
		}
	}
}
