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
        //$recentProducts = Product::all()->orderBy('id', 'desc')->limit(8)->get();
        //dd(Product::all()->limit(2));

        return view('index', [
            'categories' => $categories
        ]);
    }

    public function homeAdmin()
    {
        return view('admin.home', ['admin' => Auth::user()]);
    }
}
