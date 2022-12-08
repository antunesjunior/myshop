<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartModel;
use App\Models\Invoice;
use App\Models\Phone;
use App\Models\Province;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => ['required', 'min:3'],
            'gender' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'phone_1' => ['required', 'numeric'],
            'phone_2' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', 'min:5']
        ]);

        $input['password'] = Hash::make($request->input('password'));

        $user = User::create([
            'name' => $input['name'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        Phone::insert([
            ['number' => $input['phone_1'], 'user_id' => $user->id],
            ['number' => $input['phone_2'], 'user_id' => $user->id]
        ]);

        $alert = [
            'type' => 'success',
            'message' => "Usuario {$user->name} criado com sucesso. Faça o Login!"
        ];
        return back()->with('alert', $alert);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'gender' => ['required'],
            'email' => ['required'],
            'phone_1' => ['required'],
            'phone_2' => ['required'],
        ]);

       $checkout = User::where('email', $request->email)->where('id', '!=', Auth::id())->exists();

       if ($checkout) {
            $alert = ['danger', 'O email usado já existe!'];
            return back()->with('alert', $alert);
       }

       $user = Auth::user();
       $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender
        ]);
        $user->phones[0]->number = $request->phone_1;
        $user->phones[1]->number = $request->phone_2;

        $user->save();
        $user->phones[0]->save();
        $user->phones[1]->save();

        Auth::user()->fill($user->toArray());
        $alert = ['success', 'Perfil actualizado com sucesso'];

        return back()->with('alert', $alert);
    }

    public function profile()
    {
        $user = Auth::user();
        $invoices = $user->invoices()->orderBy('created_at', 'desc')->get();

        return view('user.profile', [
            'user' => $user,
            'invoices' => $invoices
        ]);
    }

    public function addressDeliver()
    {
        $addresses = Auth::user()->addresses()->orderBy('id', 'desc')->get();
        return view('address-deliver', [
            'addresses' => $addresses,
            'provinces' => Province::all()
        ]);
    }

    public function checkout($idAddress)
    {
        $address = Address::findOrFail($idAddress);

        return view('checkout', [
            'user' => Auth::user(),
            'address' => $address
        ]);
    }

    public function shop($address)
    {
        $fail = [];
        $cart = Auth::user()->cart;

        foreach ($cart as $item) {
            if(($item->product->stock->qtd_prod - $item->quantity) < 1){
                $fail[] = $item->product;
            } 
        }

        if (count($fail) !== 0) {
            dd($fail);
        }

        foreach ($cart as $item) {
            $stock = $item->product->stock;
            $stock->qtd_prod -= $item->quantity;
            $stock->save();
        }

        $shop = [];
        $invoice = Invoice::create([
            'user_id' => Auth::id(), 
            'address_id' => $address,
            'total' => $cart->sum('total')
        ]);

        foreach ($cart as $item) {
            $shop[] = [
                'invoice_id' => $invoice->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'total' => $item->total,
            ];
        }
      
        Shop::insert($shop);
        CartModel::where('user_id', Auth::id())->delete();
        return redirect()->route('invoice.show', $invoice->id);
    }
}
