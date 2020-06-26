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
        return view('admin.product.add_product')
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

        $manager_product = view('admin.product.all_product')
            ->with('all_product', $all_product);
        return view('admin_layout')
            ->with('admin.product.all_product', $manager_product);
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
            'name' => 'required|min:5',
            'price' => 'required',
            'desc' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ];

        $msgE = [
            'name.required' => 'Vui lòng nhập vào tên sản phẩm',
            'name.min' => 'Vui lòng nhập vào ít nhất 5 ký tự',
            'price.required' => 'Vui lòng nhập vào giá sản phẩm',
            'desc.required' => 'Vui lòng nhập vào mô tả sản phẩm',
            'image.required' => 'Vui lòng chọn ảnh sản phẩm',
            'image.mimes' => 'Vui lòng chọn đúng đuôi',
            'image.max' => 'Chỉ được tối đa 10MB',
        ];

        $validator = Validator::make($data, $rule, $msgE);
        if ($validator->fails()){
            $cate_product = DB::table('category')
                ->orderBy('id', 'desc')
                ->get();
            $brand_product = DB::table('brand')
                ->orderBy('id', 'desc')
                ->get();

            $manager_product = view('admin.product.add_product')
                ->with('product', $data)
                ->with('err', $validator->errors()->messages())
                ->with('cate_product', $cate_product)
                ->with('brand_product', $brand_product);
                return view('admin_layout')
                ->with('admin.product.add_product', $manager_product);
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
        DB::table('product')
            ->where('id', $id)
            ->update(['status' => 1]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function inactive($id){
        DB::table('product')
            ->where('id', $id)
            ->update(['status' => 0]);
        Session::put('message', 'Không kích hoạt sản phẩm');
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
        $manager_product = view('admin.product.edit_product')
            ->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product);
        return view('admin_layout')
            ->with('admin.product.edit_product', $manager_product);
    }

    public function updateProduct(Request $request, $id){
        $data = array();
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['image'] = $request->image;
        $data['desc'] = $request->desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['status'] = $request->status;

        $rule = [
            'name' => 'required|min:5',
            'price' => 'required',
            'desc' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ];

        $msgE = [
            'name.required' => 'Vui lòng nhập vào tên sản phẩm',
            'name.min' => 'Vui lòng nhập vào ít nhất 5 ký tự',
            'price.required' => 'Vui lòng nhập vào giá sản phẩm',
            'desc.required' => 'Vui lòng nhập vào mô tả sản phẩm',
            'image.required' => 'Vui lòng chọn ảnh sản phẩm',
            'image.mimes' => 'Vui lòng chọn đúng đuôi',
            'image.max' => 'Chỉ được tối đa 10MB',
        ];

        $validator = Validator::make($data, $rule, $msgE);
        if ($validator->fails()){
            $cate_product = DB::table('category')
                ->orderBy('id', 'desc')
                ->get();
            $brand_product = DB::table('brand')
                ->orderBy('id', 'desc')
                ->get();

            $manager_product = view('admin.product.edit_product')
                ->with('product', $data)
                ->with('err', $validator->errors()->messages())
                ->with('cate_product', $cate_product)
                ->with('brand_product', $brand_product);
            return view('admin_layout')
                ->with('admin.product.edit_product', $manager_product);
        }


        $get_image = $request->file('image');
//        dd($get_image);
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99). '.'. $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['image'] = $new_image;
        }

        DB::table('product')
            ->where('id', $id)
            ->update($data);
        Session::put('message', 'Sửa san pham thanh cong');
        return Redirect::to('/all-product');
    }
    public function deleteProduct($id){
        DB::table('product')
            ->where('id', $id)
            ->delete();
        Session::put('message', 'Xóa san pham thanh cong');
        return Redirect::to('/all-product');
    }

    //End function admin page

    public function showDetails($id){
        $cate_product = DB::table('category')
            ->where('status' ,1)
            ->orderBy('id', 'desc')
            ->get();
        $brand_product = DB::table('brand')
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
        $details_product = DB::table('product')
            ->join('category', 'category.id', '=' , 'product.category_id')
            ->join('brand', 'brand.id', '=' , 'product.brand_id')
            ->select(["product.*", "brand.name as brand_name", "category.name as category_name"])
            ->where('product.id', $id)
            ->get();

        foreach($details_product as $value){
            $category_id = $value->category_id;
        }

        $relate_product = DB::table('product')
            ->join('category', 'category.id', '=' , 'product.category_id')
            ->join('brand', 'brand.id', '=' , 'product.brand_id')
            ->select(["product.*", "brand.name as brand_name", "category.name as category_name"])
            ->where('category.id', $category_id)
            ->whereNotIn('product.id', [$id])
            ->get();

        return view('pages.product.show_details')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('details_product', $details_product)
            ->with('relate_product', $relate_product);
    }
}
