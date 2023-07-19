<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comics = Comic::with('categorycomic')->orderBy('id','DESC')->get();
        return view('admincp.comic.index')->with(compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('admincp.comic.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:comic|max:255',
                'slug_comic' => 'required|unique:comic|max:255',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,
                // min_height=100,max_width=5000,max_height=5000',
                'image' => 'required',
                'description' => 'required',
                'status' => 'required',
                'category_id' => 'required'
            ]
            ,
            [
                'slug_comic.unique' => 'slug is exists, please enter another slug',
                'name.required' => 'The name field is required.',
                'name.unique' => 'name is exists, please enter another name',
                'description.required' => 'The description field is required.',
                'image.required' =>  'image is required'
            ]
        );
        // $data = $request->all();
        $comic = new Comic();
        $comic->name = $data['name']; 
        $comic->description = $data['description']; 
        $comic->slug_comic = $data['slug_comic'];
        $comic->status = $data['status'];
        $comic->category_id = $data['category_id'];
        //add image to folder
        $get_image = $request->image;
        $path = 'public/uploads/comic/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode(".",$get_name_image));
        $new_image = $name_image.rand(0,99).".".$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $comic->image = $new_image;
        
        $comic->save();

        return redirect()->back()->with('message','add successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::orderBy('id','DESC')->get();
        $comic = Comic::find($id);
        return view('admincp.comic.edit')->with(compact('comic','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'slug_comic' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'category_id' => 'required'
        ], [
            'name.required' => 'The name field is required.',
            'description.required' => 'The description field is required.',
        ]);

        $comic = Comic::find($id);
        $comic->name = $data['name'];
        $comic->description = $data['description'];
        $comic->slug_comic = $data['slug_comic'];
        $comic->status = $data['status'];
        $comic->category_id = $data['category_id'];

        // Check if the image file exists and is valid before processing
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $get_image = $request->file('image');
            $path = 'public/uploads/comic';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode(".", $get_name_image));
            $new_image = $name_image . rand(0, 99) . "." . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $comic->image = $new_image;
        }

        $comic->save();

        return redirect()->back()->with('message', 'update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comic = Comic::find($id);
        $path = 'public/uploads/comic/'.$comic->image;
        if(file_exists($path)){
            unlink($path);
        }
        Comic::find($id)->delete();
        return redirect()->back()->with('message','delete successfully');
    }
}
