<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/payment'; 

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
    public function showRegisterForm()
    {
        $registration_fee = rand(100000, 125000); // Generate random registration fee
        return view('auth.register', compact('registration_fee'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:male,female',
            'fields_of_work' => 'required|array|min:3',
            'linkedin_username' => 'required|url|regex:/^https:\/\/www\.linkedin\.com\/in\/[a-zA-Z0-9-]+$/',
            'mobile_number' => 'required|numeric',
            'registration_fee' => 'required|integer',
        ]);
        try{
            User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender'),
            'fields_of_work' => json_encode($request->input('fields_of_work')),
            'linkedin_username' => $request->input('linkedin_username'),
            'mobile_number' => $request->input('mobile_number'),
            'registration_fee' => $request->input('registration_fee'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Session::put('registration_fee', $request->input('registration_fee')); 

        return redirect()->intended($this->redirectTo); 
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('message', 'Registration failed! Please try again.');
        }
    }

}