<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        
        if (Auth::user()) {
            $products = Auth::user()->cart;
            $total = $products->sum('total');

        } else {
            $products = session('guestCart');
            foreach ($products as $product) {
                $total += $product->total; 
            }
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
            'number'  => ['required'],
            'product' => ['required']
        ]);

        $isAdded = CartModel::where('product_id', $request->product)
        ->where('user_id', Auth::id())->exists();

        if ($isAdded) {
            return back()->with('alert', [
                "type" =>'warning',
                "message" =>'Este Produto já existe no carrinho!'
            ]);
        }

        $cart = new CartModel();
        $cart->user_id = Auth::id();
        $cart->quantity = $request->number;
        $cart->product_id = $request->product;
        $cart->total = $cart->product->price * $cart->quantity;

        $checkout = $cart->product->stock->qtd_prod - $cart->quantity;
        
        if ($checkout < 0) {

            return back()->with('alert', [
                "type" =>'warning',
                "message" =>'Quantidade indisponível. Reduza Por favor!'
            ]);
        }

        if (!$request->user()) {
            if (!session()->has('guestCart')) {
                session()->put('guestCart', []);
            }
    
            session()->push('guestCart', $cart);

        } else {
            $cart->save();
        }


        return back()->with('alert', [
            "type" =>'success',
            "message" =>'Produto adicionado ao carrinho!'
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
            return back()->with('alert', [
                'type' => 'warning',
                'message' => 'Nao ha quantidade suficiente disponivel'
            ]);
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
