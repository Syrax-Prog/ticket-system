<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $r)
    {
        $data = $r->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['name' => $data['name'], 'password' => $data['password']])) {
            $r->session()->regenerate();

            return response()->json([
                'message' => 'Login successful'
            ]);
        }

        return response()->json([
            'message' => 'Invalid username or password'
        ], 422);
    }

    public function logout(Request $r)
    {
        Auth::guard('web')->logout();

        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}
