@extends('templates.main')
@section('content')

    @if(Session::has('success_message'))
        <div data-alert class="alert-box success radius">
            {{Session::get('success_message')}} 
        </div>
    @endif
    
    <div class="row">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <span>
            <?php $author = User::find($post->author)->username ?>
            Posted by <a href="{{ URL::to('author/'.$author) }}">{{$author}}</a>
                on {{ date("m/d/Y \a\\t h:i A",strtotime($post->updated_at)) }}</span>
                <br />
            <a href="{{ URL::to('author/feed/'.$post->author) }}"><img src="/assets/images/rss1.png" width="25px" /> Author's Feed</a>

        @if ( !Auth::guest() && Auth::user()->id==$post->author )
            {{ Form::open(array('url' => 'post/'.$post->id)) }}
                <p>{{ Form::submit('Delete', array('class' => 'button tiny alert')) }}</p>
            {{ Form::close() }}
        @endif
        <hr />
    </div><!-/.row ->
    
    <div class="row">
        <h2>Comments</h2>
        @foreach ($post->comments as $comment)
            <div class="columns large-10 large-centered">
                by <strong>{{ $comment->commenter }}</strong> on {{ date("m/d/Y \a\\t h:i A",strtotime($comment->created_at)) }} 
                <div class="panel callout radius">{{ $comment->comment }}</div>
                @if ( !Auth::guest() && Auth::user()->name==$comment->commenter )
                    {{ Form::open(array('url' => 'comment/delete/'.$comment->id)) }}
                        <p>{{ Form::submit('Delete', array('class' => 'button tiny alert')) }}</p>
                    {{ Form::close() }}
                @endif
                <hr />
            </div><!-/.columns->
            <br />
        @endforeach
        
        <div class="columns large-10 large-centered" id="reply">
            @if (!Auth::guest())
                <h3>Post a new comment</h3>
                {{ Form::open(array('url' => 'comment/'.$post->id)) }}
                    {{ Form::hidden('commenter', Auth::user()->name) }}
                    <div class="large-8 large-centered columns">

                        @if(Session::has('message'))
                            <div data-alert class="alert-box alert radius">
                                {{Session::get('message')}} 
                            </div>
                        @endif
                        
                        <p>{{ Form::label('comment', 'Your Comment') }}</p>
                        @if ($errors->has('comment'))
                            <div data-alert class="alert-box alert radius">{{ $errors->first('comment') }}</div>
                        @endif
                        {{ $errors->first('comment') }}</p>
                        <p>{{ Form::textarea('comment', Input::old('comment')) }}</p>
                        
                        <!-- submit form -->
                        <div class="row">
                            <div class="large-12 columns">{{ Form::submit('Comment', array('class' => 'button')) }}</div>
                        </div>
                    </div>
                {{ Form::close() }}
            @else
                <div>You must be logged in to post comments. If you have an account <a href="{{ URL::to('login') }}">login</a> now to comment!</div>
            @endif
        </div><!-/.columns large-10 large-centered->
        
    </div><!-/.row->
    
@endsection