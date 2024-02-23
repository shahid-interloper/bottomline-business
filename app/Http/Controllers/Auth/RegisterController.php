<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function showRegistrationForm()
    {
        return view('auth.register');
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
        ]);
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'company_name'=> 'required',
            'address'     => 'required',
            'first_name'  => 'required|string|min:3|regex:/^\S*$/u',
            'last_name'   => 'nullable|string|min:3|regex:/^\S*$/u',
            'email'       => 'required|string|email|max:50|unique:users',
            'password'    => 'required|string|min:8',
            'phone'       => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ]);
        $user = new User;
        $user->company_name = $request->company_name;
        $user->address      = $request->address;
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->phone_number = $request->phone;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);

        if ($user->save()) {
            $user->assignRole('User');
            Auth::loginUsingId($user->id);
            return redirect()->route('user.dashboard');
        } else {
            $data['type'] = "danger";
            $data['message'] = "Something went wrong, Try again.";
            return redirect()->route('register')->withInput()->with($data);
        }
    }
}
