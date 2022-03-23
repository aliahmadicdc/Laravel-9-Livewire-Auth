<?php

namespace App\Http\Livewire\Auth;

use App\Actions\auth\LoginAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;

class Login extends BaseComponent
{
    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function submit(LoginAction $loginAction)
    {
        $this->resetParams();

        $this->validate($this->rules());

        if ($loginAction->login($this->data))
            if (session('ad'))
                $this->successResponse('front.ad.create');
            else
                $this->successResponse();
        else
            $this->livewire_error = trans('messages.usernameAndPasswordNotCorrect');
    }

    #[ArrayShape(['data.phone_number' => "string[]", 'data.password' => "string"])]
    public function rules(): array
    {
        return [
            'data.phone_number' => ['required', 'string', 'regex:/(09)[0-9]{9}/', 'size:11'],
            'data.password' => 'required|string',
        ];
    }
}
