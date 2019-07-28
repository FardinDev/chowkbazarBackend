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
                            <b style="color: #FE980F;">{{number_format($product->start_price).'-'.number_format($product->end_price)}} <small>BDT</small></b>  <br>
                        </span>
                        <div class="product-info">
                            <small>{{$product->name}}</small>

                    </div>
                </div>
            </div>
        @endforeach
        @endif 
           
    </div>
</div>
</div>
@include('components.recomended')




@endsection





@section('script')

<script src="{{asset('js/jquery.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>

<script src="{{asset('js/price-range.js')}}"></script>

<script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>

<script>

function getRemoteData(category, onload){
    $.ajax({
            type: 'get',
            url: '{{route("get.parent_cat")}}',
            data: {
                _token: '{{csrf_token()}}',
                data: category
            },
            beforeSend: function() {
                    $('.load').fadeIn();
            },
            success: function (data) {
                // console.log(data);
                if(data.length == 0){
                    $('#mainrow').html('');
                    var card = onload;
                    $('#mainrow').append(card).hide();
                    
                }else{
                    $('#mainrow').html('');
                    $.each(data, function (index, value) {
                    var card = `<div class="col-sm-3"> 
                                    <div class="product-image-wrapper" onclick="window.location.href='{{url("/product/`+value.id+`")}}'">
                                        <div class="single-products"> 
                                            <div class="productinfo text-center">
                                                <img src="`+value.primary_image+`" alt="">
                                            </div>
                                        </div>
                                        <span class="product-price">
                                            <b style="color: #FE980F;">`+Number(value.start_price)+`-`+Number(value.end_price)+` <small>BDT</small></b>
                                        </span>
                                        <div class="product-info">
                                                <small>`+value.name+`</small>
                                        </div>
                                    </div>
                                </div>`;
                    $('#mainrow').append(card).hide();
                    });
                }
            $('#mainrow').fadeIn('normal');
            },
            complete: function(){
                $('.load').fadeOut();
            }
        });
};

function checkUncheck(id, check, onload){
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
                var category = [];
                $.each($("input[name='cat']:checked"), function () {
                    category.push($(this).attr('id'));
                });
                // console.log(category);
                getRemoteData(category, onload);
            }
        });
};

$(document).ready(function () {
    $.ajax({
            type: "GET",
            url: "{{route('get.recommended.data')}}",
            data: "data",
            success: function (response) {
                console.log(response);
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
    });

</script>

@endsection
