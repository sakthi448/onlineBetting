<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role_id = Auth::user()->role_id;
            // session(['user_data' => $user]);

            if($role_id == 1){
                return view('admin');
            }else{
                return redirect()->route('wallet.show');
            }
        }

        return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}
