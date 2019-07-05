@extends('layouts.app')

@section('title', $product->name)

@section('content')
		<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

    <link href="{{asset('css/jquery.exzoom.css')}}" rel="stylesheet" type="text/css"/>
    <style>
			#exzoom {
					width: 400px;
					/*height: 400px;*/
			}
			.container-1 { margin: auto; max-width: 960px; }
			.hidden { display: none; }

			.shadow {
				-webkit-box-shadow: 9px 7px 14px -3px rgba(0,0,0,0.42);
				-moz-box-shadow: 9px 7px 14px -3px rgba(0,0,0,0.42);
				box-shadow: 9px 7px 14px -3px rgba(0,0,0,0.42);
			}
		</style>

	<section>

		<div class="container">

			<div class="row">

								{{-- sidebar --}}



				{{-- @include('components.sidebar') --}}



				{{-- sidebar --}}

				

				<div class="col-sm-10 padding-right">

					<div class="product-details"><!--product-details-->

						<div class="col-sm-5">

							<div class="view-product">

                                    {{-- <div class="d-img" style="background-image:url('{{voyager::image($product->primary_image) }}');"></div> --}}

																		<div class="container-1">
																			<div class="exzoom hidden" id="exzoom">
																					<div class="exzoom_img_box">
																							<ul class='exzoom_img_ul'>
																									<li><img src="{{$product->primary_image}}"/></li>
																									@if (!empty($product->other_images))

																										@php
										
																											$thumbnails = json_decode($product->other_images);   
										
																										@endphp
																										@foreach ($thumbnails as $thumbnail)
			
																										{{-- <a href=""><img src="{{voyager::image($thumbnail)}}" alt=""></a> --}}
																										<li><img src="{{$thumbnail }}"/></li>
			
																										
																										@endforeach

																									@endif

																							</ul>
																					</div>
																					<div class="exzoom_nav"></div>
																					<p class="exzoom_btn">
																							<a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
																							<a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
																					</p>
																			</div>
																			</div>
							
									</div>

                  

							



						</div>

						<div class="col-sm-7">

							<div class="product-information"><!--/product-information-->

							{{-- <img src="{{asset('images/product-details/new.jpg')}}" class="newarrival" alt="" /> --}}

								<h2>{{$product->name}}</h2>

                                <p>Category : 

																	@if ($product->category->parent)

																				@if ($product->category->parent->parent)

																					

																				{{$product->category->parent->parent->name.' 🡆 '.$product->category->parent->name.' 🡆 '.$product->category->name}}</p>



																				@else

																				

																				{{$product->category->parent->name.' 🡆 '.$product->category->name}}</p>

																				@endif



																	@else

																			{{$product->category->name}}</p>

																	@endif

								{{-- <img src="../images/product-details/rating.png" alt="" /> --}}

								<span>

									<span>Range : {{number_format($product->start_price).' BDT - '.number_format($product->end_price)}} BDT</span>

								<label>Minimum Orders : {{$product->minimum_orders}}</label>
								<br>
								@if ($product->tags)
									
								@php
									$tags = explode(',', $product->tags)
								@endphp
								@foreach ($tags as $tag)
									<label class="label label-warning text-light" style="color:white !important">{{$tag}}</label>								
								@endforeach
								@endif

					

								</span>

								<p><b>Availability:</b> In Stock</p>

								<p><b>Condition:</b> New</p>

								<p><b>Brand:</b> {{$product->brand}}</p>

							<a id="formButton"  class="btn btn-fefault query">
									
										Send Query
								</a>
								<form class="form-horizontal col-12" id="form1">
									
									
								
									
									<!-- Text input-->
									<div class="form-group">
							
									  <div class="col-md-5">
									  <input id="user_name" name="user_name" type="text" placeholder="Enter Your Name" class="form-control input-md" required="">
									  </div>
									 
									  <div class="col-md-5">
									  <input id="phone_number" name="phone_number" type="text" placeholder="Enter Phone Number" class="form-control input-md" required="">
								
									  </div>
									</div>
						
									<!-- Textarea -->
									<div class="form-group">
									  <div class="col-md-10">                     
										<textarea class="form-control" id="query" name="query" placeholder="Write Your Query Here"></textarea>
									  </div>
									</div>
									
									<!-- Button -->
									<div class="form-group">
									  
									  <div class="col-md-12">
										<button id="" name="" class="btn btn-fefault query col-md-10">Submit Query</button>
									  </div>
									</div>
			
									</form>
							</div><!--/product-information-->
							


						</div>

					</div><!--/product-details-->

					

					<div class="category-tab shop-details-tab"><!--category-tab-->

						<div class="col-sm-12">

							<ul class="nav nav-tabs">

								<li class="active"><a href="#details" data-toggle="tab">Details</a></li>

					

								<li><a href="#tag" data-toggle="tab">Tag</a></li>

						

							</ul>

						</div>

						<div class="tab-content">

							<div class="tab-pane fade active in" id="details" >

									<p>{!! $product->description !!}</p>


							</div>

							


							<div class="tab-pane fade" id="tag" >

								@if ($product->tags)
									
								@php
									$tags = explode(',', $product->tags)
								@endphp
								@foreach ($tags as $tag)
									<label class="label label-warning text-light" style="color:white !important">{{$tag}}</label>								
								@endforeach
								@endif

							</div>


							

						</div>

					</div><!--/category-tab-->

					

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

		$(document).ready(function() {
			$("#formButton").click(function() {
    $("#form1").slideToggle();
  });


var category = {{$product->category->id}};



$('#'+category).addClass('active');

var col = $('#'+category);

// col.closest('.collapse').removeClass('collapse');

col.parents().removeClass('collapse');

col.parents().addClass('in');

// console.log(col);

		});

		

		</script>


<script type="text/javascript">

	$('.container').imagesLoaded( function() {
$("#exzoom").exzoom({
			autoPlay: false,
	});
$("#exzoom").removeClass('hidden')
});

</script>

    @endsection