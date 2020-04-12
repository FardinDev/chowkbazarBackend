<?php
use App\ProductCategory;

function getAllChildsBySlug($slug){

    $category = ProductCategory::with('childs')->where('slug', $slug)->first();
            $childs = $category->childs;
            $firstChild = [];
            $secondChild = [];
            $thirdChild = [];

            foreach ($childs as $fc) {
                array_push($firstChild, $fc->id);
                if($fc->childs){
                    foreach ($fc->childs as $sc) {
                        array_push($secondChild, $sc->id);
                        if($sc->childs){
                            foreach ($sc->childs as $tc) {
                                array_push($thirdChild, $sc->id);
                            }
                        }
                    }
                }
            }

            $allChild = array_merge($firstChild, $secondChild);
            $allChild = array_merge($allChild, $thirdChild);

            array_push($allChild, $category->id);

            return $allChild;

}
