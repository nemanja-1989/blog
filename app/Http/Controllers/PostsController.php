<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        return view("posts.index", [
            "posts"=>$posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view("posts.create", [
            "categories"=>$categories,
            "tags"=>$tags
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
        $this->validate($request, [
            "title"=>["required", "regex:/^[a-zA-Z0-9\ \_\-]{1,30}$/"],
            "slug"=>["required", "regex:/^[a-zA-Z0-9\_\-]{5,255}$/"],
            "slug"=>"unique:posts,slug",
            'image' => 'file|sometimes|mimes:jpeg,bmp,png|max:5000',
            "body"=>["required", "min:1", "max:4000"],
            "category_id"=>"required",
            "tags"=>["sometimes"]
        ]);
        $post = new Post();
        $post->title = $request->input("title");
        $post->slug = $request->input("slug");
        $post->body = Purifier::clean($request->input("body"));
        $post->category_id = request()->input("category_id");


        if($request->hasFile("image")){
            $image = $request->file("image");
            $filename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $filename);
            $post->image = $filename;
        }
        $post->save();

        $post->tags()->sync(request()->input("tags"), false);

        Session::flash("Success", "BlogPost was created successfully!");
        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view("posts.show", [
            "post"=>$post
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
        $post = Post::findOrFail($id);
        $categories = Category::get();
        $tags = Tag::get();
        return view("posts.edit", [
            "post"=>$post,
            "categories"=>$categories,
            "tags"=>$tags
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
        $this->validate($request, [
            "title"=>["required", "regex:/^[a-zA-Z0-9\ \_\-]{1,30}$/"],
            "slug"=>["required", "regex:/^[a-zA-Z0-9\_\-]{5,191}$/"],
            "slug"=>"unique:posts,slug, $id",
            "image"=>"file|sometimes|mimes:jpeg,bmp,png|max:5000",
            "body"=>["required", "min:1", "max:4000"],
            "category_id"=>["required"],
            "tags"=>["sometimes"]
        ]);
        $post = Post::findOrFail($id);
        $post->title = request()->input("title");
        $post->slug = request()->input("slug");
        $post->body = Purifier::clean(request()->body);
        $post->category_id = request()->input("category_id");

        if($request->hasFile("image")){
            $image = request()->file("image");
            $filename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path("img"), $filename);

            $post->image = $filename;
        }
        $post->save();
        $post->tags()->sync(request()->input("tags"));

        Session::flash("Success", "BlogPost was updated successfully!");
        return redirect()->route("posts.edit", $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash("Success", "This BlogPost was deleted successfully!");
        return redirect()->route("posts.index");
    }
}
