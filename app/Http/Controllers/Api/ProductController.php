<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\SupCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function categoriesHome()
    {
        $categories = Category::whereNotNull('cover')->limit(8)->get();
        return response()->json($categories);
    }

    public function featured()
    {
        $featuredProducts = Product::getByEnoughtStockQuantity()
                            ->where('detach', 1)->limit(4)->get();
        return response()->json($featuredProducts);
    }

    public function recent()
    {
        $recentProducts = Product::orderBy('id', 'desc')->limit(8)->get();
        return response()->json($recentProducts);
    }

    public function catalogue()
    {
        $products = Product::getByEnoughtStockQuantity()
                    ->inRandomOrder()
                    ->paginate(ProductHelper::PER_PAGE_CATALOGUE);

        return response()->json([$products, "categName" => "Todas as Categorias"]);
    }

    public function catalogueByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::getByEnoughtStockQuantity()
                    ->where('category_id', $category->id)
                    ->paginate(ProductHelper::PER_PAGE_CATALOGUE);

        return response()->json([$products, "categName" => $category->name]);
    }

    public function catalogueBySuperCategory($id)
    {
        $supCategory = SupCategory::findOrFail($id);
        $products = Product::getBySuperCategoryId($supCategory->id);

        return response()->json([$products, "categName" => $supCategory->name]);
    }

    public function userSearch(Request $request)
    { 
        //$request->validate(['value' => 'required']);
        $products = Product::userSearch($request->value)
                    ->paginate(ProductHelper::PER_PAGE_CATALOGUE);

        return response()->json($products);
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}
