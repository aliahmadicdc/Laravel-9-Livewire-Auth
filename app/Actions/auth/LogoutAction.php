<?php

namespace App\Actions\auth;

use App\Actions\BaseAction;
use Illuminate\Support\Facades\Auth;

class LogoutAction extends BaseAction
{
    public function logout(): bool
    {
        try {
            Auth::logout();
        } catch (\Exception $exception) {
            return $this->errorBooleanResponse();
        }

        return $this->successBooleanResponse();
    }
}
