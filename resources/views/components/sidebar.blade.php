<div class="col-sm-3">

<div class="left-sidebar">

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

</div>

</div>
