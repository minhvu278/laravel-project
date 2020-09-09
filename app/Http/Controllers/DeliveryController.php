<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;

class DeliveryController extends Controller
{
    public function delivery()
    {
        $city = City::orderBy('matp', 'ASC')
            ->get();
        return view('admin.delivery.add_delivery')
            ->with(compact('city'));
    }

    public function selectDelivery(Request $request)
    {
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

    public function insertDelivery(Request $request)
    {
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->fee_matp = $data['city'];
        $feeship->fee_maqh = $data['province'];
        $feeship->fee_xaid = $data['wards'];
        $feeship->feeship = $data['feeship'];
        $feeship->save();
    }

    public function selectFeeshipDelivery()
    {
        $feeship = Feeship::orderBy('id', 'DESC')
            ->get();
        $newFee = [];
        foreach ($feeship as $fee){
            $item = [
                'id' => $fee->id,
                'city_name' => $fee->city->name,
                'province_name' => $fee->province->name,
                'wards_name' => $fee->wards->name,
                'feeship' => number_format($fee->feeship,0,',','.').' đ',
            ];
            array_push($newFee, $item);
        }
        echo json_encode($newFee);
//        $output = '';
//        $output .= '<div class="table-responsive">
//            <table class="table table-bordered">
//                <thead>
//                    <tr>
//                        <th>Tên thành phố</th>
//                        <th>Tên quận huyện</th>
//                        <th>Tên xã phường</th>
//                        <th>Phí ship</th>
//                    </tr>
//                </thead>
//                <tbody>
//                ';

//        foreach ($feeship as $fee){
// //            dd($fee->wards);

//                $output.='
//                    <tr>
//                        <td>'.$fee->city->name.'</td>
//                        <td>'.$fee->province->name.'</td>
//                        <td>'.$fee->wards->name.'</td>
//                        <td contenteditable data-feeship_id="'.$fee->id.'">'.number_format($fee->feeship,0,',','.').'đ</td>
//                    </tr>
//                    ';
//            }
//    $output.='
//                </tbody>
//            </table>
//          </div>
//        ';
//        echo $output;
    }
}
