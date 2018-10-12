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
Route::get('test',['uses'=>'TestController@test']);
Route::post('test',['uses'=>'TestController@test']);


Route::get("/posts/my/", [
    "as" => "posts.my",
    //'middleware' => ['auth'], //todo sarqel policy blogger
    'uses' => 'Posts\PostController@myPosts'

]);

Route::resource('/posts', 'Posts\PostController');

Route::resource('/notes', 'Notes\NoteController');

Route::resource('/profiles', 'Profiles\ProfileController');





Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/page', function () {
    return view('page');
});

Route::get('/mypage', function () {
    return view('profile.my');
});

Route::get('/item', function () {
    return view('item');
});

Route::get('/blog', function () {
    return view('blog.index');
});

Route::get('/editblog', function () {
    return view('blog.edit');
});



Route::get('/newpost', function () {
    return view('blog.create');
});

Route::get('/messeges', function () {
    return view('chat.index');
});



Route::get( '/logout', [
    'as' => 'logout',
    'uses' => 'HomeController@logout',
] );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
