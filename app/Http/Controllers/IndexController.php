<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\Comic;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function home(){
        $slidecomic = Comic::with('categorycomic')->orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $comicstrending = Comic::with('categorycomic')
                    ->leftJoin('chapter', 'comic.id', '=', 'chapter.comic_id')
                    ->select('comic.*', DB::raw('COUNT(chapter.id) as chapter_count'))
                    ->where('comic.status', 0)
                    ->groupBy('comic.id')
                    ->orderBy('comic.id', 'ASC')
                    ->take(6)->get();
        $comicsrecently = Comic::with('categorycomic')
                    ->leftJoin('chapter', 'comic.id', '=', 'chapter.comic_id')
                    ->select('comic.*', DB::raw('COUNT(chapter.id) as chapter_count'))
                    ->where('comic.status', 0)
                    ->groupBy('comic.id')
                    ->orderBy('comic.id', 'DESC')
                    ->take(6)->get();
        $comicsview = Comic::with('categorycomic')
                    ->leftJoin('chapter', 'comic.id', '=', 'chapter.comic_id')
                    ->select('comic.*', DB::raw('COUNT(chapter.id) as chapter_count'))
                    ->where('comic.status', 0)
                    ->groupBy('comic.id')
                    ->orderBy('view', 'DESC')
                    ->take(6)->get();
        $comments = Comment::with('comiccomment')->get();

        return view('layout')->with(compact('category','slidecomic','comicsrecently','comicstrending','comicsview','comments'));
    }
    public function category($slug){
        return view('pages.comic')->with(compact('category','slidecomic'));; 
    }
    public function viewComic($slug){
        $slidecomic = Comic::with('categorycomic')->orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $comics = Comic::where('slug_comic',$slug)->first();
        $chapters = Chapter::all();
        return view('pages.chapter')->with(compact('category','slidecomic','comics','chapters'));
    }

    public function readComic($slug){
        $slidecomic = Comic::with('categorycomic')->orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $comics = Comic::where('slug_comic',$slug)->first();
        $chapters = Chapter::all();
        return view('pages.comic')->with(compact('category','slidecomic','comics','chapters'));
    }

    public function detail($slug){
        $category = Category::orderBy('id','DESC')->get();
        $comics = Comic::with('categorycomic')->where('slug_comic',$slug)->first();
        $comments = Comment::with('comiccomment')->join('comic', 'comment.comic_id', '=', 'comic.id')
                            ->where('comic.slug_comic',$slug)->get();
        return view('pages.detail')->with(compact('category','comics','comments'));; 
    }   

    public function addComments(Request $request){
        $data = $request;
        $comment = new Comment();
        $comment->comment = $data['comment']; 
        $comment->comic_id =  $data['comic_id'];
        $comment->date =  Carbon::now();
        $comment->users_id = Auth::id();   
        $comment->save();

        return redirect()->back()->with('message','add comment successfully');
    }
}
