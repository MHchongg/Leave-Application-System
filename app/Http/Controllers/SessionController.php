<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index() {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request) {
        $validatedAttr = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($validatedAttr)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return Inertia::location(route('admin.home'));
        }
        else {
            return Inertia::location(route('user.home'));
        }
    }

    public function destroy() {
        Auth::logout();

        return Inertia::location(route('login'));
    }
}
