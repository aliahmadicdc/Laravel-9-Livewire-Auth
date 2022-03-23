<?php

namespace App\Actions\auth;

use App\Actions\BaseAction;
use App\Events\back\Login;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginAction extends BaseAction
{
    public function login($data): bool
    {
        try {
            if (User::where('phone_number', $data['phone_number'])->where('status', 1)->exists())
                if (Auth::attempt($data)) {
                    $user = auth()->user();

                    return $this->successBooleanResponse();
                }
        } catch (\Exception $exception) {
            return $this->errorBooleanResponse();
        }

        return $this->errorBooleanResponse();
    }
}
