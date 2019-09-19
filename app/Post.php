<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = ["title", "image", "slug", "body"];

    public function category(){
        return $this->belongsTo("App\Category");
    }
    public function tags(){
        return $this->belongsToMany("App\Tag");
    }
    public function comments(){
        return $this->hasMany("App\Comment");
    }
}
