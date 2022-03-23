<?php

namespace App\Http\Controllers\Auth;

use App\Actions\auth\VerifyAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();

        if ($user->phone_number_verified_at != null)
            return redirect()->route('panel.dashboard');

        return view('auth.verify', compact('user'));
    }

    public function verifyEmail(VerifyAction $verifyAction, $token): RedirectResponse
    {
        return $verifyAction->verifyEmail($token);
    }
}
