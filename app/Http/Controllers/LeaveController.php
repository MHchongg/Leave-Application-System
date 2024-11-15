<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LeaveController extends Controller
{
   public function user() {
      if (Auth::user()->role === 'user') {
         return Inertia::render('User/Home');
      }
      return Inertia::location(route('login'));
   }

   public function admin() {
      if (Auth::user()->role === 'admin') {
         return Inertia::render('Admin/Home');
      }
      return Inertia::location(route('login'));
   }
}
