<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function allCustomer()
    {
        $all_customer = DB::table('customer')->get();
        $manager_customer = view('customer.all_customer')
            ->with('all_customer', $all_customer);
        return view('admin_layout')
            ->with('customer.all_customer', $manager_customer);
    }

    public function active($id)
    {
        DB::table('customer')->where('id', $id)->update(['status' => 1]);
        Session::put('message', 'Kích hoạt tài khoản thành viên');
        return Redirect::to('/all-customer');
    }

    public function inactive($id)
    {
        DB::table('customer')->where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Vô hiệu hóa thành viên');
        return Redirect::to('/all-customer');
    }
}