<?php

namespace App\Listeners\back;

use App\Http\Traits\back\VerifyEmailTrait;
use App\Notifications\back\ResendEmailVerificationNotification;
use Illuminate\Support\Facades\Notification;

class ResendEmailVerificationListener
{
    use VerifyEmailTrait;

    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $email_verify = $this->createEmailToken($event->user);

        Notification::send($event->user, new ResendEmailVerificationNotification($event->user, $email_verify->token));
    }
}
