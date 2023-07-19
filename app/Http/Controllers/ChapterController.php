<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $chapters = Chapter::with('comicchapter')->orderBy('id','DESC')->get();
        return view('admincp.chapter.index')->with(compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comic = Comic::orderBy('id','DESC')->get();
        return view('admincp.chapter.create')->with(compact('comic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:chapter|max:255',
                'slug_chapter' => 'required|unique:chapter|max:255',
                'description' => 'required',
                'content' => 'required',
                'status' => 'required',
                'comic_id' => 'required'
            ]
        );
        // $data = $request->all();
        $chapter = new Chapter();
        $chapter->title = $data['title']; 
        $chapter->description = $data['description']; 
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->content = $data['content']; 
        $chapter->status = $data['status'];
        $chapter->comic_id = $data['comic_id'];   
        $chapter->save();

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
        $comics = Comic::orderBy('id','DESC')->get();
        $chapters = Chapter::find($id);
        return view('admincp.chapter.edit')->with(compact('chapters','comics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                'description' => 'required',
                'content' => 'required',
                'status' => 'required',
                'comic_id' => 'required'
            ]
        );
        // $data = $request->all();
        $chapter = Chapter::find($id);
        $chapter->title = $data['title']; 
        $chapter->description = $data['description']; 
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->content = $data['content']; 
        $chapter->status = $data['status'];
        $chapter->comic_id = $data['comic_id'];   
        $chapter->save();

        return redirect()->back()->with('message','update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('message','delete successfully');
    }
}
