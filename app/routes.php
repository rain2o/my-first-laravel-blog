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

// show home page listing posts
Route::get('/', function(){
    $posts = Post::with('user')->order_by('updated_at','desc')->paginate(5);
	return View::make('home')->with('posts', $posts);
});

// redirect logged in user to create new post
Route::get('admin', array('before' => 'auth', 'do' => function($id){
    $user = Auth::user();
    return View::make('new')->with('user', $user);
}));

// handle new post submission
Route::post('admin', array('before' => 'auth', 'do' => function(){
    $new_post = array(
        'title' => Input::get('post_title'),
        'content' => Input::get('post_body'),
        'author' => Input:get('post_author')
        );
    $rules = array(
        'title' => 'required|min:3|max:255',
        'content' => 'required|min:10'
        );
    $validation = Validator::make($new_post, $rules);
    if ( $validation -> fails() ) {
        return Redirect::to('admin')
                ->with('user', Auth:user())
                ->with_errors($validation)
                ->with_input();
}));

// login form
Route::get('login', function(){
    return View::make('login');
});

// login
Route::post('login', function(){
    $userinfo = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
        );
    if ( Auth::attempt($userinfo) ) {
        return Redirect::to('admin');
    }
    else {
        return Redirect::to('login')->with('login_errors', true);
    }
});

// logout
Route::get('logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

// post comment
Route::post('comment', function(){

});

// delete comment
Route::delete('comment' function(){

});

// delete post
Route::delete('post/(:num)', array('before' => 'auth', 'do' => function($id){
    $delete_post = Post::with('user')->find($id);
    $delete_post -> delete();
    return Redirect::to('/')->with('success_message', true);
}));