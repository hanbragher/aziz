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
    'uses' => 'Posts\PostController@myPosts'

]);

Route::get("/photos/my/", [
    "as" => "photos.my",
    'uses' => 'Photos\PhotoController@myPhotos'

]);

/*Route::get("/favorites/announcements/", [
    "as" => "favorites.announcements",
    'uses' => 'Favorites\FavoriteController@announcements'

]);*/

/*Route::get("/favorites/photos/", [
    "as" => "favorites.photos",
    'uses' => 'Favorites\FavoriteController@photos'

]);*/


Route::resource('/posts', 'Posts\PostController');

Route::resource('/blogs', 'Blogs\BlogController');

Route::resource('/notes', 'Notes\NoteController');

Route::resource('/profiles', 'Profiles\ProfileController');

Route::resource('/places', 'Places\PlaceController');

Route::resource('/announcements', 'Announcements\AnnouncementController');

Route::resource('/messages', 'Messages\MessageController');

Route::resource('/comments', 'Comments\CommentController');

Route::resource('/favorites', 'Favorites\FavoriteController');

Route::resource('/notifications', 'Notifications\NotificationController');

Route::resource('/photos', 'Photos\PhotoController');


Route::get('/message', function () {
    return Abort(404);
});

Route::post('/message/{id}', [
    "as" => "messages.downloadAttachments",
    'uses' => 'Messages\MessageController@downloadAttachment'
]);

Route::get('/mypage', [
    "as" => "profiles.my",
    'uses' => 'Profiles\ProfileController@myPage'
]);

Route::get('/myannouncements', [
    "as" => "announcements.my",
    'uses' => 'Announcements\AnnouncementController@myAnnouncements'
]);

Route::post('/myannouncements/{id}/reply', [
    "as" => "announcements.reply",
    'uses' => 'Announcements\AnnouncementController@announcementReply'
]);

Route::get('/profile/{id}/posts', [
    "as" => "profile.posts",
    'uses' => 'Posts\PostController@profilePosts'
]);

Route::get('/profile/{id}/notes', [
    "as" => "profile.notes",
    'uses' => 'Profiles\ProfileController@profileNotes'
]);

Route::get('/profile/{id}/adverts', [
    "as" => "profile.adverts",
    'uses' => 'Profiles\ProfileController@profileAdverts'
]);






Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/page', function () {
    return view('page');
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






Route::get( '/logout', [
    'as' => 'logout',
    'uses' => 'HomeController@logout',
] );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
