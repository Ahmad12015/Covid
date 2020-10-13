<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MobileApiController extends Controller
{

    public function checkin(Request $request)
    {
        $checkin = new Checkin();
//        $checkin->device_id = $request->input('device_id');
        $checkin->device_id = $request->input('data');
//        $checkin->place_id = $request->input('place_id');
        $checkin->place_id = $request->input('data');
        $checkin->checkin_time = Carbon::now();
        $checkin->save();

        return response()->json($checkin,200);
    }

   public function checkout(Request $request)
    {
        
        $checkin =  Checkin::findOrFail($request->checkin_id);
        $checkin->checkout_time = Carbon::now();
        $checkin->update();
        return response()->json($checkin,200);
        
    }



}
