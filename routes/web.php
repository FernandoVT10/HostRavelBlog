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

Route::get('/', "HomeController") -> name("home");

Route::resource('articles', 'ArticleController');
Route::post('articles/uploadImage', 'ArticleController@uploadImage');

Auth::routes(['verify' => true]);

Route::get('close-session', "Auth\CloseSessionController") -> name("close-session");

Route::middleware(['verified'])->group(function () {
    Route::resource('comments', 'CommentController')->except([
        'index', 'create', 'show', 'edit'
    ]);
    
    Route::get("/like/{commentId}", "LikeController");
    
    // Profile

    Route::get("profile/edit-profile", "ProfileController@editProfile") -> name("edit-profile");
    Route::get("profile/change-avatar", "ProfileController@changeAvatar") -> name("change-avatar");
    Route::get("profile/change-password", "ProfileController@changePassword")
            -> name("change-password");

    Route::post("profile/update-profile", "ProfileController@updateProfile")
        -> name("update-profile");
    Route::post("profile/update-avatar", "ProfileController@updateAvatar")
    -> name("update-avatar");
    Route::post("profile/update-password", "ProfileController@updatePassword")
    -> name("update-password");
});

Route::resource('users', 'UserController')->except(['create', 'store', 'show']);