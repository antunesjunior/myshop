<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return "<h1>Home</h1>";
    }

    public function homeAdmin()
    {
        return view('admin.home', ['admin' => Auth::user()]);
    }
}
