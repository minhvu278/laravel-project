<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function checkCoupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('code', $data['coupon'])
            ->first();
        if ($coupon){
            $count_coupon = $coupon->count();
            if ($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if ($coupon_session){
                    $is_avaiable = 0;
                    if ($is_avaiable == 0){
                        $cou[] = array(
                            'code' => $coupon->code,
                            'condition' => $coupon->condition,
                            'number' => $coupon->number
                        );
                        Session::put('coupon', $cou);
                    }
                }else{
                    $cou[] = array(
                        'code' => $coupon->code,
                        'condition' => $coupon->condition,
                        'number' => $coupon->number
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Them ma giam gia thanh cong');
            }
        }else{
            return redirect()->back()->with('error', 'Ma giam gia khong dung');
        }
    }

    public function addCoupon()
    {
        return view('admin.coupon.add_coupon');
    }

    public function allCoupon()
    {
        $coupon = Coupon::orderBy('id', 'desc')
            ->get();
        return view('admin.coupon.all_coupon')
            ->with(compact('coupon'));
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        Session::put('message', 'Xoá mã giảm giá thành công');
        return Redirect::to('/all-coupon');
    }

    public function saveCoupon(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->name = $data['name'];
        $coupon->code = $data['code'];
        $coupon->qty = $data['qty'];
        $coupon->number = $data['number'];
        $coupon->condition = $data['condition'];
        $rule = [
            'name' => 'required|min:5',
            'code' => 'required',
            'qty' => 'required',
            'number' => 'required',
        ];

        $msgE = [
            'name.required' => 'Vui lòng nhập vào tên danh mục',
            'name.min' => 'Vui lòng nhập vào ít nhất 5 ký tự',
            'code.required' => 'Vui lòng nhập vào mã giảm giá',
            'qty.required' => 'Vui lòng nhập vào số lượng',
            'number.required' => 'Vui lòng nhập % hoặc tiền giảm',
        ];
        $validator = Validator::make($data, $rule, $msgE);
        if ($validator->fails()) {
            $manager_coupon = view('admin.coupon.add_coupon')
                ->with('coupon', $data)
                ->with('err', $validator->errors()->messages());
            return view('admin_layout')
                ->with('admin.coupon.add_coupon', $manager_coupon);
        }
        $coupon->save();
        return Redirect::to('/all-coupon');
    }
}
