<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
  public function index() {
    $leaves = Leave::with('user:id,name,email')->paginate(5);
    return Inertia::render('Admin/Home', ['leaves' => $leaves]);
  }

  public function users() {
    $users = User::select("id", 'name', 'gender', 'email', 'role', 'contactNo', 'department', 'first_time')->where('role', 'user')->paginate(5);
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
    $total_pending_leaves = Leave::where([
        ['user_id', '=', $user->id],
        ['status', '=', 'Pending']
    ])->count();

    $user['total_pending_leaves'] = $total_pending_leaves;

    return Inertia::render('Admin/ShowUser', ['user' => $user]);
  }

  public function destroy_user(User $user) {
    $user->delete();

    return Inertia::location(route('admin.users'));
  }
}
