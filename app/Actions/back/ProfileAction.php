<?php

namespace App\Actions\back;

use App\Actions\BaseAction;
use App\Events\back\ResendEmailVerification;
use App\Http\Traits\back\UploadTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileAction extends BaseAction
{
    use UploadTrait;

    public function update($data, $user): bool
    {
        try {
            if (isset($data['image']) && $data['image'] != '') {

                $data['upload_type'] = 'profile';
                $imageName = $this->uploadImage($data);

                if ($imageName == false)
                    return $this->errorBooleanResponse();
                else {
                    $user->image()->delete();
                    $user->image()->create([
                        'name' => $imageName,
                        'alt' => trans('messages.profile'),
                    ]);

                    unset($data['image']);
                }
            }

            if ($data['email'] != null && $data['email'] != $user->email) {
                if (User::where('email', $data['email'])->exists())
                    return $this->errorBooleanResponse(trans('messages.emailAlreadyExist'));
                else
                    $data['email_verified_at'] = null;
            } else unset($data['email']);

            $user->update($data);
        } catch (\Exception $exception) {
            return $this->errorBooleanResponse();
        }

        return $this->successBooleanResponse();
    }

    public function changePassword($data, $user): bool
    {
        try {
            if (isset($data['old_password'])) {
                if (Hash::check($data['old_password'], $user->password)) {
                    unset($data['password_confirmation']);
                    $data['password'] = Hash::make($data['password']);
                } else return $this->errorBooleanResponse(trans('messages.invalidPassword'));
            }

            $user->update($data);
        } catch (\Exception $exception) {
            return $this->errorBooleanResponse();
        }

        return $this->successBooleanResponse();
    }

    public function verifyEmail($user): bool
    {
        if ($user->email && !$user->email_verified_at)
            event(new ResendEmailVerification($user));
        else return $this->errorBooleanResponse();

        return $this->successBooleanResponse();
    }
}
