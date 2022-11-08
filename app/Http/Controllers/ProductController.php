<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockFeed;
use App\Models\Vendor;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request)
    {
        $request->validate([
            'value' => 'required',
            'key' => 'required',
        ]);

        switch ($request->key) {
            case 'code':
                $result = Product::where('id', $request->value)->get();
                break;

            case 'name':
                $result = Product::where('name', 'LIKE',"%{$request->value}%")->get();
                break;

            default:
                return back();
                break;
        }

        $message = "Total de resultados da pesquisa por '{$request->value}': {$result->count()}";
        session()->flash('message', $message);

        return view('admin.products.create-product', [
            'products' => $result,
            'categs'  => Category::all()
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
            'products' => Product::all(),
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


        $product = Product::create($input);
        Stock::create(['product_id' => $product->id]);

        return view('admin.products.create-product', [
            'products' => Product::all(),
            'categs' => Category::all()
        ]);
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
            'category_id' => ['required', 'numeric']
        ]);

        if ($request->input('category_id') == 0) {
            unset($input['category_id']);
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
        return redirect()->route('products.show', $product->id);
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
        $product->delete();
        
        return redirect()->route('products.create');
    }
}
