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
            ["type"=> 'link', "label"=> 'Products', "url"=> '/shop/catalog', "children"=> [
                ["type"=> 'link', "label"=> 'Featured Products', "queryparam" => true, "url"=> 'featured'],
                ["type"=> 'link', "label"=> 'Most Viewed', "queryparam" => true, "url"=> 'most-viewed'],
                ["type"=> 'link', "label"=> 'All Products', "url"=> '/shop/catalog'],
            ]],
            ["type"=> 'link', "label"=> 'Categories', "url"=> '/shop/catalog', "children"=> $categories ],
            ["type"=> 'link', "label"=> 'Source Product', "url"=> '/source-products', "children"=> []],

            ["type"=> 'link', "label"=> 'About Us',             "url"=> '/site/about-us'],
            ["type"=> 'link', "label"=> 'Contact Us',           "url"=> '/site/contact-us'],
            ["type"=> 'link', "label"=> 'Become a Seller',           "url"=> '/site/become-a-seller'],
            ["type"=> 'link', "label"=> 'Privacy Policy', "url"=> '/site/privacy-policy'],
        
        
            ];

        return response()->json( $menu );

        }
    }
