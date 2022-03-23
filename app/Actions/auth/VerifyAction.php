<?php

namespace App\Actions\auth;

use App\Actions\BaseAction;
use App\Events\back\ResendSmsVerification;
use App\Http\Traits\back\VerifyEmailTrait;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class VerifyAction extends BaseAction
{
    use VerifyEmailTrait;

    public function checkCode($data): bool
    {
        $user = auth()->user();

        if ($user->phone_number_verified_at != null) return $this->successBooleanResponse();

        if ($user->verifyCodes->last()->code == $data['verify_code']) {
            $user->update([
                'phone_number_verified_at' => Carbon::parse(time())->format('Y-m-d H:i:s'),
            ]);

            return $this->successBooleanResponse();
        }

        return $this->errorBooleanResponse();
    }

    public function resendCode(): bool
    {
        event(new ResendSmsVerification(auth()->user()));

        return $this->successBooleanResponse();
    }

    public function verifyEmail($token): RedirectResponse
    {
        if ($this->checkEmailToken($token)) {
            auth()->user()->update([
                'email_verified_at' => Carbon::parse(time())->format('Y-m-d H:i:s'),
            ]);

            return $this->successResponse('panel.dashboard', trans('messages.emailSuccessVerify'));
        }

        return $this->errorResponse(trans('messages.emailTokenNotValid'));
    }
}
