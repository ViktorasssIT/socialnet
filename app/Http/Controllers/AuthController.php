<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /* Return view to sign up form */

    public function getSignup()
    {
        return view('auth.signup');
    }

    /* Required info before signing up, creating a user and redirecting to home page */

    public function postSignup(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|unique:users|email|max:255',
           'username' => 'required|unique:users|alpha_dash|max:20',
           'password' => 'required|min:6',
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()
            ->route('home')
            ->with('info', 'Your account has been created and you can now sign in.');
    }

    /* Return view to sign in form */

    public function getSignin()
    {
        return view('auth.signin');
    }

    /* Required info before signing in and redirecting to home page on successful sign in, if not,
    info with a alert */

    public function postSignin(Request $request)
    {
        $this->validate($request, [
           'email' => 'required',
           'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->back()->with('info', 'Could not sign you in with those details.');
        }

        return redirect()->route('home')->with('info', 'You are now signed in.');
    }

    /* Sign out */

    public function getSignout()
    {
        Auth::logout();

        return redirect()->route('home')->with('info', 'You have signed out.');
    }
}
