<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

    public function newComment($post) {
        $comment = [
            'commenter' => Input::get('commenter'),
            'comment' => Input::get('comment'),
        ];
        $rules = [
            'commenter' => 'required',
            'comment' => 'required',
        ];
        $valid = Validator::make($comment, $rules);
        if($valid->passes())
        {
            $comment = new Comment($comment);
            $comment->approved = true;
            $comment->post_id = $post;
            $comment->save();
            $comment->post->comment_count = Comment::where('post_id', '=', $comment->post->id)
                ->where('approved', '=', 1)
                ->count();
            $comment->post->save();
            return Redirect::to(URL::previous())
                    ->with('success_message','Comment has been submitted!');
        }
        else
        {
            return Redirect::to(URL::previous().'#reply')->withErrors($valid)->withInput();
        }
    }
    
    public function getFeed($user=null) {
    if ($user) {
        $posts = Post::where('author', '=', $user)
                    ->orderBy('updated_at', 'desc')
                    ->take(10)
                    ->get();
        $author = User::find($user)->username;
        $description = $author."'s ten most recent posts.";
    } else {
        $posts = Post::with('user')
                    ->orderBy('updated_at', 'desc')
                    ->take(10)
                    ->get();
        $description = 'Ten most recent posts from my blog.';
    }
    $feed = Feed::make();
    $feed->pubdate(time())
        ->title('My RSS Feed')
        ->description($description)
        ->language('en');

    foreach ($posts as $post) {
        $feed->entry()
                ->author(User::where('id', '=', $post['author'])->first()->name)
                ->title($post['title'])
                ->published($post['created_at'])
                ->updated($post['updated_at'])
                ->content($post['content']);
    }

    $headers['Content-Type'] = 'application/xml';
    return Response::make($feed->build('atom'), 200, $headers);
    }

}
