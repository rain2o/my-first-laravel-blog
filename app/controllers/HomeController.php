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
                ->withErros($validator)
                ->withInput(Input::except('password'));
        } else {
            // passed validation, now attempt login
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
                );
            if (Auth::attempt($userdata)) {
                // success! 
                return Redirect::to('admin');
            } else {
                //login failed!!!
                return Redirect::to('login')->with('message', 'Username or password incorrect');
            }
        }
    }
}
