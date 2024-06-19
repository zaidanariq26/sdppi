<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApplicantData;

class CheckUserData
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		if (Auth::check()) {
			$userId = Auth::id();

			// Cek apakah data pengguna ada di tabel applicant_data
			$applicantData = ApplicantData::where("user_id", $userId)->first();

			// Jika tidak ada, arahkan ke halaman pengisian data
			if (!$applicantData) {
				// Simpan pesan di session tanpa melakukan redirect
				session()->flash("fill_data", "Silahkan lengkapi data diri terlebih dahulu.");
			}
		}
		return $next($request);
	}
}
