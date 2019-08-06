@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row" style="margin:0">
    @include('components.sidebar')

    <div class="col-sm-9">

        <div class="row" id="mainrow">
            <div class="load"></div>
            @if (count($products) == 0)
            <div style="position: relative;height: 50vh;">
                <span style="position: absolute;top: 45%;width: -webkit-fill-available;text-align: -webkit-center;">
                    <h1>No Products Found! :(</h1>
                </span>
            </div>
            @else
            @foreach ($products as $product)

            <div class="col-sm-3">
                <div class="product-image-wrapper" onclick="window.location.href='{{route('product', $product->id)}}'">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{  $product->primary_image  }}" alt="">
                        </div>
                    </div>
                    <span class="product-price">
                        <b style="color: #FE980F;">{{number_format($product->start_price).'-'.number_format($product->end_price)}}
                            <small>BDT</small></b> <br>
                    </span>
                    <div class="product-info">
                        <small>{{$product->name}}</small>

                    </div>
                </div>
            </div>
            @endforeach
            @endif

        </div>
        <div class="pull-right" id="links">

            {{$products->links()}}
        </div>
    </div>
</div>

@include('components.recomended')




@endsection





@section('script')


<script>
    let livedata;

    function getRemoteData(category, onload) {
        $.ajax({
            type: 'get',
            url: '{{route("get.parent_cat")}}',
            data: {
                _token: '{{csrf_token()}}',
                data: category
            },
            beforeSend: function () {
                $('.load').fadeIn();
            },
            success: function (data) {
                livedata = data;
                console.log(livedata);
                if (livedata.length > 0) {
                    $('#order_by_div').fadeIn('normal');
                } else {
                    $('#order_by_div').fadeOut('normal');
                }
                if (data.length == 0) {
                    $('#mainrow').html(`<div style="position: relative;height: 50vh;">
                    <span style="position: absolute;top: 45%;width: -webkit-fill-available;text-align: -webkit-center;">
                        <h1>No Products Found! :(</h1>
                    </span> 
                    </div>`);
                    var card = onload;
                    // $('#mainrow').append(card).hide();
                    if (document.querySelectorAll('input[type="checkbox"]:checked').length == 0) {
                        $('#mainrow').html(onload);
                        
                    }
                    
                } else {
                    $('#mainrow').html('');
                    $.each(data, function (index, value) {
                        var card =
                            `<div class="col-sm-3"> 
                                    <div class="product-image-wrapper" onclick="window.location.href='{{url("/product/` +
                            value.id + `")}}'">
                                        <div class="single-products"> 
                                            <div class="productinfo text-center">
                                                <img src="` + value.primary_image + `" alt="">
                                            </div>
                                        </div>
                                        <span class="product-price">
                                            <b style="color: #FE980F;">` + Number(value.start_price) + `-` + Number(
                                value.end_price) + ` <small>BDT</small></b>
                                        </span>
                                        <div class="product-info">
                                                <small>` + value.name + `</small>
                                        </div>
                                    </div>
                                </div>`;
                        $('#mainrow').append(card).hide();
                    });
                }
                $('#mainrow').fadeIn('normal');
            },
            complete: function () {
                $('.load').fadeOut();
            }
        });
    };

    function checkUncheck(id, check, onload) {

        $.ajax({
            type: 'get',
            url: '{{route("get.parent_cat")}}',
            data: {
                _token: '{{csrf_token()}}',
                id: id
            },
            success: function (data) {
                $.each(data, function (index, value) {
                    $('#' + value).prop("checked", check);
                });

                if ($(":checkbox:checked").length > 0) {
                $('#links').hide();
                }else if($(":checkbox:checked").length == 0){
                    $('#links').show();
                }
                var category = [];
                $.each($("input[name='cat']:checked"), function () {
                    category.push($(this).attr('id'));
                });
                // console.log(category);

                getRemoteData(category, onload);
            }
        });
    };

    function low2high(property, type) {
        var sortOrder = 1;
        if (property[0] === "-") {
            sortOrder = -1;
            property = property.substr(1);
        }
        return function (a, b) {
            var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
            return result * sortOrder;
        }
    }

    function hihg2low(property, type) {
        var sortOrder = 1;
        if (property[0] === "-") {
            sortOrder = -1;
            property = property.substr(1);
        }
        return function (a, b) {
            var result = (a[property] > b[property]) ? -1 : (a[property] < b[property]) ? 1 : 0;
            return result * sortOrder;
        }
    }


    $(document).ready(function () {

        $.ajax({
            type: "GET",
            url: "{{route('get.tags')}}",
            data: "data",
            success: function (response) {
                $('#tag-pool').html(response);
            }
        });

        $('label.tree-toggler').click(function () {
        $(this).parent().children('ul.tree').toggle(300);
    });
        $('#order_by_div').hide();
        $.ajax({
            type: "GET",
            url: "{{route('get.recommended.data')}}",
            data: "data",
            success: function (response) {
                $('#active-r').html(response);
            }
        });

        var onload = $('#mainrow').html();
        $("input:checkbox").change(function () {
            var id = $(this).attr('id');
            if ($(this).is(':checked')) {
                //check
                var check = true;
                checkUncheck(id, check, onload);
            } else {
                //remove
                var check = false;
                checkUncheck(id, check, onload);
            }

            
        });

        $("#order_by").change(function () {

            if ($(this).val() == 'pl2h') {
                livedata.sort(low2high("start_price"));
            } else if ($(this).val() == 'ph2l') {
                livedata.sort(hihg2low("start_price"));
            } else if ($(this).val() == 'vl2h') {
                livedata.sort(low2high("views"));
            } else if ($(this).val() == 'vh2l') {
                livedata.sort(hihg2low("views"));
            } else {

            }
            $('#mainrow').html('');
            $.each(livedata, function (index, value) {
                var card =
                    `<div class="col-sm-3"> 
                                    <div class="product-image-wrapper" onclick="window.location.href='{{url("/product/` +
                    value.id + `")}}'">
                                        <div class="single-products"> 
                                            <div class="productinfo text-center">
                                                <img src="` + value.primary_image + `" alt="">
                                            </div>
                                        </div>
                                        <span class="product-price">
                                            <b style="color: #FE980F;">` + Number(value.start_price) + `-` + Number(
                        value.end_price) + ` <small>BDT</small></b>
                                        </span>
                                        <div class="product-info">
                                                <small>` + value.name + `</small>
                                        </div>
                                    </div>
                                </div>`;
                $('#mainrow').append(card).hide();
            });
            $('#mainrow').fadeIn('normal');

            if ($(this).val() == 'def') {

                $('#mainrow').html(onload);
                $('#mainrow').fadeIn('normal');
            }


        });
    });

</script>

@endsection
