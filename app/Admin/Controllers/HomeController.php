<?php

namespace App\Admin\Controllers;
class HomeController extends Controller
{
    //首页
    public function index(){
        return view('admin.home.index');
    }
    //首页
    public function dome(){
        return view('admin.home.dome');
    }
}
