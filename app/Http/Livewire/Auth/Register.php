<?php

namespace App\Http\Livewire\Auth;

use App\Actions\auth\RegisterAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;

class Register extends BaseComponent
{
    public function render(): View
    {
        return view('livewire.auth.register');
    }

    public function submit(RegisterAction $registerAction)
    {
        $this->resetParams();

        $this->validate($this->rules());

        if ($registerAction->create($this->data))
            $this->successResponse('panel.verify', trans('messages.successRegister'));
        else
            $this->livewire_error = trans('messages.errorConnection');
    }

    #[ArrayShape(['data.phone_number' => "string[]", 'data.password' => "array"])]
    public function rules(): array
    {
        return [
            'data.phone_number' => ['required', 'string', 'regex:/(09)[0-9]{9}/', 'size:11', 'unique:users,phone_number'],
            'data.password' => ['required', 'string', 'confirmed', Password::min(8)->numbers()->letters()]
        ];
    }
}
