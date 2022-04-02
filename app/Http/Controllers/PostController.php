<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('writer.add-post',[
            'categories' => $categories
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

        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'text'  => 'required'
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }
        $post = new Post();
        $new_post_id = $post->storePost($request);
        return redirect()->action([PostController::class, 'show'])->with($new_post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $last = Post::get()->sortBy('create_at')->take(5);
        $about = About::find(1);
        return view('post',[
            'post' => $post,
            'last' => $last,
            'about' => $about
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
        $post = Post::find($id);
        $categories = Category::all();

        return view('update-post',[
            'post' => $post,
            'categories' => $categories
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
        $post = new Post();
        $post->updatePost($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->action([HomeController::class, 'index']);
    }

    public function search(Request $request)
    {
        $posts = Post::where('title','like', '%'.$request->text.'%')->get();
        $last = Post::get()->sortBy('create_at')->take(5);
        $about = About::find(1);
        return view('home',[
            'last' => $last,
            'posts' => $posts,
            'about' => $about
        ]);
    }
}
