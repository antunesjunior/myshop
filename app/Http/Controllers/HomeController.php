<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return "<h1>Home</h1>";
    }

    public function homeAdmin()
    {
        return view('admin.home');
    }
}
