<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function auth(Request $r)
    {
        $data = $r->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['name' => $data['name'], 'password' => $data['password']])) {
            $r->session()->regenerate();
            return redirect('/tickets');
        }

        return back()->withErrors([
            'name' => 'Invalid username or password'
        ])->onlyInput('name');
    }

    public function logout(Request $r){
        Auth::logout();

        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect('/login');
    }
}
