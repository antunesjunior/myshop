<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
            'vendors' => Vendor::all(),
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
            'name' => ['required'],
            'brand' => ['required'],
            'description' => ['required'],
            'cover' => ['file', 'required'],
            'price' => ['required', 'numeric'],
            'vendor_id' => ['required'],
            'category_id' => ['numeric']
        ]);

        if ($request->input('vendor_id') == 0) {
            return back();
        }

        if ($request->input('category_id') == 0) {
            unset($input['category_id']);
        }

        $cover = $request->file('cover');
        $coverName = $cover->hashName();
        $cover->storeAs('public/products/cover', $coverName);
        $input['cover'] = $coverName;


        Product::create($input);
        return view('admin.products.create-product', [
            'products' => Product::all(),
            'vendors' => Vendor::all(),
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
            'product' => $product
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
