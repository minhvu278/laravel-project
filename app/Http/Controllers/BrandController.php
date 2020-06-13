<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function addBrand(){
        return view('brand.add_brand');
    }

    public function allBrand(){

        $all_brand = DB::table('brand')->get();
        $manager_brand = view('brand.all_brand')->with('all_brand', $all_brand);
        return view('admin_layout')->with('brand.all_brand', $manager_brand);
    }

    public function saveBrand(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;

        $rule = [
            'name' => 'required',
            'desc' => 'required'
        ];

        $msgE = [
            'name.required' => 'Vui lòng nhập vào tên thương hiệu',
            'desc.required' => 'Vui lòng nhập vào mô tả thương hiệu',
        ];

        $validator = Validator::make($data, $rule, $msgE);
        if ($validator->fails()){
            $manager_brand = view('brand.add_brand')
                ->with('brand', $data)
                ->with('err', $validator->errors()->messages());
            return view('admin_layout')
                ->with('brand.add_brand', $manager_brand);
        }

        DB::table('brand')->insert($data);
        Session::put('message', 'Them danh muc san pham thanh cong');
        return Redirect::to('/all-brand');
    }

    public function active($id){
        DB::table('brand')->where('id', $id)->update(['status' => 1]);
        Session::put('message', 'Khong kich hoat danh muc san pham');
        return Redirect::to('/all-brand');
    }

    public function inactive($id){
        DB::table('brand')->where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Kich hoat danh muc san pham thanh cong');
        return Redirect::to('/all-brand');
    }

    public function editBrand($id){
        $edit_brand = DB::table('brand')->where('id', $id)->get();
        $manager_brand = view('brand.edit_brand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('brand.edit_brand', $manager_brand);
    }

    public function updateBrand(Request $request, $id){
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;
        $data['status'] = $request->status;
        DB::table('brand')->where('id', $id)->update($data);
        Session::put('message', 'Sửa danh muc san pham thanh cong');
        return Redirect::to('/all-brand');
    }
    public function deleteBrand($id){
        DB::table('brand')->where('id', $id)->delete();
        Session::put('message', 'Xóa danh muc san pham thanh cong');
        return Redirect::to('/all-brand');
    }
}
