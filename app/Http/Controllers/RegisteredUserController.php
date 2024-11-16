<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    // reset password
    public function password() {
        return Inertia::render('Auth/ResetPassword');
    }

    public function update_password(Request $request, User $user) {
        $validatedAttr = $request->validate([
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $user->update($validatedAttr);

        return Inertia::location(route('profile'));
    }
}
