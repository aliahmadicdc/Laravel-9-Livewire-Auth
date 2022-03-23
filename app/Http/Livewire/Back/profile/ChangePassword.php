<?php

namespace App\Http\Livewire\Back\profile;

use App\Actions\back\ProfileAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;

class ChangePassword extends BaseComponent
{
    public $user;

    public function render():View
    {
        return view('livewire.back.profile.change-password');
    }

    public function update(ProfileAction $profileAction)
    {
        $this->resetParams();

        $this->validate($this->rules());

        if ($profileAction->changePassword($this->data, $this->user))
            $this->livewire_success = trans('messages.successUpdate');
        else
            $this->livewire_error = trans('messages.errorConnection');
    }

    #[ArrayShape(['data.old_password' => "string[]", 'data.password' => "array"])]
    public function rules(): array
    {
        return [
            'data.old_password' => ['required', 'string'],
            'data.password' => ['required', 'string', 'confirmed', Password::min(8)->numbers()->letters()],
        ];
    }
}
