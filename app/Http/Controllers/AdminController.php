<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
  public function index() {
    return Inertia::render('Admin/Home');
  }

  public function users() {
    $users = User::where('role', 'user')->paginate(5);
    return Inertia::render('Admin/Users', ['users' => $users]);
  }

  public function create_user() {
    return Inertia::render('Admin/CreateUser');
  }

  public function store_user(Request $request) {
    $validatedAttr = $request->validate([
      'name' => ['required', 'max:50'],
      'email' => ['required', 'email', 'unique:users,email'],
      'gender' => ['required', Rule::in(['male', 'female'])],
      'contactNo' => ['required', 'max:50'],
      'department' => ['required', Rule::in(['IT', 'Marketing', 'Sales', 'Accounting', 'Administration', 'Customer Service', 'HR'])]
    ]);

    $validatedAttr['role'] = 'user';
    $validatedAttr['first_time'] = true;
    $validatedAttr['password'] = $validatedAttr['email'];

    User::create($validatedAttr);

    return Inertia::location(route('admin.users'));
  }

  public function show_user(User $user) {
    return Inertia::render('Admin/ShowUser', ['user' => $user]);
  }

  public function edit_user(User $user) {
    return Inertia::render('Admin/EditUser', ['user' => $user]);
  }

  public function update_user(Request $request, User $user) {
    $validatedAttr = $request->validate([
      'name' => ['required', 'max:50'],
      'gender' => ['required', Rule::in(['male', 'female'])],
      'contactNo' => ['required', 'max:50'],
      'department' => ['required', Rule::in(['IT', 'Marketing', 'Sales', 'Accounting', 'Administration', 'Customer Service', 'HR'])]
    ]);

    $user->update($validatedAttr);

    return Inertia::location(route('admin.users.show', ['user' => $user]));
  }

  public function destroy_user(User $user) {
    $user->delete();

    return Inertia::location(route('admin.users'));
  }
}
