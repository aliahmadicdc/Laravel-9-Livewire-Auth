<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;

class RegisterController extends BaseController
{
    public function index()
    {
        if (auth()->check()) return redirect()->route('front.home');

        return view('auth.register');
    }
}
