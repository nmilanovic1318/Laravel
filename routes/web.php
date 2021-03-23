<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes(['verify' => true]);

// USER / CRUD ROUTES
Route::get('/users/{user}/edit', 'UserController@edit')->middleware(['auth', 'password.confirm'])->name('editProfile');
Route::put('/users/{user}/edit', 'UserController@update');
Route::delete('/users/{user}/edit', 'UserController@delete')->middleware(['auth', 'password.confirm']);
Route::get('/users/{user}', 'UserController@profilePage')->name('profilePage');
Route::get('/userimage/{filename}', 'UserController@getUserImage')->name('account.image');

// USER / FRIEND ROUTES
Route::get('/my-friends', 'UserController@browseFriends')->middleware(['auth']);;
Route::get('/blocked-users', 'UserController@blockedUsers');
Route::get('/add-friends', 'UserController@addFriends');
Route::get('addFriend/{id}', 'UserController@getAddFriend')->name('addFriend');
Route::get('blockUser/{id}', 'FriendUserController@blockUser')->name('blockUser');
Route::get('unblockFriend/{id}', 'FriendUserController@unblockUser')->name('unblockUser');
Route::get('deleteFriend/{id}', 'UserController@getDeleteFriend')->name('deleteFriend');
Route::post('/search-users', 'UserController@searchUsers')->name('searchUsers');

// POST ROUTES
Route::post('/makePost', 'PostController@makePost');
Route::post('/search-posts', 'PostController@searchPosts')->name('searchPosts');
Route::delete('/deletePost/{post}', 'PostController@deletePost')->name('deletePost');
Route::get('/my-posts', 'PostController@myPosts')->name('myPosts');
Route::post('/like-posts/{post}', 'PostController@likePost')->name('likePosts');

// FAN PAGE ROUTES
Route::get('/create-fan-page', 'FanPageController@index');
Route::post('/create-fan-page', 'FanPageController@makeFanPage');
Route::get('/fan-pages', 'FanPageController@show')->name('showFanPages');
Route::get('/fan-pages/{fanPage}', 'FanPageController@pageProfile')->name('pageProfile');
Route::post('/like-fan-page/{fanPage}', 'FanPageController@likeFanPage')->name('likeFanPage');
Route::post('/makeFanPost/{fanPage}', 'FanPageController@makeFanPost')->name('makeFanPost');

// HOME ROUTES
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home')->middleware(['verified', 'auth']);

// AD ROUTES
Route::get('/ads-index', 'AdController@index');
Route::post('/create-ad', 'AdController@createAd');
Route::get('/show-ads', 'AdController@showAd');








