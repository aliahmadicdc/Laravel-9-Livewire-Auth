<?php

namespace App\Http\Livewire\Auth;

use App\Actions\auth\ResetPasswordAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;

class PasswordReset extends BaseComponent
{
    public $token, $phone_number;

    public function render():View
    {
        return view('livewire.auth.password-reset', [
            'token' => $this->token,
            'phone_number' => $this->phone_number,
        ]);
    }

    public function submit(ResetPasswordAction $resetPasswordAction)
    {
        $this->resetParams();

        $this->validate($this->rules());

        $this->data['token'] = $this->token;
        $this->data['phone_number'] = $this->phone_number;

        if ($resetPasswordAction->reset($this->data))
            $this->successResponse('login', trans('messages.passwordUpdateSuccess'));
        else {
            $this->livewire_error = trans('messages.errorConnection');
        }
    }

    #[ArrayShape(['token' => "array", 'phone_number' => "array", 'data.password' => "array"])]
    public function rules(): array
    {
        return [
            'token' => ['required', Rule::exists('password_resets', 'token')],
            'phone_number' => ['required', 'string', 'regex:/(09)[0-9]{9}/', 'size:11', Rule::exists('password_resets', 'phone_number')],
            'data.password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ];
    }
}
