<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockFeed;
use App\Models\SupCategory;
use App\Models\Vendor;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function userSearch(Request $request)
    { 
        $request->validate(['value' => 'required']);
        $products = Product::userSearch($request->value)
                    ->paginate(ProductHelper::PER_PAGE_CATALOGUE);

        return view('shop', [
            'products' => $products,
            'catName'  => "Resultados da pesquisa por '{$request->value}'"
        ]);
    }

    public function adminSearch(Request $request)
    {
        $request->validate(['value' => 'required']);
        $products = Product::search($request->value)
                    ->paginate(ProductHelper::PER_PAGE_ADMIN);;

        session()->flash('alert', [
            'type' => 'info',
            'message' => "Total de resultados da pesquisa por '{$request->value}': {$products->count()}"
        ]);

        return view('admin.products.create-product', [
            'products' => $products,
            'categs'  => Category::all()
        ]);
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);

        return view('product-detail', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create-product', [
            'products' => Product::paginate(ProductHelper::PER_PAGE_ADMIN),
            'categs' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name'  => ['required'],
            'brand' => ['required'],
            'description' => ['required'],
            'cover' => ['file', 'required'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric']
        ]);


        if ($request->input('category_id') == 0) {
            unset($input['category_id']);
        }

        $cover = $request->file('cover');
        $coverName = $cover->hashName();
        $cover->storeAs('public/products/cover', $coverName);
        $input['cover'] = $coverName;

        $stock = Stock::create();

        if ($stock) {
            $input['stock_id'] = $stock->id;
            Product::create($input);
        }
        
        return redirect()->route('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $feedRecord = StockFeed::lastProductFeed($id);

        return view('admin.products.product', [
            'product' => $product,
            'vendors' => Vendor::all(),
            'categs'  => Category::all(),
            'lastFeed'=> $feedRecord
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'name'  => ['required'],
            'brand' => ['required'],
            'description' => ['required'],
            'cover' => ['nullable', 'file'],
            'price' => ['required', 'numeric'],
            'detach' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'show' => ['required', 'numeric'],
        ]);

        if ($request->input('category_id') == 0) {
            $input['category_id'] = null;
        }

        $product = Product::findOrFail($id);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = $cover->hashName();
            $cover->storeAs('public/products/cover', $coverName);
            $input['cover'] = $coverName;

            Storage::delete("public/products/cover/{$product->cover}");
        }

        $product->fill($input)->save();
        return back()->with('alert', [
            "type" =>'success',
            "message" =>"Produto actualizado com successo!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->stock->delete();
        $product->delete();
        
        return redirect()->route('products.create');
    }
}
