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
            
            <!-- title field -->
            <div class="row">
            <p>{{ Form::label('post_title', 'Post Title') }}</p>
            @if ($errors->has('title'))
                <div data-alert class="alert-box alert radius">{{ $errors->first('title') }}</div>
            @endif
            {{ $errors->first('post_title') }}
            <p>{{ Form::text('post_title', Input::old('post_title')) }}</p>
            </div>
            
            <!-- content (body) field -->
            <div class="row">
            <p>{{ Form::label('post_body', 'Post Body') }}</p>
            @if ($errors->has('content'))
                <div data-alert class="alert-box alert radius">{{ $errors->first('content') }}</div>
            @endif
            {{ $errors->first('post_body') }}</p>
            <p>{{ Form::textarea('post_body', Input::old('post_body')) }}</p>
                <script src="/ckeditor/public/ckeditor.js"></script>
                <script>CKEDITOR.replace('post_body');</script>
            </div>
            
            <!-- submit button -->
            <div class="row">{{ Form::submit('Create', array('class' => 'button')) }}</div>
        {{ Form::close() }}
    </div><!-/.span8->
@endsection