<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'These credentials do not match our records.',
            ], 422); // 422 Unprocessable Entity
        }
    
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    

}
