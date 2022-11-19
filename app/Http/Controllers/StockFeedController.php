<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockFeed;
use Illuminate\Http\Request;

class StockFeedController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            "vendor" => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'product' => ['required', 'numeric']
        ]);

        if($request->vendor == 0){
            return back();
        }

        $record = Product::findOrFail($request->product)->stock;
        $record->qtd_prod += $request->quantity;
        
        if ($record->save()) {
            StockFeed::create([
                'product_id' => $request->product,
                'vendor_id' => $request->vendor,
                'qtd_prod'  => $request->quantity
            ]);
        }

        return redirect()->route('products.show', $request->product);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            "vendor" => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'product' => ['required', 'numeric']
        ]);

        $feed = StockFeed::findOrFail($id);
        $oldquantity = $feed->qtd_prod;

        $feed->vendor_id = $request->vendor;
        $feed->qtd_prod = $request->quantity;
        
        if ($feed->save()) {
            $stock = Product::findOrFail($request->product)->stock;
            $stock->qtd_prod -= $oldquantity;
            $stock->qtd_prod += $request->quantity;
            $stock->save();
        }

        return redirect()->route('products.show', $feed->product_id);
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
