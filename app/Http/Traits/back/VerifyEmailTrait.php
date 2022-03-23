<?php

namespace App\Http\Traits\back;

use App\Models\back\EmailVerify;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait VerifyEmailTrait
{
    public function createEmailToken($user)
    {
        return $this->saveToken($this->generateEmailVerificationToken(), $user);
    }

    public function checkEmailToken($email_token): bool
    {
        return EmailVerify::where([
                'token' => $email_token,
                'email' => auth()->user()->email,
                ['created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString()]
            ])->exists() && auth()->user()->email_verified_at == null;
    }

    private function generateEmailVerificationToken(): string
    {
        return Str::random(50);
    }

    private function saveToken($email_token, $user)
    {
        return EmailVerify::create([
            'email' => $user->email,
            'token' => $email_token
        ]);
    }
}
