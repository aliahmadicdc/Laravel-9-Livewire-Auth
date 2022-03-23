<?php

namespace App\Listeners\back;

use App\Models\User;
use App\Notifications\back\LoginNotification;
use Illuminate\Support\Facades\Notification;

class LoginListener
{
    public function __construct()
    {

    }

    public function handle($event): void
    {
        Notification::send($event->user, new LoginNotification($event->user));
    }
}
