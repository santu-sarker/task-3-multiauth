<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function user_login(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Enter your email address to login.',
            'email.email' => 'Invalid email address provided!',
            'password.required' => 'password required to login.',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $remember_me = $req->has('remember') ? true : false;
        $check = $req->only('email', 'password');

        /**
         * checking if requested login req is a admin one or not
         */

        // trying to login
        if (auth()->guard('admin')->attempt($check, $remember_me)) {
            $req->session()->regenerate();
            return redirect()->route('admin.home');
        } elseif (auth()->guard('web')->attempt($check, $remember_me)) {
            $req->session()->regenerate();
            return redirect()->route('user.home');
        } else {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }
    public function logout(Request $req)
    {
        auth()->logout();
        $req->session()->flush();
        return redirect()->route('login');
    }
}
