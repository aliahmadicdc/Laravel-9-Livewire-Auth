<?php

namespace App\Actions\auth;

use App\Actions\BaseAction;
use App\Events\back\UserPasswordReset;
use App\Http\Traits\back\ResetPasswordTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordAction extends BaseAction
{
    use ResetPasswordTrait;

    public function reset($data): bool
    {
        if (!$this->validateToken($data['token'], $data['phone_number']))
            return $this->errorBooleanResponse();

        $this->updatePassword($data);

        return $this->successBooleanResponse();
    }

    protected function updatePassword($data): void
    {
        $user = User::where('phone_number', $data['phone_number'])->first()->update([
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(60)
        ]);

        event(new UserPasswordReset($user));
    }
}
