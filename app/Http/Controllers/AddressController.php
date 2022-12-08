<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.addresses',[
            'addresses' => Address::all(),
            'provinces' => Province::all()
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
            'prov' => ['required'],
            'muni' => ['required'],
            'bairro' => ['required'],
            'rua' => ['required'],
        ]);

        Address::create([
            'rua' => $request->rua,
            'muni' => $request->muni,
            'bairro' => $request->bairro,
            'user_id' => Auth::id(),
            'province_id' => $request->prov,
        ]);

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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::findOrFail($id);

        return view('user.address-edit', [
            'address' => $address,
            'provinces' => Province::all()
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
            'prov' => ['required'],
            'muni' => ['required'],
            'bairro' => ['required'],
            'rua' => ['required'],
        ]);

        $address = Address::findOrFail($id);

        $address->fill([
            'rua' => $request->rua,
            'muni' => $request->muni,
            'bairro' => $request->bairro,
            'user_id' => Auth::id(),
            'province_id' => $request->prov,
        ]);

        $address->save();
        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->route('address.index');
    }
}
