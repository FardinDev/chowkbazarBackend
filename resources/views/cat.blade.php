
@foreach($childs as $child)
<ol class="dd-list">


    <li class="dd-item" data-id="1">
  
    <div class="pull-right item_actions">

        <a href="{{url('product-categories/'.$child->id)}}" title="View" class="btn btn-sm btn-warning pull-right view">
        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">View</span>
        </a>
    </div>
    <div class="dd-handle"  style="{{$sub == 1 ? '' : 'background-color:#c0c2c2'}}">
        <span  style="color:black">{{$child->name}}</span>
    </div>
    </li>

    @if(count($child->childs))
    @include('cat',['childs' => $child->childs, 'sub' => 1])
    @endif

</ol>
@endforeach

