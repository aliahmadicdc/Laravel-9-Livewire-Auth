<?php

namespace App\Http\Livewire\Auth;

use App\Actions\auth\LogoutAction;
use App\Http\Livewire\BaseComponent;
use Illuminate\View\View;

class Logout extends BaseComponent
{
    public function render():View
    {
        return view('livewire.auth.logout');
    }

    public function logout(LogoutAction $logoutAction)
    {
        $this->resetParams();

        if ($logoutAction->logout()) {
            session()->forget('ad');
            session()->forget('ad-mode');

            $this->successResponse('front.home');
        } else {
            $this->livewire_error = trans('messages.errorConnection');
        }
    }

    public function rules(): array
    {
        return [

        ];
    }
}
