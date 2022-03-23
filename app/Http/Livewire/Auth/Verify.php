<?php

namespace App\Http\Livewire\Auth;

use App\Actions\auth\VerifyAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;

class Verify extends BaseComponent
{
    public $phone_number;

    public function render(): View
    {
        $user = auth()->user();

        if ($user->phone_number_verified_at != null)
            $this->successResponse();

        return view('livewire.auth.verify');
    }

    public function submit(VerifyAction $verifyAction)
    {
        $this->resetParams();

        $this->validate($this->rules());

        if ($verifyAction->checkCode($this->data)) {
            if (session('ad'))
                $this->successResponse('front.ad.create');
            else
                $this->successResponse('front.home');
        } else {
            $this->livewire_error = trans('messages.invalidCode');
        }
    }

    public function resendCode(VerifyAction $verifyAction): void
    {
        if ($verifyAction->resendCode())
            $this->livewire_success = trans('messages.successSendSms');
        else
            $this->livewire_error = trans('messages.errorConnection');
    }

    #[ArrayShape(['phone_number' => "string[]", 'data.verify_code' => "string[]"])]
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'string', 'regex:/(09)[0-9]{9}/', 'size:11'],
            'data.verify_code' => ['required', 'Numeric']
        ];
    }
}
