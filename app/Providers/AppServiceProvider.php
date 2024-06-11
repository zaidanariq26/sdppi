<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Gate::define("satuan_unit", function (User $user) {
			return $user->role === "satuan-unit";
		});

		Gate::define("biro_kepegawaian", function (User $user) {
			return $user->role === "biro-kepegawaian";
		});

		Gate::define("admin", function (User $user) {
			return $user->role === "admin";
		});
	}
}
