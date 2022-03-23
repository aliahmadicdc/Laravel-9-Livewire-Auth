<?php

namespace App\Listeners\back;

use App\Notifications\back\ProfileUpdateNotification;
use Illuminate\Support\Facades\Notification;

class ProfileUpdateListener
{

    public function __construct()
    {
        //
    }

    public function handle($event):void
    {
        Notification::send($event->user, new ProfileUpdateNotification($event->user));
    }
}
