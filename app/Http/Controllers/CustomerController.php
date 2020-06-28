<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function allCustomer()
    {
        $all_customer = DB::table('customer')->get();
        $manager_customer = view('admin.customer.all_customer')
            ->with('all_customer', $all_customer);
        return view('admin_layout')
            ->with('admin.customer.all_customer', $manager_customer);
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

    public function editCustomer($id)
    {
        $edit_customer = DB::table('customer')
            ->where('id', $id)
            ->get();
        $manager_customer = view('admin.customer.edit_customer')
            ->with('edit_customer', $edit_customer);
        return view('admin_layout')
            ->with('admin.customer.edit_customer', $manager_customer);
    }

    public function updateCustomer(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;

        $rule = [
            'name' => 'required|min:2',
            'username' => 'required|email',
            'address' => 'required',
            'phone' => 'required'
        ];
        $msgE = [
            'name.required' => 'Vui lòng nhập vào tên thành viên',
            'name.min' => 'Nhập vào tối thiểu 2 ký tự',
            'username.required' => 'Vui lòng nhập vào username',
            'username.email' => 'Username phải là email',
            'address.required' => 'Vui lòng nhập vào địa chỉ',
            'phone.required' => 'Vui lòng nhập vào số điện thoại'
        ];
        $validator = Validator::make($data, $rule, $msgE);
        if ($validator->fails()) {
            $edit_customer = DB::table('customer')
                ->where('id', $id)
                ->get();
            $manager_customer = view('admin.customer.edit_customer')
                ->with('customer', $data)
                ->with('edit_customer', $edit_customer)
                ->with('err', $validator->errors()->messages());
            return view('admin_layout')
                ->with('admin.customer.edit_customer', $manager_customer);
        }
        DB::table('customer')
            ->where('id', $id)
            ->update($data);
        return Redirect::to('/all-customer');

    }

    public function deleteCustomer($id)
    {
        DB::table('customer')->where('id', $id)->delete();
        Session::put('Xoá thành viên thành công');
        return Redirect::to('/all-customer');
    }

}
