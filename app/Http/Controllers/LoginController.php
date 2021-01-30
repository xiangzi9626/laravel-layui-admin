<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    //登录页面
    public function index(){
        if(\Auth()->check()){
            return redirect('/posts');
        }
        return view('login.index');
    }
    //登录行为
    public function login(){
        $this->validate(request(),[
            'email' => 'required|email',
            'password' =>'required',
            'is_remember' =>'integer'
        ]);
        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if(\Auth()->attempt($user,$is_remember)){
            return redirect('/posts');
        }else{
            return back()->withErrors('登录失败，检查账号密码是否正确');
        }
    }
    //登出行为
    public function logout(){
        \Auth()->logout();
        return redirect('/login');
    }
}
