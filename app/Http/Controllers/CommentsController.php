<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Session;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware("auth", ["except" => "store"]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            "name"=>["required", "max:40"],
            "email"=>["required", "email", "regex:/^[a-zA-Z0-9\ \/\_\-\.]+\@[a-zA-Z0-9\ \/\_\-\.]+\.[a-z]{2,4}$/"],
            "comment"=>["required", "min:5", "max:2000"]
        ]);
        $post = Post::findOrFail($post_id);
        $comment = new Comment();
        $comment->name = request()->input("name");
        $comment->email = request()->input("email");
        $comment->comment = request()->input("comment");
        $comment->post_id = $post_id;

        $comment->save();
        Session::flash("Success", "Comment was created successfully!");
        return redirect()->route("pages.single", $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view("comments.edit", [
            "comment"=>$comment
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
            "comment"=>"required"
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = request()->input("comment");

        $comment->save();
        Session::flash("Success", "Comment  was edited successfully!");
        return redirect()->route("posts.show", $comment->post->id);

    }
        public function delete($id){
            $comment = Comment::findOrFail($id);
            return view("comments.delete", [
                "comment"=>$comment
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
        $comment = Comment::findOrFail($id);
        $comment->delete();

        Session::flash("Success", "Comment deleted!");
        return redirect()->route("posts.show", $comment->post->id);
    }
}
