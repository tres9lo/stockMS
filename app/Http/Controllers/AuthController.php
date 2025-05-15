<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function ShowLoginForm()
    {
        return view('auth.login');
    }
    public function ShowRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'password'=>'required',
        ]);
        User::create([
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Registration Successful!');

    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name'=>'required',
            'password'=>'required',
        
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login Successful!');
        }
        return back()->withErrors([
            'name'=>'Credentials do not match!',
            'password'=>'Credentials do not match!',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout Successful!');
    }
    public function dashboard()
    {
        $totalProducts = \App\Models\Product::count();
        $totalUsers = \App\Models\User::count();
        $recentActivities = ['User A added a product', 'User B updated a product']; // Example activities

        return view('dashboard', compact('totalProducts', 'totalUsers', 'recentActivities'));
    }
}
