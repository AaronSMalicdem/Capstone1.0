<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
{
    // Check the user's role and redirect accordingly
    if ($user->role->name === 'admin') {
        return redirect('/admin/dashboard');
    }

    if ($user->role->name === 'kuwago_manager') {
        return redirect('/kuwago/dashboard');
    }

    if ($user->role->name === 'uddesign_manager') {
        return redirect('/uddesign/dashboard');
    }

    if ($user->role->name === 'finance_officer') {
        return redirect('/finance/dashboard');
    }

    // Default fallback for any other roles
    return redirect('/home');
}

}
