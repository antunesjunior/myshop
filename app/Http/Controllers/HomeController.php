<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
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
        $stock = Stock::where('qtd_prod', '<=', 10)->get();
        return view('admin.home', [
            'admin' => Auth::user(),
            'products' => $stock
        ]);
    }
}
