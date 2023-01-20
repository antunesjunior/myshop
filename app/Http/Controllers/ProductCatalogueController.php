<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\Category;
use App\Models\Product;
use App\Models\SupCategory;
use Illuminate\Http\Request;

class ProductCatalogueController extends Controller
{
    public function catalogue()
    {
        $products = Product::getByEnoughtStockQuantity()
                    ->inRandomOrder()
                    ->paginate(ProductHelper::PER_PAGE_CATALOGUE);

        return view('shop', [
            'products' => $products,
            'catName' => "Todas as Categorias"
        ]);
    }

    public function catalogueByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::getByEnoughtStockQuantity()
                    ->where('category_id', $category->id)
                    ->paginate(ProductHelper::PER_PAGE_CATALOGUE);

        return view('shop', [
            'products' => $products,
            'catName' => $category->name
        ]);
    }

    public function catalogueBySuperCategory($id)
    {
        $supCategory = SupCategory::findOrFail($id);
        $products = Product::getBySuperCategoryId($supCategory->id);
       
        return view('shop', [
            'products' => $products,
            'catName' => $supCategory->name
        ]);
    }

}
