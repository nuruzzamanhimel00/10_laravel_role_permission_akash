<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

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
        return view('backend.auth.login');
    }

    public function login(Request $request){

        //validate login
        $this->validateLogin($request);

        //attempt login
        if($this->attemptedLogin($request) ){
            session()->flash('success','login successfully');
            return redirect()->intended(route('admin.dashboard'));
        }else{
            session()->flash('error','Email or password is invalided');
            return redirect()->back();
        }

    }

    protected function attemptedLogin($request){
        $credentials = $request->only($this->username(),'password');
        return $this->guard()->attempt($credentials, $request->remember) ;
    }
    public function username(){
        return 'email';
    }

    public function validateLogin($request){
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);
    }

    protected function guard(){
        return Auth::guard('admin');
    }

}
