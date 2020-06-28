<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Customer;

class CheckoutController extends Controller
{
    public function loginCheckout()
    {
        $cate_product = DB::table('category')
            ->orderBy('id', 'desc')
            ->get();
        $brand_product = DB::table('brand')
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.checkout.login_checkout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product);
    }

    public function logoutCheckout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function addCustomer(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['password'] = bcrypt($request->password);
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;

        $customer_id = DB::table('customer')
            ->insertGetId($data);

        Session::put('id', $customer_id);
        Session::put('name', $request->name);
        return Redirect::to('/checkout');
    }

    public function checkout()
    {
        $cate_product = DB::table('category')
            ->orderBy('id', 'desc')
            ->get();
        $brand_product = DB::table('brand')
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.checkout.show_checkout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product);
    }

    public function loginCustomer(Request $request)
    {
        $username = $request->username_account;
        $password = $request->password_account;

        $result = DB::table('customer')
            ->where('username', $username)
            ->where('password', $password)
            ->first();
        if ($result) {
            Session::put('id', $result->id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function saveCheckoutCustomer(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['notes'] = $request->notes;

        $shipping_id = DB::table('shipping')
            ->insertGetId($data);

        Session::put('id', $shipping_id);
        return Redirect::to('/checkout');
    }
}
