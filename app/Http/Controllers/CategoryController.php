<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('admincp.category.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admincp.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:category|max:255',
                'description' => 'required|max:255',
                'status' => 'required'
            ]
            ,
            [
                'name.unique' => 'name is exists, please enter another name',
                'name.required' => 'The name field is required.'
            ]
        );
        // $data = $request->all();
        $category = new Category();
        $category->name = $data['name']; 
        $category->description = $data['description']; 
        $category->status = $data['status']; 
        $category->save();
        return redirect()->back()->with('message','add successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admincp.category.edit')->with(compact('category'));;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'status' => 'required'
            ]
            ,
            [
                'name.required' => 'The name field is required.'
            ]
        );
        // $data = $request->all();
        $category = Category::find($id);
        $category->name = $data['name']; 
        $category->description = $data['description']; 
        $category->status = $data['status']; 
        $category->save();
        return redirect()->back()->with('message','update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('message','delete successfully');
    }

}
