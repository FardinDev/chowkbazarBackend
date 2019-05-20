@extends('layouts.app')

@section('title', 'Home')

@section('content')



<section id="slider"><!--slider-->

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div id="slider-carousel" class="carousel slide" data-ride="carousel">

						<ol class="carousel-indicators">

						

                            @for($i = 0; $i < sizeof($sliders); $i++)

                            <li data-target="#slider-carousel" data-slide-to="{{$i}}"></li>



                            @endfor

						</ol>

						

						<div class="carousel-inner">

							

                            @php

                            $count = 0;    

                            @endphp

                            

                            @foreach($sliders as $slider)

                            <div class="item {{$count == 0 ? 'active' : ''}}">

								<div class="col-sm-6">

									<h1>{{$slider->title}}</h1>

									<h2>{{$slider->subtitle}}</h2>

									<p>{{$slider->short_description}}</p>

									<button type="button" class="btn btn-default get">Get it now</button>

								</div>

								<div class="col-sm-6">

									<img src="{{ Voyager::image( $slider->main_image ) }}" class="girl img-responsive" alt="" />

									<img src="{{ Voyager::image( $slider->pricing_image ) }}"  class="pricing" alt="" />

								</div>

                            </div>

                            @php

                                $count++;

                            @endphp

                            @endforeach

							

						</div>

						

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">

							<i class="fa fa-angle-left"></i>

						</a>

						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">

							<i class="fa fa-angle-right"></i>

						</a>

					</div>

					

				</div>

			</div>

		</div>

	</section><!--/slider-->

	

	<section>

		<div class="container">

			<div class="row">



				{{-- sidebar --}}



				{{-- @include('components.sidebar') --}}



				{{-- sidebar --}}



				<div class="col-sm-12 padding-right">

					<div class="features_items"><!--features_items-->

						<h2 class="title text-center">Trending Items</h2>



						@foreach ($products as $product)

								

						{{-- <div class="col-sm-4">

							<div class="product-image-wrapper">

								<div class="single-products">

										<div class="productinfo text-center">

									

											<div class="img" style="background-image:url('{{ Voyager::image( $product->primary_image ) }}');"></div>

											<h2>{{$product->start_price.'-'.$product->end_price}} <small>BDT</small> </h2>

											<p>{{$product->name}}</p>

											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

										</div>

										<div class="product-overlay" onclick="window.location.href='{{route('product', $product->id)}}'">

											<div class="overlay-content">

												<h2>{{$product->start_price.'-'.$product->end_price}} <small>BDT</small> </h2>

												<p>{{$product->name}}</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

										</div>

								</div>

						

							</div>

						</div> --}}


						<div class="col-sm-3">

							<div class="product-image-wrapper" onclick="window.location.href='{{route('product', $product->id)}}'">

								<div class="single-products">

									<div class="productinfo text-center">

										<img src="{{ Voyager::image( $product->primary_image ) }}" alt="">

										<b style="color: #FE980F;">{{number_format($product->start_price).'-'.number_format($product->end_price)}} <small>BDT</small></b>  <br>

										<small style="text-overflow: ellipsis;">{{$product->name}}</small>

									
									</div>

									

								</div>

							</div>

						</div>
					
						@endforeach


					
						

					</div><!--features_items-->

					

					<div class="category-tab"><!--category-tab-->

						<div class="col-sm-12">

							<ul class="nav nav-tabs">

								<li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>

								<li><a href="#blazers" data-toggle="tab">Blazers</a></li>

								<li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>

								<li><a href="#kids" data-toggle="tab">Kids</a></li>

								<li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>

							</ul>

						</div>

						<div class="tab-content">

							<div class="tab-pane fade active in" id="tshirt" >

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery1.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery2.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery3.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery4.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

							</div>

							

							<div class="tab-pane fade" id="blazers" >

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery4.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery3.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery2.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery1.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

							</div>

							

							<div class="tab-pane fade" id="sunglass" >

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery3.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery4.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery1.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery2.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

							</div>

							

							<div class="tab-pane fade" id="kids" >

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery1.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery2.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery3.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery4.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

							</div>

							

							<div class="tab-pane fade" id="poloshirt" >

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery2.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery4.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery3.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

								<div class="col-sm-3">

									<div class="product-image-wrapper">

										<div class="single-products">

											<div class="productinfo text-center">

												<img src="images/home/gallery1.jpg" alt="" />

												<h2>$56</h2>

												<p>Easy Polo Black Edition</p>

												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

											</div>

											

										</div>

									</div>

								</div>

							</div>

						</div>

					</div><!--/category-tab-->

					

				@include('components.recomended')

					

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
		

@endsection