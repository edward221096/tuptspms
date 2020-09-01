<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    use AuthenticatesUsers; //normal logout

//    use AuthenticatesUsers{
//        logout as performLogout;
//    }
//
//    public function logout(Request $request){
//        $url='https://docs.google.com/forms/d/e/1FAIpQLSdlaG6t1LwNIegypZlSjWpst-___ui4Zp-bQoQPbThTHtrFTA/viewform';
//        $this->performLogout($request);
//        return redirect()->away($url);
//    }

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

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
//        , 'status'=>'Account Approved'
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('login')
                ->with('error','Invalid credentials or wait for the account approval from Administrator!');
        }
    }
}
