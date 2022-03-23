<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        if (auth()->check()) return redirect()->route('front.home');

        return view('auth.forget_password');
    }
}
