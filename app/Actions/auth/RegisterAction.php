<?php

namespace App\Actions\auth;

use App\Actions\BaseAction;
use App\Events\back\NewRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterAction extends BaseAction
{
    public function create($data): bool
    {
        try {
            $password = Hash::make($data['password']);

            $user = User::create([
                'name' => trans('messages.userNameSample'),
                'phone_number' => $data['phone_number'],
                'password' => $password,
                'api_token' => Str::random(50),
                'user_code' => 'SHD_' . time() . mt_rand(11111, 99999)
            ]);

            $user->roles()->sync([2]);

            unset($data['role']);
            unset($data['agree']);

            if (Auth::attempt($data)) {
                event(new NewRegistered($user));

                return $this->successBooleanResponse();
            }
        } catch (\Exception $exception) {
            return $this->errorBooleanResponse();
        }

        return $this->errorBooleanResponse();
    }
}
