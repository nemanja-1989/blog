<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categories")->insert([
            ["id"=>1, "category_name"=>"Laravel", "created_at"=>Carbon::now(), "updated_at"=>Carbon::now()]
        ]);
    }
}
