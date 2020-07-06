<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Customer;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;

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
        $data['password'] = md5($request->password);
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
        $city = City::orderBy('matp', 'ASC')->get();
        return view('pages.checkout.show_checkout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('city', $city);
    }

    public function loginCustomer(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);
        echo $username;
        echo $password;

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
        $data['password'] = md5($request->password);
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['notes'] = $request->notes;

        $shipping_id = DB::table('shipping')
            ->insertGetId($data);

        Session::put('id', $shipping_id);
        return Redirect::to('/checkout');
    }
    public function selectDeliveryHomeCheckout(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('matp', $data['ma_id'])
                    ->orderBy('maqh', 'ASC')
                    ->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($select_province as $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])
                    ->orderBy('xaid', 'ASC')
                    ->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $ward) {
                    $output .= '<option value="' . $ward->maqh . '">' . $ward->name . '</option>';
                }
            }
        }
        echo $output;
    }
    public function calculatorFeeCheckout(Request $request){
        $data = $request->all();
        if ($data['matp']){
            $feeship = Feeship::where('fee_matp', $data['matp'])
            ->where('fee_maqh', $data['maqh'])
            ->where('fee_xaid', $data['xaid'])
            ->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if ($count_feeship>0){
                    foreach ($feeship as $fee){
                        Session::put('fee', $fee->feeship);
                        Session::save();
                    }
                }else{
                    Session::put('fee', 15000);
                    Session::save();
                }
            }
        }
    }
    public function deleteFeeCheckout(){
        Session::forget('fee');
        return redirect()->back();
    }

}
