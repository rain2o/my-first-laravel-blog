@extends('templates.main')
@section('content')

    @if(Session::has('success_message'))
        <div data-alert class="alert-box success radius">
            {{Session::get('success_message')}} 
        </div>
    @endif
    
    @foreach ($posts as $post)
        <div class="span8">
            <h1><a href="{{ URL::to('posts/'.$post->id) }}">{{ $post->title }}</a></h1>
            <p>{{ str_limit($post->content, $limit = 255, $end = '...') }}</p>
            <span class="badge badge-success">
                <?php $author = User::find($post->author)->username ?>
                Posted by <a href="{{ URL::to('author/'.$author) }}">{{$author}}</a>
                    on {{ date("m/d/Y \a\\t h:i A",strtotime($post->updated_at)) }}
            </span>
            @if ( !Auth::guest() && Auth::user()->id==$post->author )
                {{ Form::open(array('url' => 'post/'.$post->id)) }}
                    <p>{{ Form::submit('Delete', array('class' => 'button tiny alert')) }}</p>
                {{ Form::close() }}
            @endif
            <hr />
        </div><!-/.span8->
    @endforeach
@endsection

@section('pagination')
    <div class="row">
        <div class="pagination-centered">
            {{ $posts -> links(); }}
        </div>
    </div>
@endsection