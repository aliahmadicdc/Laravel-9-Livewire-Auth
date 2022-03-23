<?php

namespace App\Providers;

use App\Events\back\Login;
use App\Events\back\NewRegistered;
use App\Events\back\ProfileUpdate;
use App\Events\back\RequestResetPassword;
use App\Events\back\ResendEmailVerification;
use App\Events\back\ResendSmsVerification;
use App\Events\back\UserPasswordReset;
use App\Listeners\back\LoginListener;
use App\Listeners\back\NewRegisteredListener;
use App\Listeners\back\NewRegisterToAdminListener;
use App\Listeners\back\ProfileUpdateListener;
use App\Listeners\back\RequestResetPasswordListener;
use App\Listeners\back\ResendEmailVerificationListener;
use App\Listeners\back\UserPasswordResetListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        NewRegistered::class => [
            NewRegisteredListener::class,
            NewRegisterToAdminListener::class
        ],
        Login::class => [
            LoginListener::class
        ],
        ResendSmsVerification::class => [
            NewRegisteredListener::class
        ],
        UserPasswordReset::class => [
            UserPasswordResetListener::class
        ],
        RequestResetPassword::class => [
            RequestResetPasswordListener::class
        ],
        ResendEmailVerification::class => [
            ResendEmailVerificationListener::class
        ],
        ProfileUpdate::class => [
            ProfileUpdateListener::class
        ]
    ];

    public function boot(): void
    {
        //
    }
}
