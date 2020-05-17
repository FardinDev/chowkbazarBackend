<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\About;
use TCG\Voyager\Facades\Voyager;

class ExtraController extends Controller
{
    public function getAbouts(){

        $response = About::select('about', 'privacy_policy', 'middle_banner', 'become_seller', 'address', 'email', 'phone', 'lat', 'lon', 'embeded_map')->first();
        $response->middle_banner = Voyager::image($response->middle_banner);
        return response()->json( $response );
    }
}
