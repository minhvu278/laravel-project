<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class AdminController extends Controller
{


    public function index(){
        return view('admin_login');
    }
    public function showDashboard(){
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $email = $request->email;
        $password = $request->password;

        $result = DB::table('admin')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
        if ($result){
            Session::put('name', $result->name);
            Session::put('id', $result->id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message', 'MK hoặc tài khoản sai, vui lòng nhập lại');
            return Redirect::to('/admin');
        }

    }

    public function logout(){
        Session::put('name', null);
        Session::put('id', null);
        return Redirect::to('/admin');
    }

}
