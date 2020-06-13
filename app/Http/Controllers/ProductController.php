<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(){
        $cate_product = DB::table('category')
            ->orderBy('id', 'desc')
            ->get();
        $brand_product = DB::table('brand')
            ->orderBy('id', 'desc')
            ->get();
        return view('product.add_product')
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product);
    }

    public function allProduct(){

        $all_product = DB::table('product')
            ->join('category', 'category.id', '=' , 'product.category_id')
            ->join('brand', 'brand.id', '=' , 'product.brand_id')
            ->select(["product.*", "brand.name as brand_name", "category.name as category_name"])
            ->orderBy('product.id', 'desc')
            ->get();

        $manager_product = view('product.all_product')
            ->with('all_product', $all_product);
        return view('admin_layout')
            ->with('product.all_product', $manager_product);
    }

    public function saveProduct(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['image'] = $request->image;
        $data['desc'] = $request->desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['status'] = $request->status;

        $rule = [
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'image' => 'required',
        ];

        $msgE = [
            'name.required' => 'Vui lòng nhập vào tên sản phẩm',
            'price.required' => 'Vui lòng nhập vào giá sản phẩm',
            'desc.required' => 'Vui lòng nhập vào mô tả sản phẩm',
            'image.required' => 'Vui lòng chọn ảnh sản phẩm',
        ];

        $validator = Validator::make($data, $rule, $msgE);
        if ($validator->fails()){
            $manager_product = view('product.add_product')
                ->with('product', $data)
                ->with('err', $validator->errors()->messages());
            return view('admin_layout')
                ->with('product.add_product', $manager_product);
        }

        $get_image = $request->file('image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99). '.'. $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['image'] = $new_image;
            DB::table('product')->insert($data);
            Session::put('message', 'Them thanh cong');
            return Redirect::to('/all-product');
        }
        $data['image'] = '';
        DB::table('product')->insert($data);
        Session::put('message', 'Them san pham thanh cong');
        return Redirect::to('/all-product');
    }

    public function active($id){
        DB::table('product')->where('id', $id)->update(['status' => 1]);
        Session::put('message', 'Khong kich hoat san pham');
        return Redirect::to('/all-product');
    }

    public function inactive($id){
        DB::table('product')->where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Kich hoat san pham thanh cong');
        return Redirect::to('/all-product');
    }

    public function editProduct($id){
        $cate_product = DB::table('category')
            ->orderBy('id', 'desc')
            ->get();
        $brand_product = DB::table('brand')
            ->orderBy('id', 'desc')
            ->get();
        $edit_product = DB::table('product')
            ->where('id', $id)->get();
        $manager_product = view('product.edit_product')
            ->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product);
        return view('admin_layout')->with('product.edit_product', $manager_product);
    }

    public function updateProduct(Request $request, $id){
        $data = array();
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['desc'] = $request->desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['status'] = $request->status;


        $get_image = $request->file('image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99). '.'. $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['image'] = $new_image;
            DB::table('product')->where('id', $id)->update($data);
            Session::put('message', 'Cap nhat thanh cong');
            return Redirect::to('/all-product');
        }
        DB::table('product')->where('id', $id)->update($data);
        Session::put('message', 'Sửa san pham thanh cong');
        return Redirect::to('/all-product');
    }
    public function deleteProduct($id){
        DB::table('product')->where('id', $id)->delete();
        Session::put('message', 'Xóa san pham thanh cong');
        return Redirect::to('/all-product');
    }
}
