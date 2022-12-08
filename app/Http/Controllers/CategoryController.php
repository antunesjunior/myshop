<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SupCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $cat =  Category::paginate($perPage = 6, $columns = ['*'], $pageName = 'cat');
        $sup = SupCategory::paginate($perPage = 6, $columns = ['*'], $pageName = 'supcat');

        return view('admin.categories', [
            'categs' =>$cat,
            'supCategs' => $sup
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
        $inputs = $request->validate([
            'name' => ['required'],
            'cover' => ['file'],
            'sup_category_id' => ['required']
        ]);

        if ($request->input('sup_category_id') == 0) {
            unset($inputs['sup_category_id']);
        }

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = $cover->hashName();
            $cover->storeAs('public/categories/cover', $coverName);
            $input['cover'] = $coverName;
        }

        $cat = Category::create($inputs);

        return back()->with('alert', [
            "type" =>'success',
            "message" =>"Categoria {$cat->name} criada com successo!"
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
        $cat = Category::findOrFail($id);
        $supCat = SupCategory::paginate();
        return view('admin.category-show', [
            'category' => $cat,
            'supCategs' => $supCat
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
            'cover' => ['file'],
            'sup_category_id' => ['required']
        ]);

        if ($request->input('sup_category_id') == 0) {
            $input['sup_category_id'] = null;
        }

        $cat = Category::findOrFail($id);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = $cover->hashName();
            $cover->storeAs('public/categories/cover', $coverName);
            $input['cover'] = $coverName;

            Storage::delete("public/categories/cover/{$cat->cover}");
        }

        $cat->fill($input)->save();
        return back()->with('alert', [
            "type" =>'success',
            "message" =>'Categoria actualizada com successo!'
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
        
        $cat = Category::findOrFail($id);

        if ($cat->products->count() > 0) {
            return back()->with('alert', [
                "type" =>'danger',
                "message" =>'Não pode ser deletado. Há productos associados a esta categoria'
            ]);
        }

        $cat->delete();
        Storage::delete("public/products/cover/{$cat->cover}");

        return redirect()->route('categories.create')->with('alert', [
            "type" =>'success',
            "message" =>"Categoria {$cat->name} eliminada!"
        ]);
    }
}
