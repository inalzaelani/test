<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function PostLogin(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return view('dashboard');
        }
        return redirect('/');
    }

    public function PostLogout(Request $request)
    {

        Auth::logout();
        return redirect('/');
    }

    public function Dashboard()
    {
        return view('dashboard');
    }
}
