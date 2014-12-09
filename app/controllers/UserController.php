<?php

use Illuminate\Support\Facades\Input;

class UserController extends BaseController {

    // process login attempt
    public function processLogin() {
        // validate info
        $rules = array(
            'username' => 'required',
            'password' => 'required'
            );
        
        // run validation
        $validator = Validator::make(Input::all(), $rules);
        
        // if validation failed, reload form with errors
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // passed validation, now attempt login
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'active' => 1
                );
            if (Auth::attempt($userdata)) {
                // success! 
                return Redirect::to('admin');
            } else {
                //login failed!!!
                if (User::where('username', '=', Input::get('username'))->first()->active==0) {
                    $message = 'Account not active yet!';
                } else {
                    $message = 'Username or password incorrect';
                }
                return Redirect::to('login')->with('message', $message)->withInput(Input::except('password'));
            }
        }
    }
    
    // save new user_error
    public function storeUser() {
        $rules = [
            'username' => 'required|min:5|unique:users',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:5'
        ];
        
        $input = Input::only(
            'username',
            'name',
            'email', 
            'password',
            'password_confirmation'
        );
        
        $validator = Validator::make($input, $rules);
        
        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $confirmation_code = str_random(25);
        
        User::create([
            'username' => Input::get('username'),
            'name' => Input::get('name'),
            'password' => Hash::make(Input::get('password')),
            'confirmation_code' => $confirmation_code
        ]);
        
        Mail::send('emails.verify', array('confirmation_code' => $confirmation_code), function($message) {
            $message->to(Input::get('email'), Input::get('name'))
                ->from('admin@rain2odesigns.com', 'Rain2o Admin')
                ->subject('Verify your email address');
        });
        
        return Redirect::to('/')->with('success_message', 'Thanks for signing up! Please check your email to validate your account');
    }
    
    public function activateUser($confirmation_code=null){
        if ( !$confirmation_code ) {
            return Redirect::to('login')->with('message', 'No confirmation code provided!');
        }
        
        $user = User::whereConfirmationCode($confirmation_code)->first();
        
        if ( !$user ) {
            return Redirect::to('signup')->with('message', 'Invalid confirmation code provided!');
        }
        
        $user->active = 1;
        $user->confirmation_code = null;
        $user->save();
        
        return Redirect::to('login')->with('success_message', 'Your account has been activated!');
    }
}
