@extends('templates.main')
@section('content')
    <div class="row">
        {{ Form::open(array('url' => 'signup')) }}
          <div class="small-5 small-centered columns">

            @if(Session::has('message'))
                <div data-alert class="alert-box alert radius">
                    {{Session::get('message')}} 
                </div>
            @endif
            
            <!-- name field -->
            <div class="row">
                @if ($errors->has('name'))
                    <div data-alert class="alert-box alert radius">{{ $errors->first('name') }}</div>
                @endif
                <div class="large-3 columns">{{ Form::label('name', 'Name', array('class' => 'right inline')) }}</div>
                <div class="large-9 columns">{{ Form::text('name') }}</div>
            </div>
            
            <!-- email field -->
            <div class="row">
                @if ($errors->has('email'))
                    <div data-alert class="alert-box alert radius">{{ $errors->first('email') }}</div>
                @endif
                <div class="large-3 columns">{{ Form::label('email', 'Email', array('class' => 'right inline')) }}</div>
                <div class="large-9 columns">{{ Form::email('email') }}</div>
            </div>
            
            <!-- username field -->
            <div class="row">
                @if ($errors->has('username'))
                    <div data-alert class="alert-box alert radius">{{ $errors->first('username') }}</div>
                @endif
                <div class="large-3 columns">{{ Form::label('username', 'Username', array('class' => 'right inline')) }}</div>
                <div class="large-9 columns">{{ Form::text('username') }}</div>
            </div>
            
            <!-- password field -->
            <div class="row">
                @if ($errors->has('password'))
                    <div data-alert class="alert-box alert radius">{{ $errors->first('password') }}</div>
                @endif
                <div class="large-3 columns">{{ Form::label('password', 'Password', array('class' => 'right inline')) }}</div>
                <div class="large-9 columns">{{ Form::password('password', array('class' => 'inline')) }}</div>
            </div>
            
            <!-- password field -->
            <div class="row">
                @if ($errors->has('password_confirmation'))
                    <div data-alert class="alert-box alert radius">{{ $errors->first('password_confirmation') }}</div>
                @endif
                <div class="large-3 columns">{{ Form::label('password_confirmation', 'Password Confirmation', array('class' => 'right inline')) }}</div>
                <div class="large-9 columns">{{ Form::password('password_confirmation', array('class' => 'inline')) }}</div>
            </div>
            
            <!-- submit form -->
            <div class="row">
                <div class="large-12 columns">{{ Form::submit('Login', array('class' => 'button')) }}</div>
          </div>
        {{ Form::close() }}
    </div>
@endsection