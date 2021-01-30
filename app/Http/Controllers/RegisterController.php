<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\user;
class RegisterController extends Controller
{
    //注册页面
    public  function index(){
        return view('register.index');
    }
    //注册行为
    public function register(){
        $this->validate(request(),[
            'name' =>'required|string|min:3|max:32|unique:users,name',
            'email' =>'required|string|unique:users,email|email',
            'password' =>'required|min:3|max:32|confirmed',
        ]);
        $name = request('name');
        $email = \request('email');
        $password = bcrypt(request('password'));
        User::create(compact(['name','email','password']));
        return redirect('/login');
    }
}
