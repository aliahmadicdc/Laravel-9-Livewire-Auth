<?php

namespace App\Listeners\back;

use App\Http\Traits\back\GeneratePasswordResetLinkTrait;
use App\Http\Traits\back\SmsHandlerTrait;

class RequestResetPasswordListener
{
    use GeneratePasswordResetLinkTrait, SmsHandlerTrait;

    public function __construct()
    {
        //
    }

    public function handle($event): void
    {
        $this->sendText($event->user->phone_number, $this->generateLink($event->user->phone_number), 'reset');
    }
}
