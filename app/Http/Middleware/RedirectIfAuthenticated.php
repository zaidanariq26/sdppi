<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next, $guard = null): Response
	{
		if (Auth::guard($guard)->check()) {
			$user = Auth::user();

			if ($user->role === "satuan-unit") {
				return redirect("/dashboard");
			} elseif ($user->role === "biro-kepegawaian") {
				return redirect("/dashboard-biro");
			} elseif ($user->role === "admin") {
				return redirect("/dashboard-admin");
			} elseif ($user->role === "user") {
				return redirect("/beranda");
			}
		}

		return $next($request);
	}
}
