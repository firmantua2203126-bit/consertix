<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Determine role safely and choose destination:
        $role = Auth::user()?->role ?? null;

        $destination = match ($role) {
            'admin' => route('admin.dashboard'),
            'eo'    => route('eo.dashboard'),
            default => url('/'),
        };

        // Support AJAX clients that expect JSON
        if ($request->wantsJson()) {
            return response()->json(['redirect' => $destination]);
        }

        return redirect($destination);
    }
}
