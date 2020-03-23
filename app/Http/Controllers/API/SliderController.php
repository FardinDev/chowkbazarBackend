<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SliderInfo;
use App\Http\Resources\SliderResource;
use TCG\Voyager\Facades\Voyager;

class SliderController extends Controller
{
    public function getSliders(Request $request){

        $sliders = SliderInfo::where('is_active', 1)->inRandomOrder()->get();

        // return voyager::image($sliders[0]->thumbnail('mobile'));

        $sliders = SliderResource::collection( $sliders );


        return response()->json( $sliders );

    }
}
