<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class BaseNotification extends Notification
{
    public function via($notifiable): array
    {
        return ['email','database'];
    }
}
