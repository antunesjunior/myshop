<?php

namespace App\Http\Controllers;

use App\Models\PhoneVendor;
use App\Models\Vendor;
use DateTime;
use Illuminate\Http\Request;

class VendorController extends Controller
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
        return view('admin.vendor', [
            'vendors' => Vendor::orderBy('id', 'desc')->paginate(8)
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
            'phone_1'=> ['required'],
            'phone_2'=> ['required']
        ]);
        
        $vendor = Vendor::create([
            'name' => $request->name
        ]);

        PhoneVendor::create([
            'number' => $request->phone_1,
            'vendor_id' => $vendor->id
        ]);

        PhoneVendor::create([
            'number' => $request->phone_2,
            'vendor_id' => $vendor->id
        ]);

        return redirect()->route('vendors.create')->with('alert', [
            "type" =>'success',
            "message" =>"Fornecedor {$vendor->name} criado com successo!"
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
        $vendor = Vendor::findOrFail($id);

        return view('admin.vendor-show', [
            'vendor' => $vendor,
            'feeds' => $vendor->feeds()->paginate(8)
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
            'name' => ['required'],
            'phone_1'=> ['required'],
            'phone_2'=> ['required']
        ]);

        $vendor = Vendor::findOrFail($id);
        $phone1 = $vendor->phone[0];
        $phone2 = $vendor->phone[1];

        $vendor->name = $input['name'];
        $phone1->number = $request->phone_1;
        $phone2->number = $request->phone_2;

        if($phone1->save() && $phone2->save()){
            $vendor->save();
        }
        
        return back()->with('alert', [
            "type" =>'success',
            "message" =>"Fornecedor actualizado com successo!"
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
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        
        return redirect()->route('vendors.create')->with('alert', [
            "type" =>'success',
            "message" =>"Fornecedor '{$vendor->name}' eliminado com successo!"
        ]);
    }
}
