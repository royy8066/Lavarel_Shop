<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function __construct(){

    }

    public function showRegisterForm(){
        return view('frontend.register');
    }

    public function register(Request $request){
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:login,email',
            'password' => 'required|confirmed|min:3',
        ]);

        Login::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('frontend.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    public function showLoginForm(){
        return view('frontend.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            Flasher::addSuccess('Đăng nhập thành công!');
            return redirect()->route('frontend.index');
        }
        Flasher::addError('Email hoặc mật khẩu không chính xác!');
        return redirect()->route('frontend.login');
    }

    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 

        return redirect()->route('frontend.login');
    }
}
