<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('/auth/login');
    }

    public function authenticate(LoginRequest $request)
    {

        $data = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($data) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->with('error', 'Your password is invalid');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
