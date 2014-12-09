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
Route::get('/', function($user=null){
    $posts = Post::with('user')->orderBy('updated_at','desc')->paginate(5);
	return View::make('home')->with('posts', $posts);
});

// return posts for specified user
Route::get('author/{username}', function($username){
    $userid = User::where('username', '=', $username)->first()->id;
    $posts = Post::where('author', '=', $userid)->orderBy('updated_at','desc')->paginate(5);
    return View::make('home')->with('posts', $posts);
});

// redirect logged in user to create new post
Route::get('admin', array('before' => 'auth', 'do' => function($id=null){
    $user = Auth::user();
    return View::make('new')->with('user', $user);
}));

// handle new post submission
Route::post('admin', function(){

    $new_post = array(
        'title' => Input::get('post_title'),
        'content' => Input::get('post_body'),
        'author' => Input::get('post_author')
        );
    $rules = array(
        'title' => 'required|min:3|max:255',
        'content' => 'required|min:10'
        );
    $validation = Validator::make($new_post, $rules);
    if ( $validation -> fails() ) {
        return Redirect::to('admin')
                ->with('user', Auth::user())
                ->withErrors($validation)
                ->withInput();
    }

    // create the new post after passing validation
    $post = new Post($new_post);
    $post->save();
    // redirect to viewing all posts
    return Redirect::to('/')->with('success_message', 'Your post has been created!');
});

// display single blog post
Route::get('posts/{id}', function($id){
    $post = Post::where('id', '=', $id)->first();
    $comments = Comment::where('post_id', '=', $id)->get();
    $post->comments = $comments;
    return View::make('post')->with('post', $post);
});

// display login form
Route::get('login', function(){
    return View::make('login');
});

// process login
Route::post('login', array('uses' => 'UserController@processLogin'));

// logout
Route::get('logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

// display user registration
Route::get('signup', function(){
    return View::make('signup');
});

// process user registration (pending)
Route::post('signup', array('uses' => 'UserController@storeUser'));

// activate new user
Route::get('register/verify/{confirmation_code?}', array('uses' => 'UserController@activateUser'));

// post comment
Route::post('comment/{id}', array('post' => 'id', 'as' => 'comment.new', 'uses' => 'HomeController@newComment'));

// delete comment
Route::post('comment/delete/{id}', function($id){
    $delete_comment = Comment::find($id);
    $delete_comment -> delete();
    return Redirect::to(URL::previous())->with('success_message', 'Commented has been deleted!');
});

// delete post
Route::post('post/{num}', function($id=null) {
//Route::delete('post/{num}', function($id){
    $delete_post = Post::with('user')->find($id);
    $delete_post -> delete();
    return Redirect::to('/')->with('success_message', 'Post deleted!');
})->where('num', '[0-999]+');

// xml feed
Route::get('feed', array('uses' => 'HomeController@getFeed'));

// author specific feed
Route::get('author/feed/{user}', array('uses' => 'HomeController@getFeed'));