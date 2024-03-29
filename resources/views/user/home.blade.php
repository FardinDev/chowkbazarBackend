@extends('layouts.app')

@section('title', 'Home')

@section('content')



<div class="container">
<div class="row">
	<div class="col-3">

		<div class="cat-title">Categories ▼</div>
		<ul class="nav navbar-nav collapse navbar-collapse">

					<li class="dropdown">
						<ul role="menu" class="sub-menu-right" style="display:block">
							@foreach ($cats as $cat)
							<li class="dropdown"><a
									href="{{route('product.all', ['category' => $cat->name])}}">{{$cat->name}}</a>
								@if(count($cat->childs))
								<ul role="menu" class="sub-sub-menu-right">
									@foreach ($cat->childs as $c)
									<li class="dropdown"><a
											href="{{route('product.all', ['category' => $c->name])}}">{{$c->name}}</a>
										@if(count($c->childs))
										<ul role="menu" class="sub-sub-sub-menu-right">
											@foreach ($c->childs as $csub)
											<li><a
													href="{{route('product.all', ['category' => $csub->name])}}">{{$csub->name}}</a>
											</li>
											@endforeach
										</ul>
										@endif
									</li>
									@endforeach
								</ul>
								@endif
							</li>
							@endforeach
						</ul>

					</li>
					

				</ul>

	</div>
	<div class="col-9">
			<section id="slider" style="float:right">
					<!--slider-->
			
			
			
						<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: fit-content">
							<!-- Indicators -->
							<ol class="carousel-indicators">
								@for($i = 0; $i < sizeof($sliders); $i++) <li data-target="#myCarousel" data-slide-to="{{$i}}"
									class="{{$i == 0 ? 'active' : ''}}">
									</li>
									@endfor
							</ol>
			
							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								@php
								$count = 0;
								@endphp
								@foreach($sliders as $slider)
								<div class="item {{$count == 0 ? 'active' : ''}}">
									<img src="{{ Voyager::image( $slider->main_image ) }}"
										onclick="window.location.href='{{$slider->button_url}}'" alt="Los Angeles">
									{{-- <div class="carousel-caption">
													<h3>New York</h3>
													<p>We love the Big Apple!</p>
											</div> --}}
								</div>
								@php
								$count++;
								@endphp
								@endforeach
							</div>
			
							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					
						
				</section>
	</div>
</div>
</div>
<!--/slider-->



<section>

    <div class="container">

        <div class="row">



            {{-- sidebar --}}



            {{-- @include('components.sidebar') --}}



            {{-- sidebar --}}



            <div class="col-sm-12 padding-right">

				<!--features_items-->
                <div class="features_items">
                    <h2 class="title text-center">Trending Items</h2>
                    @foreach ($products as $product)
					<div class="col-sm-3">
							<a href="{{route('product', $product->id)}}" style="color:black !important">
								<div class="product-image-wrapper" >
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{  $product->primary_image  }}" alt="">
										</div>
									</div>
									<span class="product-price">
										<b style="color: #FE980F;">{{($product->start_price).'-'.($product->end_price)}}
											<small>BDT</small></b> <br>
											<small style="color: #FE980F;">Minimum Order: {{$product->minimum_orders.' '.$product->unit}}</small>
									</span>
							 
									<div class="product-info">
										<small>{{$product->name}}</small>
				
									</div>
								</div>
							</a>
						</div>
                    @endforeach
                </div>
				<!--features_items-->
				
				<!--Apparel,Textiles & Accessories-->
				<div class="features_items">
						<h2 class="title text-center" > <span onclick="window.location.href='{{route('product.all', ['category' => 'Apparel,Textiles & Accessories'])}}'" style="cursor:pointer">Apparel,Textiles & Accessories</span> </h2>
					
							@foreach ($apparels as $product)
							<div class="col-sm-3">
									<a href="{{route('product', $product->id)}}" style="color:black !important">
										<div class="product-image-wrapper" >
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{  $product->primary_image  }}" alt="">
												</div>
											</div>
											<span class="product-price">
												<b style="color: #FE980F;">{{($product->start_price).'-'.($product->end_price)}}
													<small>BDT</small></b> <br>
													<small style="color: #FE980F;">Minimum Order: {{$product->minimum_orders.' '.$product->unit}}</small>
											</span>
									 
											<div class="product-info">
												<small>{{$product->name}}</small>
						
											</div>
										</div>
									</a>
								</div>
							@endforeach

					</div>
				<!--Apparel,Textiles & Accessories-->

				<!--Bags, Shoes & Accessories-->
				<div class="features_items">
					<h2 class="title text-center" > 
						<span onclick="window.location.href='{{route('product.all', ['category' => 'Bags, Shoes & Accessories'])}}'" style="cursor:pointer">
								Bags, Shoes & Accessories
						</span> </h2>
					
							@foreach ($bags as $product)
							<div class="col-sm-3">
									<a href="{{route('product', $product->id)}}" style="color:black !important">
										<div class="product-image-wrapper" >
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{  $product->primary_image  }}" alt="">
												</div>
											</div>
											<span class="product-price">
												<b style="color: #FE980F;">{{($product->start_price).'-'.($product->end_price)}}
													<small>BDT</small></b> <br>
													<small style="color: #FE980F;">Minimum Order: {{$product->minimum_orders.' '.$product->unit}}</small>
											</span>
									 
											<div class="product-info">
												<small>{{$product->name}}</small>
						
											</div>
										</div>
									</a>
								</div>
							@endforeach
				</div>
				<!--Bags, Shoes & Accessories-->

				<!--Electronics & Engineering-->
				<div class="features_items">
						<h2 class="title text-center" > 
								<span onclick="window.location.href='{{route('product.all', ['category' => 'Electronics & Engineering'])}}'" style="cursor:pointer">
										Electronics & Engineering
								</span> </h2>
							
									@foreach ($electronics as $product)
									<div class="col-sm-3">
											<a href="{{route('product', $product->id)}}" style="color:black !important">
												<div class="product-image-wrapper" >
													<div class="single-products">
														<div class="productinfo text-center">
															<img src="{{  $product->primary_image  }}" alt="">
														</div>
													</div>
													<span class="product-price">
														<b style="color: #FE980F;">{{($product->start_price).'-'.($product->end_price)}}
															<small>BDT</small></b> <br>
															<small style="color: #FE980F;">Minimum Order: {{$product->minimum_orders.' '.$product->unit}}</small>
													</span>
											 
													<div class="product-info">
														<small>{{$product->name}}</small>
								
													</div>
												</div>
											</a>
										</div>
									@endforeach
				</div>
				<!--Electronics & Engineering-->

				<!--Machinery, Industrial Parts & Tools-->
				<div class="features_items">
						<h2 class="title text-center" > 
								<span onclick="window.location.href='{{route('product.all', ['category' => 'Machinery, Industrial Parts & Tools'])}}'" style="cursor:pointer">
										Machinery, Industrial Parts & Tools
								</span> </h2>
							
									@foreach ($machineries as $product)
									<div class="col-sm-3">
											<a href="{{route('product', $product->id)}}" style="color:black !important">
												<div class="product-image-wrapper" >
													<div class="single-products">
														<div class="productinfo text-center">
															<img src="{{  $product->primary_image  }}" alt="">
														</div>
													</div>
													<span class="product-price">
														<b style="color: #FE980F;">{{($product->start_price).'-'.($product->end_price)}}
															<small>BDT</small></b> <br>
															<small style="color: #FE980F;">Minimum Order: {{$product->minimum_orders.' '.$product->unit}}</small>
													</span>
											 
													<div class="product-info">
														<small>{{$product->name}}</small>
								
													</div>
												</div>
											</a>
										</div>
									@endforeach
				</div>
				<!--Machinery, Industrial Parts & Tools-->

				<!--Packaging, Ad. & Office Supplies-->
				<div class="features_items">
					<h2 class="title text-center" > 
							<span onclick="window.location.href='{{route('product.all', ['category' => 'Packaging, Ad. & Office Supplies'])}}'" style="cursor:pointer">
									Packaging, Ad. & Office Supplies
							</span> </h2>
						
								@foreach ($packagings as $product)
								<div class="col-sm-3">
										<a href="{{route('product', $product->id)}}" style="color:black !important">
											<div class="product-image-wrapper" >
												<div class="single-products">
													<div class="productinfo text-center">
														<img src="{{  $product->primary_image  }}" alt="">
													</div>
												</div>
												<span class="product-price">
													<b style="color: #FE980F;">{{($product->start_price).'-'.($product->end_price)}}
														<small>BDT</small></b> <br>
														<small style="color: #FE980F;">Minimum Order: {{$product->minimum_orders.' '.$product->unit}}</small>
												</span>
										 
												<div class="product-info">
													<small>{{$product->name}}</small>
							
												</div>
											</div>
										</a>
									</div>
								@endforeach
				</div>
				<!--Packaging, Ad. & Office Supplies-->
            </div>

        </div>

    </div>

</section>



@endsection





@section('script')


@endsection
