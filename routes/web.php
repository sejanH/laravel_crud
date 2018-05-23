<?php

Route::get('/{pages?}', 'Show@pages');
Route::post('create','BlogController@store');
Route::post('signup','Auth\RegisterController@store');
Route::post('login','Auth\LoginController@login');
Route::get('Auth/logout','Auth\LoginController@logout');

Route::get('/post/{id}',['uses' => 'Show@posts']);
Route::post('/post/comment/{id}',[
		'uses'	=> 'BlogController@comment',
		'as'	=> 'post.comment'
		]);
Route::get('/post/{id}/click',['uses' => 'BlogController@clicked']);
Route::get('post/like/{id}',['uses' => 'BlogController@like']);
Route::get('post/dislike/{id}',['uses' => 'BlogController@dislike']);

Route::any('/search/{query?}',['uses'	=> 'Show@search'	]);
Route::get('post/edit/{post_id?}','Show@UpdatePostById');
Route::post('post/update/{post_id?}',[
		'uses' => 'BlogController@update',
		'as' => 'post.update'
		]);
Route::any('post/delete/{post_id?}',[
		'uses' => 'BlogController@destroy',
		'as' => 'post.delete'
		]);
Route::get('/profile/{username?}','Profile@show');
Route::post('/profile/{username?}/upload','Profile@upload');
// Route::get();
Route::group(['prefix'=>'chat', 'as'=>'chat.'],function(){
	Route::get('/list',['as' => 'index','uses' => 'Chat@showAll']);
	Route::get('/{user}','Chat@showOne');
	
});
Route::post('chat/send/{participants?}',[
								'uses' => 'Chat@sendMsg',
								'as'	=> 'chat.send'
							]);