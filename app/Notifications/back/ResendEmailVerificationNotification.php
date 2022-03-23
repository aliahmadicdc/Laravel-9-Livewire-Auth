<?php

namespace App\Notifications\back;

use App\Http\Traits\back\VerifyEmailTrait;
use App\Notifications\BaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResendEmailVerificationNotification extends BaseNotification implements ShouldQueue
{
    use Queueable,VerifyEmailTrait;

    private $user,$token;

    public function __construct($user,$token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function toMail($notifiable): MailMessage
    {
        $url = route('panel.profile.email.verify',$this->token);
        $subject = trans('messages.verificationAccount');
        $title = trans('messages.verificationAccount');
        $mainText = trans('messages.verificationAccountText2');
        $buttonText = trans('messages.activeAccount');
        $footerText = trans('messages.verificationAccountFooterText');

        return (new MailMessage)
            ->subject($subject)
            ->view('mail.mail_template',
                compact('title', 'mainText', 'url', 'buttonText', 'footerText'));
    }
}
