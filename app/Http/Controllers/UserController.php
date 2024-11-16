<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() {
      return Inertia::render('User/Home');
   }
    public function profile () {
        return Inertia::render('User/Profile');
    }
}
