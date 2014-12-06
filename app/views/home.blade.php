@layout('templates.main')
@section('content')
    @if ( Session::has('success_message') )
        <div class="span8">
            {{ Alert::success("Success! Post deleted!") }}
        </div>
    @endif
    
    @foreach ($posts -> results as $post)
        <div class="span8">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->content }}</p>
            <span class="badge badge-success">Posted {{$post->updated_at}}</span>
            @if ( !Auth::guest() )
                {{ Form::open('post/'.$post->id, 'DELETE') }}
                    <p>{{ Form::submit('Delete', array('class' => 'btn-small')) }}</p>
                {{ Form::close() }}
            @endif
            <hr />
        </div><!-/.span8->
    @endforeach
@endsection

@section('pagination')
    <div class="row">
        <div class="span8">
            {{ $posts -> links(); }}
        </div>
    </div>
@endsection