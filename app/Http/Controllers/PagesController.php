<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;

class PagesController extends Controller
{
    public function index(){
        $posts = Post::orderBy("created_at", "desc")->paginate(2);
        return view("pages.index", [
            "posts"=>$posts
        ]);
    }
    public function singleBlogPost($slug){
        $posts = Post::where("slug", "=", $slug)->get();
        return view("pages.single", [
            "posts"=>$posts
        ]);
    }
    public function latestBlogPosts(){
        $posts = Post::orderBy("created_at", "desc")->limit(4)->get();
        return view("pages.latest", [
            "posts"=>$posts
        ]);
    }
}
