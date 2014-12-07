@extends('templates.main')
@section('content')
    <div class="row">
        <h2>Create new post</h2>
        <hr />
        {{ Form::open(array('url' => 'admin')) }}
            {{ Form::hidden('post_author', $user->id) }}
            
            @if(Session::has('message'))
                <div data-alert class="alert-box alert radius">
                    {{Session::get('message')}} 
                </div>
            @endif

            @if($errors->has())
                @foreach ($errors->all() as $error)
                    <div data-alert class="alert-box alert radius">{{ $error }}</div>
                @endforeach
            @endif
            
            <!-- title field -->
            <div class="row">
            <p>{{ Form::label('post_title', 'Post Title') }}</p>
            {{ $errors->first('post_title') }}
            <p>{{ Form::text('post_title', Input::old('post_title')) }}</p>
            </div>
            
            <!-- content (body) field -->
            <div class="row">
            <p>{{ Form::label('post_body', 'Post Body') }}</p>
            {{ $errors->first('post_body') }}</p>
            <p>{{ Form::textarea('post_body', Input::old('post_body')) }}</p>
            </div>
            
            <!-- submit button -->
            <div class="row">{{ Form::submit('Create', array('class' => 'button')) }}</div>
        {{ Form::close() }}
    </div><!-/.span8->
@endsection