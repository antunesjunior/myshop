<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = 0;
        $products = Auth::user()->cart;
        
        foreach ($products as $product) {
            $total += $product->total;
        }
        
        return view('cart', [
            'products' => $products,
            'total' => $total
        ]);
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
        $request->validate([
            'number' => ['required'],
            'product' => ['required']
        ]);

        $isAdded = CartModel::where('product_id', $request->product)
        ->where('user_id', Auth::id())->exists();

        if ($isAdded) {
            dd('nao adicionou');
        }

        $cart = new CartModel();
        $cart->user_id = Auth::id();
        $cart->quantity = $request->number;
        $cart->product_id = $request->product;
        $cart->total = $cart->product->price * $cart->quantity;

        $checkout = $cart->product->stock->qtd_prod - $cart->quantity;
        
        if ($checkout < 0) {
            return back()->with('message', 'Nao ha quantidade suficiente disponivel');
        }

        $cart->save();

        return back();
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
        $cart = CartModel::findOrFail($id);

        return view('cart-prod-edit', [
            'cart' => $cart
        ]);
        
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
            'number' => ['required'],
        ]);

        $cart = CartModel::findOrFail($id);
        $checkout = $cart->product->stock->qtd_prod - $cart->quantity;
        
        if ($checkout < 0) {
            return back()->with('message', 'Nao ha quantidade suficiente disponivel');
        }

        $cart->quantity = $request->number;
        $cart->total = $cart->product->price * $cart->quantity;
        $cart->save();

        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productCart = CartModel::findOrfail($id);
        $productCart->delete();

        return redirect()->route('cart.index');
    }
}
