<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $last = $posts->sortBy('create_at')->take(5);
        $about = About::find(1);
        return view('home',[
            'posts' => $posts,
            'last' => $last,
            'about' => $about
        ]);
    }

    public function createBlock()
    {
        $categories = Category::all();
        return view('writer.create-block',[
            'categories' => $categories
        ]);
    }
}
