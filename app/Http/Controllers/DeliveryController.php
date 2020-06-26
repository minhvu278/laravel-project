<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Wards;

class DeliveryController extends Controller
{
    public function derivery(Request $request){
        return view('admin.derivery.add_derivery');
    }
}
