<?php

namespace App\Providers;

use App\Mail\ResetPasswordMail;
use App\Models\MessageThread;
use App\Policies\MessageThreadPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use function Symfony\Component\String\u;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		MessageThread::class => MessageThreadPolicy::class
	];

	/**
	 * Register any authentication / authorization services.
	 */


	public function boot(): void
	{
		$this->registerPolicies();



		ResetPassword::createUrlUsing(function ($user, string $token) {
			return  config('auth.frontend_url').'/reset-password?token=' . $token.'&email='.$user->email;
		});

	}
}
