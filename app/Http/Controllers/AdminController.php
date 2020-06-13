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

        $result = DB::table('admin')->where('email', $email)->where('password', $password)->first();
        return view('admin.dashboard');
    }

    public function logout(){

    }

}
