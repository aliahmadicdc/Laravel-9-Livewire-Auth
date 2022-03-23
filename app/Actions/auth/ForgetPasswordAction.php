<?php

namespace App\Actions\auth;

use App\Actions\BaseAction;
use App\Events\back\RequestResetPassword;
use App\Models\User;

class ForgetPasswordAction extends BaseAction
{
    public function sendResetPasswordLink($data): bool
    {
        try {
            $user = User::where('phone_number', $data['phone_number'])->first();

            if (!$user)
                return $this->errorBooleanResponse();

            event(new RequestResetPassword($user));
        } catch (\Exception $exception) {
            return $this->errorBooleanResponse();
        }

        return $this->successBooleanResponse();
    }
}
