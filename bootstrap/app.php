<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\BiroKepegawaian;
use App\Http\Middleware\CheckUserData;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SatuanUnit;
use App\Http\Middleware\UserApplicant;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(web: __DIR__ . "/../routes/web.php", commands: __DIR__ . "/../routes/console.php", health: "/up")
	->withMiddleware(function (Middleware $middleware) {
		$middleware->alias([
			"satuan_unit" => SatuanUnit::class,
			"biro_kepegawaian" => BiroKepegawaian::class,
			"admin" => Admin::class,
			"user_applicant" => UserApplicant::class,
			"check.user.data" => CheckUserData::class,
			"redirect.if.auth" => RedirectIfAuthenticated::class
		]);
	})
	->withExceptions(function (Exceptions $exceptions) {
		//
	})
	->create();
