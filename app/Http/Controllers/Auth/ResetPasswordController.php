<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\back\ResetPasswordTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    use ResetPasswordTrait;

    public function index(Request $request): View|RedirectResponse
    {
        $token = $request->token;
        $phone_number = str_replace('/', "", $request->phone_number);

        if (auth()->check() || !$this->validateToken($token, $phone_number))
            return redirect()->route('login')->with('warning', trans('messages.notValidInformation'));

        return view('auth.password_reset', compact('token', 'phone_number'));
    }
}
