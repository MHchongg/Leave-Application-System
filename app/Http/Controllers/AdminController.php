<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
      return Inertia::render('Admin/Home');
    }

   public function users() {
    return Inertia::render('Admin/Users');
   }
}
