<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // use AuthenticatesUsers;
    // protected $redirectTo = RouteServiceProvider::HOME;

    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm($type)
    {
        return view('auth.login', compact('type'));
    }

    public function login(Request $request)
    {
        if (Auth::guard($this->checkGaurd($request))->attempt([
            'email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }
        else {
            return redirect()->back()->with('message','البريد الالكتروني او كلمة السر غير صحيح');
        }
    }

    public function logout(Request $request, string $type)
    {
        Auth::guard($type)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();;
        return redirect('/');
    }
}







