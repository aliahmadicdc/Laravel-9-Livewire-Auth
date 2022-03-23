<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) return redirect()->route('panel.dashboard');

        return view('auth.login');
    }
}
