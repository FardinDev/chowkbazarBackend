@extends('layouts.app')

@section('title', $product->name)

@section('content')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<link href="{{asset('css/jquery.exzoom.css')}}" rel="stylesheet" type="text/css" />
<style>
    #exzoom {
        width: 400px;
        /*height: 400px;*/
    }

    .container-1 {
        margin: auto;
        max-width: 960px;
    }

    .hidden {
        display: none;
    }

    .shadow {
        -webkit-box-shadow: 9px 7px 14px -3px rgba(0, 0, 0, 0.42);
        -moz-box-shadow: 9px 7px 14px -3px rgba(0, 0, 0, 0.42);
        box-shadow: 9px 7px 14px -3px rgba(0, 0, 0, 0.42);
	}
	
	.exzoom .exzoom_btn a {
   
    width: 19px !important;
    
}

.input:focus {
    outline: none !important;
    border:1px solid red;
    box-shadow: 0 0 10px #719ECE;
}

</style>

<section>

    <div class="container">
    @if ($errors->any())
       
         
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $error }}</strong>
        </div>
        @endforeach
         
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
    @endif
        <div class="row">

            {{-- sidebar --}}



            {{-- @include('components.sidebar') --}}



            {{-- sidebar --}}



            <div class="col-sm-12 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            {{-- <div class="d-img" style="background-image:url('{{voyager::image($product->primary_image) }}');">
                        </div> --}}
                        <div class="container-1">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        <li><img src="{{$product->primary_image}}" /></li>
                                        @if (!empty($product->other_images))
                                        @php
                                        	$thumbnails = json_decode($product->other_images);
                                        @endphp
                                        @foreach ($thumbnails as $thumbnail)
                                        {{-- <a href=""><img src="{{voyager::image($thumbnail)}}" alt=""></a> --}}
                                        <li><img src="{{$thumbnail }}" /></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
									<a href="javascript:void(0);" class="exzoom_prev_btn"> ◀ </a> 
									<a href="javascript:void(0);" class="exzoom_next_btn"> ▶ </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="product-information">
                        <!--/product-information-->
                        @php
                            // function append($category){
                            //     `<a href="{{route('product.all', ['search_query' => `.$category.`])}}">{{`.$category.`}}</a>`
                                
                            // }
                        @endphp
                        <h2>{{$product->name}}</h2>
                        <p>Category : 
                      
                        @if ($product->category->parent)
                            @if ($product->category->parent->parent)
                            <a href="{{route("product.all", ["search_query" => $product->category->parent->parent->name])}}">
                                {{$product->category->parent->parent->name}}
                            </a>
                            🡆 
                            <a href="{{route("product.all", ["search_query" => $product->category->parent->name])}}">
                                {{$product->category->parent->name}}
                            </a>
                            🡆 
                            <a href="{{route("product.all", ["search_query" => $product->category->name])}}">
                                {{$product->category->name}}
                            </a>
                            @else
                            <a href="{{route("product.all", ["search_query" => $product->category->parent->name])}}">
                                {{$product->category->parent->name}}
                            </a>
                            🡆 
                            <a href="{{route("product.all", ["search_query" => $product->category->name])}}">
                                    {{$product->category->name}}
                            </a>
         
                            @endif
                        @else
                        <a href="{{route("product.all", ["search_query" => $product->category->name])}}">
                                {{$product->category->name}}
                        </a>
                        @endif
                        </p>
                        <span>
                            <span>Range :
                                {{number_format($product->start_price).' BDT - '.number_format($product->end_price)}}
								BDT
							</span>

                            <br>
                            @if ($product->tags)

                            @php
                            $tags = explode(',', $product->tags)
                            @endphp
                            @foreach ($tags as $tag)
                            <a href="{{route('product.all', ['search_query' => $tag])}}"><label class="label label-warning text-light"
                                style="color:white !important; background-color:#FE980F !important; cursor:pointer">{{$tag}}</label></a>
                            @endforeach
                            @endif
                        </span>

                        <p><b>Minimum Orders :</b> {{$product->minimum_orders}} {{$product->unit}}</p>

                        <p><b>{{ $product->text_one_title ? $product->text_one_title.' :' : ''}}</b> {{$product->text_one_text}}</p>

                        <p><b>{{ $product->text_two_title ? $product->text_two_title.' :' : ''}}</b> {{$product->text_two_text}}</p>

                        <p><b>{{ $product->text_three_title ? $product->text_three_title.' :' : ''}}</b> {{$product->text_three_text}}</p>

                        <a id="formButton" class="btn btn-fefault query">Send Query</a>
                    <form class="form-horizontal col-12" id="form1" action="{{route('product.send-query', $product->id)}}" method="POST">
                            {{ csrf_field() }}
                            <!-- Text input-->
                            <div class="form-group">

                                <div class="col-md-5">
                                    <input id="user_name" name="user_name" type="text" placeholder="Enter Your Name"
                                        class="form-control input-md" required>
                                </div>

                                <div class="col-md-5">
                                    <input id="phone_number" name="phone_number" type="text"
                                        placeholder="Enter Phone Number" class="form-control input-md" required>

                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="form-group">
                                <div class="col-md-10">
                                    <textarea class="form-control" id="product_query" name="product_query"
                                        placeholder="Write Your Query Here" required></textarea>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <button id="" name="" class="btn btn-fefault query col-md-10">Submit Query</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!--/product-information-->



                </div>

            </div>
            <!--/product-details-->



            <div class="category-tab shop-details-tab">
                <!--category-tab-->

                <div class="col-sm-12">

                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#details" data-toggle="tab">Details</a></li>



                        <li><a href="#tag" data-toggle="tab">Tag</a></li>



                    </ul>

                </div>

                <div class="tab-content">

                    <div class="tab-pane fade active in" id="details">

                        <p>{!! $product->description !!}</p>


                    </div>




                    <div class="tab-pane fade" id="tag">

                        @if ($product->tags)

                        @php
                            $tags = explode(',', $product->tags)
                            @endphp
                            @foreach ($tags as $tag)
                            <a href="{{route('product.all', ['search_query' => $tag])}}"><label class="label label-warning text-light"
                                style="color:white !important; background-color:#FE980F !important; cursor:pointer">{{$tag}}</label></a>
                            @endforeach
                            @endif

                    </div>




                </div>

            </div>
            <!--/category-tab-->



            {{-- @include('components.recomended') --}}



        </div>

    </div>

    </div>

</section>













@endsection





@section('script')

<script src="{{asset('js/jquery.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>

<script src="{{asset('js/price-range.js')}}"></script>

<script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>

{{-- <script src="js/jquery-1.9.1.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script> --}}

<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

<script src="{{asset('js/jquery.exzoom.js')}}"></script>





<script>
    $(document).ready(function () {
        $("#formButton").click(function () {
            $("#form1").slideToggle();
            $(this).text(function (i, v) {
                return v === 'Send Query' ? 'Hide Section' : 'Send Query'
            })
        });

        $( "#form1" ).submit(function( event ) {

               
            var phoneno = /^(?:\+88|01)?(?:\d{11}|\d{13})$/;
            if($('#phone_number').val().match(phoneno)) {
            
                
            }
            else {
                alert("Please Enter a Valid Number");
                event.preventDefault();
            
            }


            });



        var category = {{$product->category->id}};



        $('#' + category).addClass('active');

        var col = $('#' + category);

        // col.closest('.collapse').removeClass('collapse');

        col.parents().removeClass('collapse');

        col.parents().addClass('in');

        // console.log(col);

    });

</script>


<script type="text/javascript">
    $('.container').imagesLoaded(function () {
        $("#exzoom").exzoom({
            autoPlay: false,
        });
        $("#exzoom").removeClass('hidden')
    });

</script>

@endsection
