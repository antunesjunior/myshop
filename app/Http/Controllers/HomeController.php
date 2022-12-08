<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $detach = Product::getjoinStock()->where('detach', 1)->limit(4)->get();
        $categories = Category::whereNotNull('cover')->limit(8)->get();
        $recentProducts = Product::orderBy('id', 'desc')->limit(8)->get();
        
        return view('index', [
            'detach' => $detach,
            'categories' => $categories,
            'recentProducts' => $recentProducts
        ]);
    }

    public function homeAdmin()
    {
        $stock = Stock::where('qtd_prod', '<=', 10)->paginate(8);
        return view('admin.home', [
            'admin' => Auth::user(),
            'stock' => $stock,
            'vendors' => Vendor::all(),
        ]);
    }
}
