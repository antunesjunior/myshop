<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $recentProducts = Product::orderBy('id', 'desc')->limit(8)->get();

        return view('index', [
            'categories' => $categories,
            'recentProducts' => $recentProducts
        ]);
    }

    public function homeAdmin()
    {
        return view('admin.home', ['admin' => Auth::user()]);
    }
}
