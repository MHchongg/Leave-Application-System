<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    public function profile () {
        if (Auth::user()->role === 'user') {
            return Inertia::render('User/Profile');
        }
        return Inertia::location(route('login'));
    }
}
