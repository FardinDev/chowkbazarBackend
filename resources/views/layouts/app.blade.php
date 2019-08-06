<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="">

    <title>@yield('title') | chowkbazarbd</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">

    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">

	<link href="{{asset('css/main.css')}}" rel="stylesheet">

	<link href="{{asset('css/responsive.css')}}" rel="stylesheet">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	



    <!--[if lt IE 9]>

    <script src="js/html5shiv.js"></script>

    <script src="js/respond.min.js"></script>

    <![endif]-->       

    <link rel="shortcut icon" href="{{asset('images/ico/favicon.ico')}}">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">

    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">

    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">

</head><!--/head-->



<body>
	<div class="se-pre-con"></div> 
	<header id="header"><!--header-->

		

		<div class="header-middle"><!--header-middle-->

			<div class="container">

				<div class="row">

					<div class="col-md-4 clearfix">

						<div class="logo pull-left">

							<a href="{{route('home')}}"><img style="max-height:50px" src="{{asset('images/home/logo.png')}}" alt="" /></a>

						</div>

						<div class="btn-group pull-right clearfix">


						</div>

					</div>

					<div class="col-md-8 clearfix">

							<div class="col-sm-12">

									<div class="social-icons pull-right">
			
										<ul class="nav navbar-nav" style="display: inline !important;">
											<li><a href="https://www.facebook.com/chowkbazarbd" target="_blank"><i class="fa fa-facebook"></i></a></li>
			
											<li><a href="https://www.facebook.com/groups/cbbdcommunity" target="_blank"><i class="fa fa-users"></i></a></li>
											
											<li><a href="mailto:chowkbazarbd@gmail.com" target="_blank"><i class="fa fa-envelope"></i></a></li>
											
											@if (!Route::is('product.source'))
											<li>
											<button type="button" class="btn btn-default source" onclick="window.location.href='{{route('product.source')}}'">Source Product</button>
											</li>
											@endif
										
										</ul>
			
									</div>
			
								</div>
	

					</div>

				</div>

			</div>

		</div><!--/header-middle-->

	

		<div class="header-bottom"><!--header-bottom-->

			<div class="container">

				<div class="row">

					<div class="col-sm-9">

						<div class="navbar-header">

							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

								<span class="sr-only">Toggle navigation</span>

								<span class="icon-bar"></span>

								<span class="icon-bar"></span>

								<span class="icon-bar"></span>

							</button>

						</div>

						<div class="mainmenu pull-left">

							<ul class="nav navbar-nav collapse navbar-collapse">

							<li><a href="{{route('home')}}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a></li>
							<li class="dropdown"><a href="#">Categories<i class="fa fa-angle-down"></i></a>

								<ul role="menu" class="sub-menu">
										@foreach ($cats as $cat)
										<li class="dropdown"><a href="{{route('product.all', ['search_query' => $cat->name])}}">{{$cat->name}}</a>
											@if(count($cat->childs))
												<ul role="menu" class="sub-sub-menu">
													@foreach ($cat->childs as $c)
														<li class="dropdown"><a href="{{route('product.all', ['search_query' => $c->name])}}">{{$c->name}}</a>
															@if(count($c->childs))
															<ul role="menu" class="sub-sub-sub-menu">
																@foreach ($c->childs as $csub)
																	<li><a href="{{route('product.all', ['search_query' => $csub->name])}}">{{$csub->name}}</a></li>
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
							<li><a href="{{route('product.all')}}" class="{{ Route::is('product') ? 'active' : '' }} {{ Route::is('product.all') ? 'active' : '' }}">Products</a></li>

								{{-- <li class="dropdown"><a href="#" class="{{ Route::is('product') ? 'active' : '' }}">Products<i class="fa fa-angle-down "></i></a>

                                    <ul role="menu" class="sub-menu">

                                        <li><a href="shop.html">Products</a></li>

										<li><a href="product-details.html">Product Details</a></li> 

										<li><a href="checkout.html">Checkout</a></li> 

										<li><a href="cart.html">Cart</a></li> 

										<li><a href="login.html">Login</a></li> 

                                    </ul>

                                </li>  --}}

								{{-- <li class="dropdown"><a href="#">Source Product<i class="fa fa-angle-down"></i></a>

                                    <ul role="menu" class="sub-menu">

										<li><a href="#">Request Product</a></li>

                                    </ul>

								</li>  --}}
								


								{{-- <li><a href="404.html">404</a></li> --}}

								<li><a href="#" data-toggle="modal" data-target="#exampleModalLong">About</a></li>

							</ul>

						</div>

					</div>

					<div class="col-sm-3">
{{-- search --}}
						<div class="search_box pull-right">
						<form action="{{route('product.all')}}" method="get">
							{{-- {{ csrf_field() }} --}}
							<input type="text" id="search_box" name="search_query" placeholder="Search Products" autocomplete="off"/>
						</form>
							<div id="countryList" style="position:absolute">
									
							</div>

						</div>

					</div>

				</div>

			</div>

		</div><!--/header-bottom-->

	</header><!--/header-->

	



    @yield('content')



	<footer id="footer"><!--Footer-->
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>About</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#" data-toggle="modal" data-target="#exampleModalLong">See About</a></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-5">
							<div class="single-widget">
									<h2>Social</h2>
									<div class="social-icons">
			
											<ul class="nav navbar-nav" style="display: inline !important;">
												<li><a href="https://www.facebook.com/chowkbazarbd" target="_blank"><i class="fa fa-facebook"></i></a></li>
				
												<li><a href="https://www.facebook.com/groups/cbbdcommunity" target="_blank"><i class="fa fa-users"></i></a></li>
												
												<li><a href="mailto:chowkbazarbd@gmail.com" target="_blank"><i class="fa fa-envelope"></i></a></li>
												
											</ul>
				
										</div>
								</div>
						
					</div>
				
					<!-- Button trigger modal -->

	  
	  <!-- Modal -->
	  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLongTitle">About</h5>
			
			</div>
			<div class="modal-body">
					{!! App\About::select('text')->first()->text !!}
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>

					{{-- <div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About</h2>
							
						</div>
					</div> --}}
				</div>
			</div>
		</div>

		

		<div class="footer-bottom">

			<div class="container">

				<div class="row">

					<p class="pull-left">Copyright © 2019 chowkbazarbd.com All rights reserved.</p>

					

				</div>

			</div>

		</div>

		

	</footer><!--/Footer-->

	

	<script src="{{asset('js/jquery.js')}}"></script>

	<script src="{{asset('js/bootstrap.min.js')}}"></script>

	<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>

	<script src="{{asset('js/price-range.js')}}"></script>

	<script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>

	<script src="{{asset('js/main.js')}}"></script>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  @yield('script')

  <script>
    

    $(window).on('load', function() {

$('body').on('click', function(){
	$('#countryList').hide();

});
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
	$('#search_box').keyup(function(e){ 
		$('#countryList').show();
		if(e.keyCode == 8){
		$('#countryList').html('');
		var query = $(this).val();

		}else{

        var query = $(this).val();
		}
		console.log(query);
        if(query.length >= 3)
        {
         
         $.ajax({
          url:"{{ route('product.search') }}",
          method:"get",
          data:{query:query, _token:'{{csrf_field()}}'},
          success:function(data){
			 
           $('#countryList').fadeIn();  

                    $('#countryList').html(data);
          }
         });
        }
    });
	});


  
    </script>

</body>

</html>