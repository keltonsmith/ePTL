@extends('layouts.app')

@section('tabs')
    @include('partials.tabs', compact('tabs'))
@endsection

@section('content')
    <div class="content">
        <div class="container mt-30 mb-30 tab-content">
            @include('internal.bpo.application.info.company', compact('application'))
            @include('internal.bpo.application.info.project', compact('application'))
        </div>
    </div>
@include('internal.bpo._partials.documentModal')
@endsection

@push('scripts')
<script>
$(function(){
    $(document).on('click','.documentModal',function(e){
        e.preventDefault();
//        var url = $(this).data('url');
//        $('#documentModal').find('iframe').attr('src', url);
//        $('#documentModal').modal();

        var designs = $(this).data('designs');
        var pays = $(this).data('pays');
        var name = $(this).data('name');
//            var id = $(this).data('content');
        var basic_path = $(this).data('basic');
        var designArray = jQuery.makeArray(designs);
        var payArray = jQuery.makeArray(pays);
        $('iframe').remove();
        if(name=="designs")
        {
            $.each(designArray, function(key, value) {
                {{--var iframe = document.createElement('iframe');--}}
                {{--iframe.setAttribute('src', {{url('documents/'.$id.'/'.value)}});--}}
                //                $('#documentModel-modal-body').append('<iframe src="' +
                //                    'http://dev.com/documents/' + id + '/' + value + '" width="100%" height="auto" frameborder="0"></iframe>');
                var image_path = basic_path+'/'+value;
                $('#documentModel-modal-body').append('<iframe id="attachment-iframe-' + key + '" src="' +
                    image_path + '" width="100%" height="250px" frameborder="0"></iframe>');

//                  $('#documentModel-modal-body #attachment-iframe-' + key).load(function() {
//                      callback(this);
//                  });
//
//                  $('#documentModal').find('iframe').body.appendChild(iframe);
            });
//              $('#documentModal').find('iframe').attr('src', url);
        }
        if (name == "pays") {
            $.each(payArray, function (key, value) {
                {{--var iframe = document.createElement('iframe');--}}
                {{--iframe.setAttribute('src', {{url('documents/'.$id.'/'.value)}});--}}
                //                $('#documentModel-modal-body').append('<iframe src="' +
                //                    'http://dev.com/documents/' + id + '/' + value + '" width="100%" height="auto" frameborder="0"></iframe>');
                var image_path = basic_path + '/' + value;
                $('#documentModel-modal-body').append('<iframe id="attachment-iframe-' + key + '" src="' +
                    image_path + '" width="100%" height="auto" frameborder="0"></iframe>');

                //                $('#documentModel-modal-body #attachment-iframe-' + key).load(function() {
                //                    callback(this);
                //                });
                //
                //                $('#documentModal').find('iframe').body.appendChild(iframe);
            });
            //            $('#documentModal').find('iframe').attr('src', url);
        }
        $('#documentModal').modal();
    });
});
</script>
@endpush()