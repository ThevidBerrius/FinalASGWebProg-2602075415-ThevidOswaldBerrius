<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Occupation;

class RegisterController extends Controller
{
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
     * Show the registration form with occupation data.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $occupations = Occupation::all();
        return view('auth.register', compact('occupations'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'occupation_id' => ['required', 'exists:occupations,id'],
            'gender' => ['required', 'in:male,female'],
            'linkedin_username' => [
                'required',
                'regex:/^https:\/\/www\.linkedin\.com\/in\/[a-zA-Z0-9-_]+$/'
            ],
            'phone_number' => ['required', 'regex:/^\d{10,15}$/'],
            'experience_years' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'occupation_id' => $data['occupation_id'],
            'gender' => $data['gender'],
            'linkedin_username' => $data['linkedin_username'],
            'phone_number' => $data['phone_number'],
            'experience_years' => $data['experience_years'],
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $price = rand(100000, 125000);

        session(['registration_fee' => $price]);

        return redirect()->route('auth.payment');
    }
}
