<?php

namespace App\Http\Traits\back;

use App\Models\back\PasswordReset as PasswordResetModel;
use Carbon\Carbon;

trait ResetPasswordTrait
{
    protected function validateToken($token, $phone_number): bool
    {
        return PasswordResetModel::where([
            'phone_number' => $phone_number,
            'token' => $token,
            ['created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString()]
        ])->exists();
    }
}
