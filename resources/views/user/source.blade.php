@extends('layouts.app')

@section('title', 'Source Product')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
form, div, #product_description{
    font-size: initial;
}
input[type="text"], input[type="number"], input[type="file"] {
    font-size:18px;
}



</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
        @endif
    <div class="row">
        <form class="form-horizontal needs-validation col-lg-12 col-md-12" novalidate id="source-form" action="{{route('product.source.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
           
            
            <!-- Form Name -->
         
            
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Your Name</label>  
              <div class="col-md-5">
              <input id="user_name" name="user_name" type="text" placeholder="Enter Your Name" class="form-control input-md" required="">
                <div class="invalid-feedback">
                    Please Enter Your Name
                </div>
              </div>
            </div>
            
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="phone">Your Phone</label>  
              <div class="col-md-5">
              <input id="user_phone" name="user_phone" type="text" placeholder="Enter Your Phone Number" class="form-control input-md" required="" minlength="11">
              <div class="invalid-feedback">
                Please Enter Your valid Phone Number
            </div>
              </div>
            </div>

            
            <!-- Text input-->
            <div class="form-group">
                    <label class="col-md-4 control-label" for="url">Product Name</label>  
                    <div class="col-md-5">
                    <input id="product_name" name="product_name" type="text" placeholder="Enter Product Name" class="form-control input-md" required>
                    <div class="invalid-feedback">
                        Please Enter Product Name
                    </div>
                    </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                    <label class="col-md-4 control-label" for="url">Product Quantity</label>  
                    <div class="col-md-5">
                    <input id="product_quantity" name="product_quantity" type="number" placeholder="Enter Product Quantity" min="0" class="form-control input-md" required>
                    <div class="invalid-feedback">
                        Please Enter Product Quantity
                    </div>
                    </div>
            </div>
            
            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="description">Product Description</label>
              <div class="col-md-5">                     
                <textarea class="form-control" id="product_description" name="product_description"></textarea>
              </div>
            </div>
<!-- Text input-->
<div class="form-group">
    <label class="col-md-4 control-label" for="url">Alibaba URL</label>  
    <div class="col-md-5">
    <input id="product_url" name="product_url" type="text" placeholder="Enter Alibaba URL" class="form-control input-md" >
      
    </div>
</div>
            <!-- File Button --> 
            <div class="form-group">
                <label class="col-md-4 control-label" for="file">Select image(s)</label>
                <div class="col-md-4">
                <input id="file" name="file[]" class="input-file" accept="image/x-png,image/gif,image/jpeg" type="file" multiple>
                <div class="help-block">
                    Maximum 5 Images
                </div>
            </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-5">
                <button type="submit" class="btn btn-success btn-lg pull-right">Submit</button>
                </div>
            </div>
            
         
            </form>
    </div>
</div>
<div class="mb-4"></div>
@endsection





@section('script')

    	<script src="{{asset('js/jquery.js')}}"></script>

		<script src="{{asset('js/bootstrap.min.js')}}"></script>

		<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>

		<script src="{{asset('js/price-range.js')}}"></script>

    	<script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>

		<script src="{{asset('js/main.js')}}"></script>
        
        <script>
        (function() {
  'use strict';
  window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {

        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
        $(document).ready(function(){
   

            $( "#source-form" ).submit(function( event ) {

               
                    var phoneno = /^(?:\+88|01)?(?:\d{11}|\d{13})$/;
                    if($('#user_phone').val().match(phoneno)) {
                        $('#user_phone').removeClass('is-invalid');
                        
                    }
                    else {
                        alert("Please Enter a Valid Number");
                        $('#user_phone').addClass('is-invalid');
                        event.preventDefault();
                       
                    }
                    


                var $fileUpload = $("input[type='file']");
                if (parseInt($fileUpload.get(0).files.length)>5){
                alert("You can only upload a maximum of 5 files");
                    event.preventDefault();
                }


                    
            });
            
            });
        
        </script>

@endsection