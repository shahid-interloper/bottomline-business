<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // $data['banner'] = Banner::where('page_id', 8)->where('is_active', 1)->first(); //8 = login
        return view('auth.login');
    }

    public function adminLogin()
    {
        return view('backend.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
            if (Auth::check() and (Auth::user()->is_active == 1)) {
                return redirect()->route('front.register.step1');
            } else {
                Auth::logout();
                $data['message'] = 'Record Not Found!, Please Try Again!';
                $data['type'] = "danger";
                return redirect()->back()->with($data);
            }
        } else {
            $data['type'] = "danger";
            $data['message'] = 'Invalid Credentials, Please Try Again!';
            return redirect()->back()->with($data);
        }
    }

    /**
     * Handle Social login request
     *
     * @return response
     */
    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $social_user = Socialite::driver($provider)->user();

            // First Find Social Account
            $account = SocialAccount::where([
                'provider_name' => $provider,
                'provider_id' => $social_user->getId(),
                'avatar' => $social_user->getAvatar()
            ])->first();

            // If Social Account Exist then Find User and Login
            if ($account) {
                auth()->login($account->user);
                return redirect()->intended();
            }

            // Find User
            $user = User::where([
                'email' => $social_user->getEmail()
            ])->first();

            // If User not get then create new user
            if (!$user) {
                $userName = explode(' ', $social_user->getName());
                $user = User::create([
                    'email' => $social_user->getEmail(),
                    'first_name' => $userName[0] ?? '',
                    'last_name' => $userName[1] ?? ''
                ]);
            }

            // Create Social Accounts
            $user->socialAccounts()->create([
                'provider_id' => $social_user->getId(),
                'provider_name' => $provider,
                'avatar' => $social_user->getAvatar()
            ]);

            // Login
            Auth::login($user);
            return redirect()->intended();
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('login');
        }

        // dd($social, $userSocial);
        // $user = User::where(['email' => $userSocial->getEmail()])->first();

        // if ($user) {
        //     Auth::login($user);
        //     return redirect()->intended();
        // } else {
        //     return view('auth.register', ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
        // }
    }
}
