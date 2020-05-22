<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\About;
use TCG\Voyager\Facades\Voyager;

class ExtraController extends Controller
{
    public function getAbouts(){

        $response = About::select('about', 'privacy_policy', 'middle_banner_desktop', 'middle_banner_mobile', 'become_seller', 're_sell', 'address', 'email', 'phone', 'lat', 'lon', 'embeded_map')->first();
        $response->middle_banner_desktop = Voyager::image($response->middle_banner_desktop);
        $response->middle_banner_mobile = Voyager::image($response->middle_banner_mobile);
        return response()->json( $response );
    }
}
