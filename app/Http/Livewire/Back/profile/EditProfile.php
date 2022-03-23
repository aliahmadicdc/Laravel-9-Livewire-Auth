<?php

namespace App\Http\Livewire\Back\profile;

use App\Actions\back\ProfileAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\WithFileUploads;

class EditProfile extends BaseComponent
{
    use WithFileUploads;

    public $user;

    public function mount()
    {
        $this->data['name'] = $this->user->name;
        $this->data['email'] = $this->user->email;
    }

    public function render():View
    {
        return view('livewire.back.profile.edit-profile');
    }

    public function update(ProfileAction $profileAction)
    {
        $this->resetParams();

        $this->validate($this->rules());

        if ($profileAction->update($this->data, $this->user))
            $this->livewire_success = trans('messages.successUpdate');
        else
            $this->livewire_error = trans('messages.errorConnection');
    }

    public function verifyEmail(ProfileAction $profileAction)
    {
        $this->resetParams();

        if ($profileAction->verifyEmail($this->user))
            $this->livewire_success = trans('messages.emailVerifySend');
        else
            $this->livewire_error = trans('messages.errorConnection');
    }

    #[ArrayShape(['data.name' => "string[]", 'data.email' => "string[]", 'data.image' => "string[]"])]
    public function rules(): array
    {
        return [
            'data.name' => ['required', 'string'],
            'data.email' => ['nullable', 'email'],
            'data.image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:1024'],
        ];
    }
}
