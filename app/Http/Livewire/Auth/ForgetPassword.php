<?php

namespace App\Http\Livewire\Auth;

use App\Actions\auth\ForgetPasswordAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;

class ForgetPassword extends BaseComponent
{
    public function render():View
    {
        return view('livewire.auth.forget-password');
    }

    public function submit(ForgetPasswordAction $forgetPasswordAction)
    {
        $this->resetParams();

        $this->validate($this->rules());

        if ($forgetPasswordAction->sendResetPasswordLink($this->data))
            $this->livewire_success = trans('messages.successSendSmsPasswordReset');
        else {
            $this->livewire_error = trans('messages.errorSendSmsPasswordReset');
        }
    }

    #[ArrayShape(['data.phone_number' => "array"])]
    public function rules(): array
    {
        return [
            'data.phone_number' => ['required', 'string', 'regex:/(09)[0-9]{9}/', 'size:11', Rule::exists('users', 'phone_number')],
        ];
    }
}
