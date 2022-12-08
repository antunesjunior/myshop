<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SupCategory;
use Illuminate\Http\Request;

class SupCategoryController extends Controller
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
            'name' => ['required'],
        ]);

        $sup = SupCategory::create($inputs);

        return back()->with('alert', [
            "type" =>'success',
            "message" =>"Categoria {$sup->name} criada com successo!"
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
        $sup = SupCategory::findOrFail($id);
       
        return view('admin.sup-categ-show', [
            'category' => $sup,
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
        $request->validate([
            'name' => ['required'],
        ]);

        $sup = SupCategory::findOrFail($id);
        $sup->name = $request->name;
        $sup->save();

        return back()->with('alert', [
            "type" =>'success',
            "message" =>'Super Categoria actualizada com successo!'
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
        $sup = SupCategory::findOrFail($id);

        if ($sup->categories->count() > 0) {
            return back()->with('alert', [
                "type" =>'danger',
                "message" =>'Não pode ser deletado. Há categorias associados a esta super categoria'
            ]);
        }

        $sup->delete();

        return redirect()->route('categories.create')->with('alert', [
            "type" =>'success',
            "message" =>"Categoria {$sup->name} eliminada!"
        ]);
    }
}
