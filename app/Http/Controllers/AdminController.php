<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as MailAlias;
use Swift_Attachment;

session_start();

class AdminController extends Controller
{


    public function index()
    {
        return view('admin_login');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($arr, true)) {
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'MK hoặc tài khoản sai, vui lòng nhập lại');
//            Session::put('arr', json_encode($arr));
            return Redirect::to('/admin');
        }
//        $email = $request->email;
//        $password = $request->password;
//
//        $result = DB::table('admin')
//            ->where('email', $email)
//            ->where('password', $password)
//            ->first();
//        if ($result){
//            Session::put('name', $result->name);
//            Session::put('id', $result->id);
//            return Redirect::to('/dashboard');
//        }else{
//            Session::put('message', 'MK hoặc tài khoản sai, vui lòng nhập lại');
//            return Redirect::to('/admin');
//        }

    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/admin');
    }

    public function sendMail(Request $request)
    {
        $data = $request->all();

        $cart = Session::get("cart");
        $html = "<table style=' border: 1px solid black; font-size: 1rem'>
                        <thead>
                        <tr>
                            <th style=' border: 1px solid black; padding: 15px; text-align: left;'>Tên sản phẩm</th>
                            <th style=' border: 1px solid black; padding: 15px; text-align: left;'>Giá</th>
                            <th style=' border: 1px solid black; padding: 15px; text-align: left;'>Số lượng</th>
                            <th style=' border: 1px solid black; padding: 15px; text-align: left;'>Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody>";

        foreach ($cart as $item) {
            $price = number_format($item['price'],0,',','.');
            $qty = $item['qty'];
            $subtotal = number_format($item['price'] * $qty,0,',','.');
            $html .= "<tr>
                                <td style=' border: 1px solid black; padding: 15px; text-align: left;'>
                                    <h4><a href=\"\">{$item['name']}</a></h4>
                                </td>
                                <td style=' border: 1px solid black; padding: 15px; text-align: left;'>
                                    <p>{$price} đ</p>
                                </td>
                                <td style=' border: 1px solid black; padding: 15px; text-align: left;'>
                                    <div class=\"cart_quantity_button\">
                                        <p>{$qty}</p>
                                    </div>
                                </td>
                                <td style=' border: 1px solid black; padding: 15px; text-align: left;'>
                                    <p class=\"cart_total_price\">
                                        {$subtotal} đ
                                    </p>
                                </td>
                            </tr>";
        }

        Mail::send([], [],
            function ($message) use ($data, $html) {
                $message->to($data['email'], 'Do Minh Vu')
                    ->from('minhvu27081998@gmail.com', 'Vu Do')
                    ->setBody($html, 'text/html')
                    ->setSubject('Don hang');
            });
        return Redirect::to('/');
    }

}
