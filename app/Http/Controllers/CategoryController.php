<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('category.add_category');
    }

    public function allCategory(){

        $all_cate = DB::table('category')->get();
        $manager_cate = view('category.all_category')->with('all_cate', $all_cate);
        return view('admin_layout')->with('category.all_category', $manager_cate);
    }

    public function saveCategory(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;

        $rule = [
            'name' => 'required',
            'desc' => 'required'
        ];

        $msgE = [
            'name.required' => 'Vui lòng nhập vào tên danh mục',
            'desc.required' => 'Vui lòng nhập vào mô tả danh mục',
        ];

        $validator = Validator::make($data, $rule, $msgE);
        if ($validator->fails()){
            $manager_category = view('category.add_category')
                ->with('category', $data)
                ->with('err', $validator->errors()->messages());
            return view('admin_layout')
                ->with('category.add_category', $manager_category);
        }

        DB::table('category')->insert($data);
        Session::put('message', 'Them danh muc san pham thanh cong');
        return Redirect::to('/all-category');
    }

    public function active($id){
        DB::table('category')->where('id', $id)->update(['status' => 1]);
        Session::put('message', 'Khong kich hoat danh muc san pham');
        return Redirect::to('/all-category');
    }

    public function inactive($id){
        DB::table('category')->where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Kich hoat danh muc san pham thanh cong');
        return Redirect::to('/all-category');
    }

    public function editCategory($id){
        $edit_category = DB::table('category')->where('id', $id)->get();
        $manager_cate = view('category.edit_category')->with('edit_category', $edit_category);
        return view('admin_layout')->with('category.edit_category', $manager_cate);
    }

    public function updateCategory(Request $request, $id){
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;
        DB::table('category')->where('id', $id)->update($data);
        Session::put('message', 'Sửa danh muc san pham thanh cong');
        return Redirect::to('/all-category');
    }
    public function deleteCategory($id){
        DB::table('category')->where('id', $id)->delete();
        Session::put('message', 'Xóa danh muc san pham thanh cong');
        return Redirect::to('/all-category');
    }
}
