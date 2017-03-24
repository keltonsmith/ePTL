{{--<a href="#" class="btn btn-primary documentModal" data-url="{{url('documents/'.$id.'/'.$pay)}}">--}}
<a href="#" class="btn btn-primary documentModal" data-url="{{ $jsonObj }}" data-basic="{{url('documents/'.$id)}}">
    <font><font class="">{{$slug}}</font></font>
</a>