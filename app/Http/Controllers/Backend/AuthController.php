<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flasher\Laravel\Facade\Flasher;

class AuthController extends Controller
{
    public function __construct(){

    }

    public function index(){
        if(Auth::id() > 0){
            return redirect()->route('backend.index');
        }
       return view('backend.login');
    }

    public function showLoginForm()
    {
        return view('backend.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            Flasher::addSuccess('Đăng nhập thành công!');
            return redirect()->route('backend.index');
        }

        Flasher::addError('Email hoặc mật khẩu không chính xác!');
        return back()->withInput();
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('backend.admin');
    }
}
