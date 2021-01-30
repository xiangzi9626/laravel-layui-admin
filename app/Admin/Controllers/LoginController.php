<?php


namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //登录页面
    public function index(){
        return view('admin.login.index');
    }
    //登录
    // 登录操作
    public function login()
    {
        // 验证
        $this->validate(request(),[
            'username' => 'required|min:2',
            'password' => 'required|min:5|max:10',
        ]);
        // 逻辑
        $user = request(['username', 'password']);
        if (Auth::guard("admin")->attempt($user)) {
            if(Auth::guard("admin")->user()->is_show <=0){
                return back()->withErrors("当前管理禁止登录");
            }
            return redirect('/admin/home');
        }
        // 渲染
        return \Redirect()->back()->withErrors("用户名密码不匹配");
    }

    // 登出
    public function logout()
    {
        \Auth()->guard("admin")->logout();
        return redirect('/admin/login');
    }
}
