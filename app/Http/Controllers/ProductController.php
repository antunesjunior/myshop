<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Vendor;
use Illuminate\Http\Request;

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
        return view('admin.products.product', [
            'product' => $product,
            'vendors' => Vendor::all()
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
