<?php

namespace App\Actions;

use Illuminate\Http\RedirectResponse;

class BaseAction
{
    public function successResponse($route = 'panel.dashboard', $message = null): RedirectResponse
    {
        return redirect()->route($route)->with('success', $message ?? trans('messages.success'));
    }

    public function errorResponse($message = null): RedirectResponse
    {
        return redirect()->back()->with('warning', $message ?? trans('messages.errorConnection'));
    }

    public function backResponse($message = null): RedirectResponse
    {
        return redirect()->back()->with('success', $message ?? trans('messages.success'));
    }

    public function successBooleanResponse($message = null): bool
    {
        if ($message) session()->flash('success', $message);

        return true;
    }

    public function errorBooleanResponse($message = null): bool
    {
        if ($message) session()->flash('warning', $message);

        return false;
    }
}
