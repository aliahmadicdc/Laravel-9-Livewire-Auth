<?php

namespace App\Listeners\back;

use App\Http\Traits\back\GenerateVerifyCodeTrait;
use App\Http\Traits\back\SmsHandlerTrait;

class NewRegisteredListener
{
    use GenerateVerifyCodeTrait, SmsHandlerTrait;

    public function __construct()
    {
        //
    }

    public function handle($event): void
    {
        $this->sendText($event->user->phone_number, $this->generateCode($event->user));
    }
}
