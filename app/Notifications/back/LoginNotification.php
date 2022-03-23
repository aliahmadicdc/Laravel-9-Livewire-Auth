<?php

namespace App\Notifications\back;

use App\Notifications\BaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use JetBrains\PhpStorm\ArrayShape;

class LoginNotification extends BaseNotification implements ShouldQueue
{
    use Queueable;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function toMail($notifiable): MailMessage
    {
        $url = route('panel.dashboard');
        $subject = trans('messages.newAdminLogin');
        $title = trans('messages.newAdminLogin');
        $mainText = trans('messages.newAdminLoginText') . ' '
            . trans('messages.name') . ' : ' . $this->user->name . ' '
            . trans('messages.phoneNumber') . ' : ' . $this->user->phone_number;
        $buttonText = trans('messages.panel');
        $footerText = trans('messages.newAdminLoginFooterText');

        return (new MailMessage)
            ->subject($subject)
            ->view('mail.mail_template',
                compact('title', 'mainText', 'url', 'buttonText', 'footerText'));
    }

    #[ArrayShape(['title' => "mixed", 'text' => "string"])]
    public function toArray($notifiable): array
    {
        return [
            'title' => trans('messages.newAdminLogin'),
            'text' => trans('messages.newAdminLoginText') . ' '
                . trans('messages.name') . ' : ' . $this->user->name . ' '
                . trans('messages.phoneNumber') . ' : ' . $this->user->phone_number,
        ];
    }
}
