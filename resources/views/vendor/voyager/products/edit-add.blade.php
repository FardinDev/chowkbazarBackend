@php
$edit = !is_null($dataTypeContent->getKey());
$add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{asset('css/selectize.default.css')}}">
@stop


@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular) 

@section('page_header')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<h1 class="page-title">
    <i class="{{ $dataType->icon }}"></i>
    {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    @if (!$edit)
    <input type="checkbox" id="toggle-event" data-on="With Alibaba Link" data-off="Add Manually" data-width="200" data-on="Enabled" checked data-toggle="toggle">
    @endif
    @if ($edit)
    <a href="#" class="badge badge-info">{{$dataTypeContent->type == 0 ? 'Manualy Added Product' : 'Alibaba Product'}}</a>
    @endif
    
    
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('content')

{{-- <input type="text" id="input-tags" class="demo-default selectized" value="" tabindex="-1"> --}}
<div class="page-content edit-add container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form role="form" class="form-edit-add"
                    action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                    method="POST" enctype="multipart/form-data">
                    <!-- PUT Method if we are editing -->
                    @if($edit)
                    {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel-body">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group  col-md-12 " id="url">

                            <label class="control-label" for="name">URL (Only alibaba.com's product URL)</label>
                            <input type="text" class="form-control" name="web_url" step="any"
                                placeholder="Enter URL"
                                value="{{$dataTypeContent->web_url != null ? $dataTypeContent->web_url :  old('web_url') }}"
                                {{$edit ? 'readonly' : ''}}>

                        </div>
                        <div class="form-group  col-md-12 ">

                            <label class="control-label" for="name">Tags</label>
                            {{-- <input type="text" class="form-control" name="url" required="true" step="any" placeholder="Enter URL" value="{{$dataTypeContent->web_url != null ? $dataTypeContent->web_url : ''}}">
                            --}}
                            <input type="text" id="input-tags" name="tags" class="demo-default selectized"
                                value="{{$dataTypeContent->tags != null ? $dataTypeContent->tags : old('tags')}}">


                        </div>

                        
                        {{-- @foreach ($dataTypeContent->other_images as $item)
                            {{$item}}
                            @endforeach --}}
                            
                            @php $images = json_decode($dataTypeContent->other_images); @endphp
                            
                            <!-- @if($images)
                            <div class="form-group  col-md-12 ">
                            <label class="control-label" for="name">Other Images</label>
                            <br>



                            @foreach($images as $image)

                            <div class="img_settings_container" data-field-name="other_images"
                                style="float:left;padding-right:15px;">
                                <a href="#" class="voyager-x remove-multi-image" style="position: absolute;"></a>
                                <img src="{{$image}}" data-file-name="{{$image}}" data-id="{{$dataTypeContent->id}}"
                                    style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
                            </div>
                            @endforeach

                            <div class="clearfix"></div>


                        </div>
                            @endif -->


                        <!-- Adding / Editing -->
                        @php
                        $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                        @endphp

                        @foreach($dataTypeRows as $row)
                        <!-- GET THE DISPLAY OPTIONS -->
                        @php
                        $display_options = $row->details->display ?? NULL;
                        if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                        }
                        @endphp
                        @if (isset($row->details->legend) && isset($row->details->legend->text))
                        <legend class="text-{{ $row->details->legend->align ?? 'center' }}"
                            style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">
                            {{ $row->details->legend->text }}</legend>
                        @endif
                        <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}"
                            @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                            {{ $row->slugify }} 
                            <label class="control-label" for="name">{{ $row->display_name }}</label>
                            @include('voyager::multilingual.input-hidden-bread-edit-add')
                            @if (isset($row->details->view))
                            @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' =>
                            $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit'
                            : 'add')])
                            @elseif ($row->type == 'relationship')
                            @include('voyager::formfields.relationship', ['options' => $row->details])
                            @else
                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                            @endif

                            @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                            @endforeach
                            @if ($errors->has($row->field))
                            @foreach ($errors->get($row->field) as $error)
                            <span class="help-block">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        @endforeach



                    </div><!-- panel-body -->
                    <div class="panel-body">
                    <div class="container1">
                    
                            <div class="row">
                                <div class="form-group  col-md-2 text-info">
                                    <label class="control-label" for="name">Attribute Title 1</label>
                                    <input type="text" class="form-control" name="atribute_title[]" placeholder="Attribute Title 1" value="">
                                </div>
                                <div class="form-group  col-md-2 text-info">
                                    <label class="control-label" for="name">Attribute Value 1</label>
                                    <input type="text" class="form-control" name="atribute_value[]" placeholder="Attribute Value 1" value="">
                                </div>
                            </div>
                    </div>
                    
                    <button class="add_form_field btn btn-primary mb-2">Add New Attribute &nbsp; 
                        <span style="font-size:16px; font-weight:bold;">+ </span>
                    </button>
                    </div>
                    
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>

                <iframe id="form_target" name="form_target" style="display:none"></iframe>
                <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                    enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                    <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
                    <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }}? </h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete File Modal -->
@stop
<script>
</script>

@section('javascript')
<script type="text/javascript" src="{{asset('js/microplugin.js')}}"></script>
<script type="text/javascript" src="{{asset('js/selectize.js')}}"></script>

<script>
    $(function () {
        $('#input-tags').selectize({
            delimiter: ',',
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
    });
    var params = {};
    var $file;
    function deleteHandler(tag, isMulti) {
        return function () {
            $file = $(this).siblings(tag);
            params = {
                slug: '{{ $dataType->slug }}',
                filename: $file.data('file-name'),
                id: $file.data('id'),
                field: $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }
            // $('.confirm_delete_name').text(params.filename);
            $('.del-img').attr('src', params.filename);
            $('#confirm_delete_modal').modal('show');
        };
    }
    $('document').ready(function () {
        $('.toggleswitch').bootstrapToggle();
        //Init datepicker for date fields if data-datepicker attribute defined
        //or if browser does not handle date inputs
        $('.form-group input[type=date]').each(function (idx, elt) {
            if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                elt.type = 'text';
                $(elt).datetimepicker($(elt).data('datepicker'));
            }
        });
        @if($isModelTranslatable)
        $('.side-body').multilingual({
            "editing": true
        });
        @endif
        $('.side-body input[data-slug-origin]').each(function (i, el) {
            $(el).slugify();
        });
        $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
        $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
        $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
        $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));
        $('#confirm_delete').on('click', function () {
            console.log(params);
            console.log('hi');
            $.post('{{ route('voyager.media.remove') }}', params,
                function (response) {
                    if (response &&
                        response.data &&
                        response.data.status &&
                        response.data.status == 200) {
                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });
            $('#confirm_delete_modal').modal('hide');
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@if (!$edit)
<script>
    $(function() {
        $('#name').hide();
        $('#primary_image').hide();
        $('#other_images').hide();
        $('#description').hide();
      $('#toggle-event').change(function() {
        $('#name').toggle();
        $('#primary_image').toggle();
        $('#other_images').toggle();
        $('#description').toggle();
        $('#url').toggle();
        // alert('hi');
      })
      var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append(`<div class="row d-flex flex-column">
                                <div class="form-group  col-md-2 text-info">
                                    <label class="control-label" for="name">Attribute Title `+x+`</label>
                                    <input type="text" class="form-control" name="atribute_title[]" placeholder="Attribute Title `+x+`" value="">
                                </div>
                                <div class="form-group  col-md-2 text-info">
                                    <label class="control-label" for="name">Attribute Value `+x+`</label>
                                    <input type="text" class="form-control" name="atribute_value[]" placeholder="Attribute Value `+x+`" value="">
                                </div>
                                
                                <a href="#" class="delete align-self-end btn btn-danger mt-auto">Delete</a>
                            </div>`); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
    })
</script>
    
@endif
@stop