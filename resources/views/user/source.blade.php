@extends('layouts.app')

@section('title', 'Source Product')

@section('content')
<div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="row">
        <form class="form-horizontal" id="source-form" action="{{route('product.source.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>
            
            <!-- Form Name -->
            <legend>Source Product</legend>
            
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Your Name</label>  
              <div class="col-md-5">
              <input id="name" name="name" type="text" placeholder="Enter Your Name" class="form-control input-md" required="">
                
              </div>
            </div>
            
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="phone">Your Phone</label>  
              <div class="col-md-5">
              <input id="phone" name="phone" type="text" placeholder="Enter Your Phone Number" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                    <label class="col-md-4 control-label" for="url">Alibaba URL</label>  
                    <div class="col-md-5">
                    <input id="url" name="url" type="text" placeholder="Enter Alibaba URL" class="form-control input-md" >
                      
                    </div>
                  </div>
            
            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="description">Product Description</label>
              <div class="col-md-5">                     
                <textarea class="form-control" id="description" name="description"></textarea>
              </div>
            </div>

            <!-- File Button --> 
            <div class="form-group">
                <label class="col-md-4 control-label" for="image">Select image(s)</label>
                <div class="col-md-4">
                <input id="image" name="image[]" class="input-file" accept="image/x-png,image/gif,image/jpeg" type="file" multiple>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                <button type="submit" id="singlebutton" class="btn btn-success">Submit</button>
                </div>
            </div>
            
            </fieldset>
            </form>
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
        
        $(document).ready(function(){
   

            $( "#source-form" ).submit(function( event ) {
                var $fileUpload = $("input[type='file']");
                if (parseInt($fileUpload.get(0).files.length)>2){
                alert("You can only upload a maximum of 3 files");
                    event.preventDefault();
                }
                    
            });
            
            });
        
        </script>

@endsection