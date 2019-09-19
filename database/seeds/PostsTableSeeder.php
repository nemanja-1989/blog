<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("posts")->insert([
            ["id"=>1, "title"=>"BlogPost 1", "slug"=>"blogpost-1", "body"=>"This is first BlogPost!", "created_at"=>Carbon::now(), "updated_at"=>Carbon::now()]
        ]);
    }
}
