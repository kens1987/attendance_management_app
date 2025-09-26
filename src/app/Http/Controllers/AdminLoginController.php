<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm(){
        return view('admin.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $credentials = array_merge(
            $request->only('email','password'),
            ['role'=>'admin']
        );

        if(Auth::guard('admin')->attempt(
            array_merge($request->only('email','password'),['role'=>'admin'])
        )){
            return redirect()->route('admin.list');
        }
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.show');
    }
}
