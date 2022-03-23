<?php

namespace App\Notifications\back;

use App\Notifications\BaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use JetBrains\PhpStorm\ArrayShape;

class ProfileUpdateNotification extends BaseNotification implements ShouldQueue
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
        $subject = trans('messages.profileUpdated');
        $title = trans('messages.profileUpdated');
        $mainText = trans('messages.profileUpdatedText') . ' '
            . trans('messages.name') . ' : ' . $this->user->name . ' '
            . trans('messages.phoneNumber') . ' : ' . $this->user->phone_number;
        $buttonText = trans('messages.userArea');
        $footerText = trans('messages.profileUpdatedFooterText');

        return (new MailMessage)
            ->subject($subject)
            ->view('mail.mail_template',
                compact('title', 'mainText', 'url', 'buttonText', 'footerText'));
    }

    #[ArrayShape(['title' => "mixed", 'text' => "string"])]
    public function toArray($notifiable): array
    {
        return [
            'title' => trans('messages.profileUpdated'),
            'text' => trans('messages.profileUpdatedText') . ' '
                . trans('messages.name') . ' : ' . $this->user->name . ' '
                . trans('messages.phoneNumber') . ' : ' . $this->user->phone_number,
        ];
    }
}
