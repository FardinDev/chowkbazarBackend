@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
    @include('components.sidebar')

    <div class="col-sm-9">
        
        <div class="row" id="mainrow">
        <div class="load"></div> 
            @foreach ($products as $product)
            
        <div class="col-sm-3">
                <div class="product-image-wrapper" onclick="window.location.href='{{route('product', $product->id)}}'">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{  $product->primary_image  }}" alt="">
                            <b style="color: #FE980F;">{{number_format($product->start_price).'-'.number_format($product->end_price)}} <small>BDT</small></b>  <br>
                            <small style="text-overflow: ellipsis;">{{$product->name}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    </div>
</div>




@endsection





@section('script')

<script src="{{asset('js/jquery.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>

<script src="{{asset('js/price-range.js')}}"></script>

<script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>

<script>
    $(document).ready(function () {
        var onload = $('#mainrow').html();
        $("input:checkbox").change(function () {

            if ($(this).is(':checked')) {
                //check
                var id = $(this).attr('id');

                $.ajax({
                    type: 'get',
                    url: '{{route("get.parent_cat")}}',
                    data: {
                        _token: '{{csrf_token()}}',
                        id: id
                    },
                    success: function (data) {
                  
                        $.each(data, function (index, value) {
                            $('#' + value).prop("checked", true);
                        });
                        var category = [];
                        $.each($("input[name='cat']:checked"), function () {
                            category.push($(this).attr('id'));
                        });
                        console.log(category);
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
                                       console.log(data);
                                       if(data.length == 0){
                                        $('#mainrow').html('');
                                            var card = onload;
                                            $('#mainrow').append(card).hide();
                                            $('#mainrow').fadeIn('normal');
                                        }else{
                                            $('#mainrow').html('');

                                            $.each(data, function (index, value) {


                                            var card = `<div class="col-sm-3"> <div class="product-image-wrapper" onclick="window.location.href='{{url("/product/`+value.id+`")}}'"> <div class="single-products"> <div class="productinfo text-center"> <img src="`+value.primary_image+`" alt="">  <b style="color: #FE980F;">{{number_format($product->start_price).'-'.number_format($product->end_price)}} <small>BDT</small></b> <br>  <small style="text-overflow: ellipsis;">`+value.name+`</small> </div> </div> </div> </div>`;

                                            $('#mainrow').append(card).hide();
                                            $('#mainrow').fadeIn('normal');


                                            });
                                            
                                    }
                                    },
                                    complete: function(){
                                        $('.load').fadeOut();
                                    }
                                });
                    }
                });


            } else {
                //remove
                var id = $(this).attr('id');
                $.ajax({
                    type: 'get',
                    url: '{{route("get.parent_cat")}}',
                    data: {
                        _token: '{{csrf_token()}}',
                        id: id
                    },
                    success: function (data) {
                        $.each(data, function (index, value) {
                            $('#' + value).prop("checked", false);
                        });
                        var category = [];
                        $.each($("input[name='cat']:checked"), function () {
                            category.push($(this).attr('id'));
                        });
                        console.log(category);
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
                                            
                                            console.log(data);
                                       if(data.length == 0){
                                        $('#mainrow').html('');
                                            var card = onload;
                                            $('#mainrow').append(card).hide();
                                            $('#mainrow').fadeIn('normal');
                                        }else{
                                            $('#mainrow').html('');

                                            $.each(data, function (index, value) {


                                            var card = `<div class="col-sm-3"> <div class="product-image-wrapper" onclick="window.location.href='{{url("/product/`+value.id+`")}}'"> <div class="single-products"> <div class="productinfo text-center"> <img src="`+value.primary_image+`" alt="">  <b style="color: #FE980F;">{{number_format($product->start_price).'-'.number_format($product->end_price)}} <small>BDT</small></b> <br>  <small style="text-overflow: ellipsis;">`+value.name+`</small> </div> </div> </div> </div>`;

                                            $('#mainrow').append(card).hide();
                                            $('#mainrow').fadeIn('normal');


                                            });
                                            
                                    }
                                        },
                                    complete: function(){
                                        $('.load').fadeOut();
                                    }
                        });
                    }
                });

            }

        });
    });

</script>

@endsection
