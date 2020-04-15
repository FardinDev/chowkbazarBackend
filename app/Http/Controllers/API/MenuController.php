<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Http\Resources\MobileMenuResource;

class MenuController extends Controller
{
    public function getMobileMenu(){

        $categories = MobileMenuResource::collection(ProductCategory::where('parent_id', null)->orderBy('name')->get());


        $menu = [
            ["type"=> 'link', "label"=> 'Home', "url"=> '/', "children"=> []],
            ["type"=> 'link', "label"=> 'Shop', "url"=> '/shop/catalog', "children"=> []],
            ["type"=> 'link', "label"=> 'Source Product', "url"=> '/source-products', "children"=> []],
        
            ["type"=> 'link', "label"=> 'Categories', "url"=> '/shop/catalog', "children"=> $categories ],
        
            ["type"=> 'link', "label"=> 'Pages', "url"=> '/site', "children"=> [
                ["type"=> 'link', "label"=> 'About Us',             "url"=> '/site/about-us'],
                ["type"=> 'link', "label"=> 'Contact Us',           "url"=> '/site/contact-us'],
                ["type"=> 'link', "label"=> 'Terms And Conditions', "url"=> '/site/terms'],
                ["type"=> 'link', "label"=> 'FAQ',                  "url"=> '/site/faq'],
            ]],
        
            ];

        return response()->json( $menu );

        }
    }
