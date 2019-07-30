<div class="col-sm-3">

<div class="left-sidebar">
<div id="order_by_div">
    <h2>Order By</h2>

    <div class="form-group">
        <select class="form-control select-dropdown" name="order_by" id="order_by">
            <option value="def">Default</option>
            <option disabled style="baackground-color:orange; text-align:center">Price</option>
            <option value="pl2h">Low to High</option>
            <option value="ph2l">High to Low</option>
            <option disabled style="baackground-color:orange; text-align:center">Views</option>
            <option value="vl2h">Low to High</option>
            <option value="vh2l">High to Low</option>
        </select>
    </div>
</div>

    <h2>Category</h2>

    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        @foreach ($cats as $cat)
        @if ($cat->childs->count()>0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <input type="checkbox" name="cat" id="{{$cat->id}}"> <a data-toggle="collapse"
                        data-parent="#accordian" href="#{{$cat->id}}-div">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        {{$cat->name}}
                    </a>
                </h4>
            </div>
            <div id="{{$cat->id}}-div" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        @foreach ($cat->childs as $subcat)
                        @if ($subcat->childs->count()>0)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <input type="checkbox" name="cat" id="{{ $subcat->id }}">
                                    <a data-toggle="collapse" data-parent="#accordian-1" href="#{{$subcat->id}}-div"
                                        style="font-size:small">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        {{$subcat->name}}
                                    </a>
                                </h4>
                            </div>

                            <div id="{{$subcat->id}}-div" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach ($subcat->childs as $subsubcat)
                                        <li>
                                            <input type="checkbox" name="cat" id="{{ $subsubcat->id }}">
                                            <a href="#" id="{{ $subsubcat->id }}-cat">{{$subsubcat->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <input type="checkbox" name="cat" id="{{ $subcat->id }}">
                                    <a href="#" id="{{ $subcat->id }}-cat">{{$subcat->name}}</a></h4>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @else
        <div class="panel panel-default">
            <div class="panel-heading">
                <input type="checkbox" name="cat" id="{{ $cat->id }}">
                <h4 class="panel-title"><a href="#" id="{{ $cat->id }}-cat">{{$cat->name}}</a></h4>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <!--/category-products-->


    <div>
        <ul class="nav nav-list">
            @foreach ($cats as $cat)
           <li><label class="tree-toggler nav-header">{{$cat->name}}<span class="badge pull-right">▼</span></label>
            
                @if ($cat->childs->count()>0)
                <ul class="nav nav-list tree" style="margin-left:20px">
                    {{childCat($cat->childs, '')}}
                </ul>
                @endif
            </li>
           @endforeach
        </ul>
    </div>
</div>

</div>
@php
    function childCat($cats, $string){
        foreach($cats as $cat){
            $string .= '<li><label class="tree-toggler nav-header" style="font-size:small">'.$cat->name.'</label>';

                if($cat->childs->count() > 0){
                    $string .= '<ul class="nav nav-list tree">';
                    foreach($cat->childs as $catC){
                            $string .= '<li><label class="tree-toggler nav-header">---'.$catC->name.'</label>'; 
                        }
                    $string .= '</ul>';
                }

            $string .= '</li>';
        }

        echo $string;
    }
@endphp

{{-- <div>
        <ul class="nav nav-list">
                @foreach ($cats as $cat)
            <li><label class="tree-toggler nav-header">Header 1</label>
                <ul class="nav nav-list tree">
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><label class="tree-toggler nav-header">Header 1.1</label>
                        <ul class="nav nav-list tree">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><label class="tree-toggler nav-header">Header 1.1.1</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="divider"></li>
            <li><label class="tree-toggler nav-header">Header 2</label>
                <ul class="nav nav-list tree">
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><label class="tree-toggler nav-header">Header 2.1</label>
                        <ul class="nav nav-list tree">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><label class="tree-toggler nav-header">Header 2.1.1</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><label class="tree-toggler nav-header">Header 2.2</label>
                        <ul class="nav nav-list tree">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><label class="tree-toggler nav-header">Header 2.2.1</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div --}}