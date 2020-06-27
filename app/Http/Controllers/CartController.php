<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function cart(){
        $cate_product = DB::table('category')
            ->orderBy('id', 'desc')
            ->get();
        $brand_product = DB::table('brand')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.cart.cart')
            ->with('category', $cate_product)
            ->with('brand', $brand_product);
    }
    public function addCartAjax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaliable = 0;
            foreach ($cart as &$val) {
                if ($val['id'] == $data['cart_product_id']) {
                    $val['qty']++;
//                    $is_avaliable++;

                }
            }
            if ($is_avaliable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'id' => $data['cart_product_id'],
                    'name' => $data['cart_product_name'],
                    'image' => $data['cart_product_image'],
                    'price' => $data['cart_product_price'],
                    'qty' => $data['cart_product_qty']
                );
            }
            Session::put('cart', $cart);
            print_r($cart);
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'id' => $data['cart_product_id'],
                'name' => $data['cart_product_name'],
                'image' => $data['cart_product_image'],
                'price' => $data['cart_product_price'],
                'qty' => $data['cart_product_qty']
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }
    public function updateCart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true){
            foreach ($data['cart_qty'] as $key => $qty){
                foreach ($cart as $session => $val){
                    if ($val['session_id']==$key){
                        $cart[$session]['qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công');
        }else{
            return redirect()->back()->with('message', 'Cập nhật số lượng thất bại');
        }
    }

    public function deleteCart($session_id){
        $cart = Session::get('cart');
        if ($cart == true){
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        }
    }

//    public function saveCart(Request $request)
//    {
//        $product_id = $request->product_hidden;
//        $quantity = $request->qty;
//
//        $data = DB::table('product')
//            ->where('id', $product_id)
//            ->get();
//        $cate_product = DB::table('category')
//            ->orderBy('id', 'desc')
//            ->get();
//        $brand_product = DB::table('brand')
//            ->orderBy('id', 'desc')
//            ->get();
//
//        return view('pages.cart.show_cart')
//            ->with('category', $cate_product)
//            ->with('brand', $brand_product);
//    }
}
