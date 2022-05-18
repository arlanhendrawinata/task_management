<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Http\Controllers\Admin\LoginLogsController;


class LoginController extends Controller
{
    public function index()
    {
        $title = 'Login';
        return view('auth.login', compact("title"));
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->status == 0) {
                return redirect('/');
            } elseif (auth()->user()->status == 1) {
                $LoginLogsObj = new LoginLogsController;
                $LoginLogsObj->rememberMe(auth()->user()->id);
                if (auth()->user()->userDetail->role == 1) {
                    session()->flash('success', 'Login Successful!');
                    return redirect()->route('dashboard');
                } elseif (auth()->user()->userDetail->role == 2) {
                    session()->flash('success', 'Login Successful!');
                    return redirect()->route('dashboard');
                } elseif (auth()->user()->userDetail->role == 3) {
                    session()->flash('success', 'Login Successful!');
                    return redirect()->route('user-list-task');
                } elseif (auth()->user()->userDetail->role == 4) {
                    session()->flash('success', 'Login Successful!');
                    return redirect()->route('user-list-task');
                }
            }
        } else {
            session()->flash('errors', 'Email or Password you entered is wrong!');
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
