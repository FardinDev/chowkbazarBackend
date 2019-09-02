@extends('layouts.app')

@section('title', 'Home')

@section('content')



<section id="slider">
    <!--slider-->



    <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
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
      
    </div>

</section>
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
                        <div class="product-image-wrapper"
                            onclick="window.location.href='{{route('product', $product->id)}}'">
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
                </div>
				<!--features_items-->
				
				<!--Apparel,Textiles & Accessories-->
				<div class="features_items">
						<h2 class="title text-center" > <span onclick="window.location.href='{{route('product.all', ['search_query' => 'Apparel,Textiles & Accessories'])}}'" style="cursor:pointer">Apparel,Textiles & Accessories</span> </h2>
						@foreach ($list[1] as $f)
							@foreach ($f as $product)
							<div class="col-sm-3">
									<div class="product-image-wrapper"
										onclick="window.location.href='{{route('product', $product->id)}}'">
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
						
						@endforeach
					</div>
				<!--Apparel,Textiles & Accessories-->

				<!--Bags, Shoes & Accessories-->
				<div class="features_items">
						<h2 class="title text-center" > <span onclick="window.location.href='{{route('product.all', ['search_query' => 'Bags, Shoes & Accessories'])}}'" style="cursor:pointer">Bags, Shoes & Accessories</span> </h2>
						@foreach ($list[3] as $f)
							@foreach ($f as $product)
							<div class="col-sm-3">
									<div class="product-image-wrapper"
										onclick="window.location.href='{{route('product', $product->id)}}'">
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
						
						@endforeach
				</div>
				<!--Bags, Shoes & Accessories-->

				<!--Electronics & Engineering-->
				<div class="features_items">
						<h2 class="title text-center" > <span onclick="window.location.href='{{route('product.all', ['search_query' => 'Electronics & Engineering'])}}'" style="cursor:pointer">Electronics & Engineering</span> </h2>
						@foreach ($list[4] as $f)
							@foreach ($f as $product)
							<div class="col-sm-3">
									<div class="product-image-wrapper"
										onclick="window.location.href='{{route('product', $product->id)}}'">
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
						
						@endforeach
				</div>
				<!--Electronics & Engineering-->

            </div>

        </div>

    </div>

</section>



@endsection





@section('script')


@endsection
