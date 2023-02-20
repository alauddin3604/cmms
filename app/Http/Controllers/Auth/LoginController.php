<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:supervisor')->except('logout');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($request->role == 'admin') {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended('/admin/dashboard');
            }
        } else if ($request->role == 'supervisor') {
            if (Auth::guard('supervisor')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // return redirect()->intended('/supervisor/dashboard');
                return response()->json([
                    'success' => true
                ]);
            }
        }
        return back()->withInput($request->only('email'))->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);;
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('supervisor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
