<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
	Route::filter('check', function()
	{
			// Session::forget('user');
			 	// var_dump(Session::all()); exit();
		Session::put('group-count-news',Groups::countNews());
		Session::put('service-count-news',Services::countNews());
		Session::put('post-count-news',Postss::countNews());
		
		if(Session::has('user')){
			$user = Session::get('user');
			Session::put('my-groups',GroupMembers::myGroups($user['id']));
			Session::put('join-groups',GroupMembers::joinGroups($user['id']));
			Session::put('like-services',MemberActions::likeServices($user['id']));
		};
	});

	Route::group(array('before' => 'check'), function()
	{
	    Route::controller('design', 'DesignController');
	    Route::get('/','ListController@index');    
	    Route::get('/group-news','ListController@groupNews');    
	    Route::get('/service-news','ListController@serviceNews');    
	    Route::get('/post-news','ListController@postNews');    
	    Route::get('/group/{id}','DetailController@group');  
	    Route::get('/service/{id}','DetailController@service');  
	    Route::get('/posts/{pId}','DetailController@posts');  
	});

	Route::controller('ajax','AjaxController');
   
// end design