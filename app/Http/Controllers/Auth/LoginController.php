<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function facebookRedirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function facebookHandleProviderCallback()
    {
        $FBUser = Socialite::driver('facebook')->user();

        $findFBUser = User::where('email', $FBUser->email)
            ->where('is_what', '1')
            ->where('name', $FBUser->name)
            ->first();

        // echo $findFBUser;

        if ($findFBUser) {
            Auth::login($findFBUser);
            return redirect('/');
        }else{
            $user = new User;
            $user->name = $FBUser->name;
            $user->email = $FBUser->email;
            $user->password = bcrypt('qwerty');
            $user->avatar = $FBUser->avatar;
            $user->is_what = 1;
            $user->save();
            Auth::login($user);
            return redirect('/');
        }
    }




    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function googleRedirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function googleHandleProviderCallback()
    {
        $GUser = Socialite::driver('google')->stateless()->user();

        $findGUser = User::where('email', $GUser->email)
            ->where('is_what', '0')
            ->where('name', $GUser->name)
            ->first();

        // echo $findGUser;

        if ($findGUser) {
            Auth::login($findGUser);
            return redirect('/');
        }else{
            $user = new User;
            $user->name = $GUser->name;
            $user->email = $GUser->email;
            $user->password = bcrypt('qwerty');
            $user->avatar = $GUser->avatar;
            $user->is_what = 0;
            $user->save();
            Auth::login($user);
            return redirect('/');
        }
    }
}

