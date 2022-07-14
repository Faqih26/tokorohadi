<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function provinces(Request $request)
    {
        $provinces = Province::wherein('id',[31,32,36])->get();
        return $provinces;

    }
    public function regencies(Request $request, $provinces_id)
    {
        //jakarta
        if($provinces_id == 31){
           return Regency::wherein('id',[3171,3172,3173,3174,3175,3101])->get();
        }
        //jabar
        else if($provinces_id == 32){
           return Regency::wherein('id',[3275,3276,3271])->get();
        }
        //banten
        else if($provinces_id== 36){
            return Regency::wherein('id',[3671])->get();
        }

    }
}

