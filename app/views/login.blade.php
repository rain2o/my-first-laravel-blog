@extends('templates.main')
@section('content')
    <div class="row">
        {{ Form::open(array('url' => 'login')) }}
          <div class="small-5 small-centered columns">
            <!-- check for login errors flash var -->
            @if(Session::has('message'))
                <div data-alert class="alert-box alert radius">
                    {{Session::get('message')}} 
                </div>
            @endif
            
            <!-- username field -->
            <div class="row">
                <div class="large-3 columns">{{ Form::label('username', 'Username', array('class' => 'right inline')) }}</div>
                <div class="large-9 columns">{{ Form::text('username') }}</div>
            </div>
            
            <!-- password field -->
            <div class="row">
                <div class="large-3 columns">{{ Form::label('password', 'Password', array('class' => 'right inline')) }}</div>
                <div class="large-9 columns">{{ Form::password('password', array('class' => 'inline')) }}</div>
            </div>
            
            <!-- submit form -->
            <div class="row">
                <div class="large-12 columns">{{ Form::submit('Login', array('class' => 'button')) }}</div>
          </div>
        {{ Form::close() }}
    </div>
@endsection