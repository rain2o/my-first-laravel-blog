@extends('templates.main')
@section('content')

    @if(Session::has('success_message'))
        <div data-alert class="alert-box success radius">
            {{Session::get('success_message')}} 
        </div>
    @endif
    
    @foreach ($posts as $post)
        <div class="span8">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->content }}</p>
            <span class="badge badge-success">Posted {{$post->updated_at}}</span>
            @if ( !Auth::guest() )
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