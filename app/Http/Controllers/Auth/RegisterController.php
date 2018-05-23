<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $req)
    {

    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'username' => 'required|string|max:25|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|unique:users',
                'securityQA' => 'required|string',
            ],
            [
                'securityQA.required' => 'Please provide the Security Question Answer',
            ]
        );

        if($validate->fails()){
             return redirect('home')
                        ->withErrors($validate)
                        ->withInput();
        }else{
            User::create([
                'username' => $request->username,
                'timezone' => $request->timezone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'securityQA' => $request->securityQA,
            ]);
    
            $request->session()->flash('success','You\'ve been registered successfully');
            return redirect('home');
        }
    }
}
