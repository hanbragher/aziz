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

Route::get("/notes/my/", [
    "as" => "notes.my",
    'uses' => 'Notes\NoteController@myNotes'

]);

Route::get("/photos/my/", [
    "as" => "photos.my",
    'uses' => 'Photos\PhotoController@myPhotos'

]);

Route::get("/photos/comments/{id}", [
    "as" => "photos.comments",
    'uses' => 'Photos\PhotoController@comments'

]);

Route::get('/places/my', [
    "as" => "places.my",
    'uses' => 'Places\PlaceController@myPlaces'
]);

Route::get('/places/{id}/readNotes', [
    "as" => "places.readNotes",
    'uses' => 'Places\PlaceController@readNotes'
]);


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
    'uses' => 'Profiles\ProfileController@profilePosts'
]);

Route::get('/profile/{id}/notes', [
    "as" => "profile.notes",
    'uses' => 'Profiles\ProfileController@profileNotes'
]);


Route::get('/profile/{id}/announcements', [
    "as" => "profile.announcements",
    'uses' => 'Profiles\ProfileController@profileAnnouncements'
]);

Route::get('/profile/{id}/photos', [
    "as" => "profile.photos",
    'uses' => 'Profiles\ProfileController@profilePhotos'
]);

Route::get('/profile/{id}/password/change', [
    "as" => "profile.password_change",
    'uses' => 'Profiles\ProfileController@changePassword'
]);


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/page', function () {
    return view('page');
});



Route::get( '/logout', [
    'as' => 'logout',
    'uses' => 'HomeController@logout',
] );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->middleware('auth', 'admin_auth')->group( function () {

    Route::get('/',[
        'as'=>'admin.index',
        'uses'=>'Admin\IndexController@index'
    ]);


    Route::resource('/users', 'Admin\Users\UserController');

    Route::resource('/adminplaces', 'Admin\Places\PlaceController');

    Route::resource('/categories', 'Admin\Categories\CategoryController');

    Route::post('/moderate/places/{id}/',[
        'as'=>'moderate.places',
        'uses'=>'Admin\Places\PlaceController@moderate',
    ]);

    Route::get('/setcreator', function () {
        return Abort(404);
    });

    Route::post('/setcreator',[
        'uses'=>'Admin\Users\UserController@setCreator',
    ]);

    Route::get('/setadmin', function () {
        return Abort(404);
    });

    Route::post('/setadmin',[
        'uses'=>'Admin\Users\UserController@setAdmin',
    ]);









});



