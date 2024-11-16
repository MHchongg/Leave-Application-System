<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index() {
        $leaves = Leave::where('user_id', Auth::user()->id)->paginate(5);
        return Inertia::render('User/Home', ['leaves' => $leaves]);
    }
    public function profile () {
        $total_pending_leaves = Leave::where([
            ['user_id', '=', Auth::id()],
            ['status', '=', 'Pending']
        ])->count();

        return Inertia::render('User/Profile', ['total_pending_leaves' => $total_pending_leaves]);
    }

    public function edit_profile() {
        return Inertia::render('User/ProfileEdit');
    }

    public function update_profile(Request $request, User $user) {
        $validatedAttr = $request->validate([
            'name' => ['required', 'max:50'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'contactNo' => ['required', 'max:50'],
            'department' => ['required', Rule::in(['IT', 'Marketing', 'Sales', 'Accounting', 'Administration', 'Customer Service', 'HR'])]
        ]);

        $user->update($validatedAttr);
        return Inertia::location(route('profile'));
    }
}
