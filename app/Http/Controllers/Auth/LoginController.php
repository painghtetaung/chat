<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Activefriend;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
     * 
     * 
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function authenticated(Request $request, $user)
    {
        // stuff to do after user logs in
        // $activefriend = Activefriend::create([
        //     'activeFriend_id' => auth()->id(),
        // ]);
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        $leavingFriend_id = auth()->id();
        Activefriend::where('activeFriend_id', $leavingFriend_id)->delete();
        Auth::logout();
        return redirect('/');
    }

  
}
