<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//PagesController
Route::get('/', "PagesController@index")->name("pages.index");
Route::get("/pages/latest-blogposts", "PagesController@latestBlogPosts")->name("pages.latest");
Route::get("/pages/{slug}", "PagesController@singleBlogPost")->name("pages.single")
->where("slug", "[a-zA-Z0-9\_\-]{5,255}");


//LoginController
Route::get("auth/login", "Auth\LoginController@showLoginForm");
Route::post("auth/login", "Auth\LoginController@login")->name("login");
Route::get("auth/logout", "Auth\LoginController@logout")->name("logout");

//RegisterController
Route::get("auth/register", "Auth\RegisterController@showRegistrationForm");
Route::post("auth/register", "Auth\RegisterController@register")->name("register");

//Reset password route
Route::get("password/reset", "Auth\ForgotPasswordController@showLinkRequestForm")->name("password.request");
Route::post("password/email", "Auth\ForgotPasswordController@sendResetLinkEmail")->name("password.email");
Route::get("password/reset/{token}", "Auth\ResetPasswordController@showResetForm");
Route::post("password/reset", "Auth\ResetPasswordController@reset")->name("password.reset");

//PostsController
Route::resource("posts", "PostsController");

//CategoryController
Route::resource("category", "CategoryController");

//TagsController
Route::resource("tags", "TagsController");

//CommentsController
Route::post("comments/{post_id}", "CommentsController@store")->name("comments.store");
Route::get("comments/{id}/edit", "CommentsController@edit")->name("comments.edit");
Route::patch("comments/{id}", "CommentsController@update")->name("comments.update");
Route::delete("comments/{id}", "CommentsController@destroy")->name("commnets.destroy");
Route::get("comments/{id}", "CommentsController@delete")->name("comments.delete");