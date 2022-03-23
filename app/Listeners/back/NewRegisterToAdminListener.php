<?php

namespace App\Listeners\back;

use App\Models\User;
use App\Notifications\back\NewRegisteredToAdminNotification;
use Illuminate\Support\Facades\Notification;

class NewRegisterToAdminListener
{
    public function __construct()
    {
        //
    }

    public function handle($event): void
    {
        $admins = getAdminsAndManagers('view_users');

        Notification::send($admins, new NewRegisteredToAdminNotification($event->user));
    }
}
