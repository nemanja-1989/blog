<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use Session;

class TagsController extends Controller
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
        $tags = Tag::get();
        return view("tags.index", [
            "tags"=>$tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tags.create");
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
            "tag_name"=>["required", "regex:/^[a-zA-Z0-9\ \_\-\.]{1,20}$/"]
        ]);
        $tag = new Tag();
        $tag->tag_name = request()->input("tag_name");

        $tag->save();
        Session::flash("Success", "Tag was created successfully!");
        return redirect()->route("tags.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view("tags.show", [
            "tag"=>$tag
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
        $tag = Tag::findOrFail($id);
        return view("tags.edit", [
            "tag"=>$tag
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
            "tag_name"=>["required", "regex:/^[a-zA-Z0-9\ \_\-]{1,20}$/"]
        ]);
        $tag = Tag::findOrFail($id);
        $tag->tag_name = request()->input("tag_name");

        $tag->save();
        Session::flash("Success", "Tag was edited successfully!");
        return redirect()->route("tags.edit", $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        Session::flash("Success", "Tag was deleted successfully!");
        return redirect()->route("tags.index");
    }
}
