<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                @foreach ($cats as $cat)
                @if ($cat->childs->count()>0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{$cat->name}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$cat->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach ($cat->childs as $subcat)
                                
                                @if ($subcat->childs->count()>0)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian-1" href="#{{$subcat->id}}" style="font-size:small">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                {{$subcat->name}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{$subcat->id}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach ($subcat->childs as $subsubcat)
                                                <li><a href="#" id="{{ $subsubcat->id }}">{{$subsubcat->name}} </a></li>
                                                @endforeach
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>	
                                @else
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="#" id="{{ $subsubcat->id }}">{{$subcat->name}}</a></h4>
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
                        <h4 class="panel-title"><a href="#" id="{{ $subsubcat->id }}">{{$cat->name}}</a></h4>
                    </div>
                </div>
                        
                @endif
                        
                @endforeach

        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($brands as $brand)
                    <li><a href="#"> <span class="pull-right">({{$brand->count}})</span>{{$brand->brand}}</a></li>
                    @php
                        if($i++ == 3) break;
                    @endphp
                    @endforeach
           
                </ul>
            </div>
        </div><!--/brands_products-->
        
        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->
        
        <div class="shipping text-center"><!--shipping-->
            <img src="{{asset('images/home/shipping.jpg')}}" alt="" />
        </div><!--/shipping-->
    
    </div>
</div>