<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function register(){
        return view('register');
    }
    public function loginProcess(Request $request){
        $data = $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);
        
        if(Auth::guard('admin')->attempt($data)){
            $request->session()->regenerate();
            session()->flash('message','You have successfully logged in!');
            return redirect()->route('dashboard');
                
        }
        return back()->withErrors(['email'=>'Credentials does not match to our records!'])->onlyInput('email');
    }
    public function logout(){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect()->route('login');
        }
    }
}
