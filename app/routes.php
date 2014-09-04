<?php

# ------------------ Route patterns---------------------
Route::pattern('id', '[0-9]+');

# ------------------ Page Route ------------------------

Route::get('/', [
    'as' => 'home',
    'uses'=>'PagesController@home'
]);

Route::get('/about', [
    'as' => 'about',
    'uses' => 'PagesController@about'
]);

Route::get('/wiki', [
	'as' => 'wiki',
	'uses' => 'PagesController@wiki'
]);

Route::get('/search', [
	'as' => 'search',
	'uses' => 'PagesController@search'
]);

Route::get('/feed', [
	'as' => 'feed',
	'uses' => 'PagesController@feed'
]);

# ------------------ User stuff ------------------------

Route::get('/users/{id}/replies', [
	'as' => 'users.replies',
	'uses' => 'UsersController@replies'
]);

Route::get('/users/{id}/topics', [
	'as' => 'users.topics',
	'uses' => 'UsersController@topics'
]);

Route::get('/users/{id}/favorites', [
	'as' => 'users.favorites',
	'uses' => 'UsersController@favorites'
]);

Route::get('/favorites/{id}', [
	'as' => 'favorites.createOrDelete',
	'uses' => 'FavoritesController@createOrDelete',
	'before' => 'auth'
]);

Route::get('/notifications', [
    'as' => 'notifications.index',
    'uses' => 'NotificationsController@index',
    'before' => 'auth'
]);

Route::get('/notifications/count', [
	'as' => 'notifications.count',
	'uses' => 'NotificationsController@count',
	'before' => 'auth'
]);

Route::get('/attentions/{id}', [
	'as' => 'attentions.createOrDelete',
	'uses' => 'AttentionsController@createOrDelete',
	'before' => 'auth'
]);

# ------------------ Authentication ------------------------

Route::get('login', [
	'as' => 'login',
	'uses' => 'AuthController@login'
]);

Route::get('login-required', [
	'as' => 'login-required',
	'uses' => 'AuthController@loginRequired'
]);

Route::get('admin-required', [
	'as' => 'admin-required',
	'uses' => 'AuthController@adminRequired'
]);

Route::get('signup', [
	'as' => 'signup',
	'uses' => 'AuthController@create'
]);

Route::post('signup',  [
	'as' => 'signup',
	'uses' => 'AuthController@store'
]);

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'AuthController@logout'
]);

Route::get('oauth', 'AuthController@getOauth');

# ------------------ Resource Route ------------------------

Route::resource('nodes', 'NodesController');
Route::resource('topics', 'TopicsController');
Route::resource('votes', 'VotesController');
Route::resource('users', 'UsersController');

# ------------------ Replies ------------------------

Route::resource('replies', 'RepliesController', ['only' => ['store']]);
Route::get('replies/delete/{id}',  [
	'as' => 'replies.delete',
	'uses' => 'RepliesController@delete',
	'before' => 'auth'
]);

# ------------------ Votes ------------------------

Route::group(['before' => 'auth'], function(){
	Route::get('/topics/{id}/upvote', [
		'as' => 'topics.upvote',
		'uses' => 'TopicsController@upvote',
	]);

	Route::get('/topics/{id}/downvote', [
		'as' => 'topics.downvote',
		'uses' => 'TopicsController@downvote',
	]);

	Route::get('/replies/{id}/vote', [
		'as' => 'replies.vote',
		'uses' => 'RepliesController@vote',
	]);
});

# ------------------ Admin Route ------------------------

Route::group(['before' => 'manage_topics'], function(){
	Route::get('topics/recomend/{id}',  [
		'as' => 'topics.recomend',
		'uses' => 'TopicsController@recomend',
	]);

	Route::get('topics/wiki/{id}',  [
		'as' => 'topics.wiki',
		'uses' => 'TopicsController@wiki',
	]);

	Route::get('topics/pin/{id}',  [
		'as' => 'topics.pin',
		'uses' => 'TopicsController@pin',
	]);

	Route::get('topics/delete/{id}',  [
		'as' => 'topics.delete',
		'uses' => 'TopicsController@delete',
	]);
});
