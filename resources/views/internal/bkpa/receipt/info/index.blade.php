@extends('layouts.app')

@section('tabs')
    @include('partials.tabs', compact('tabs'))
@endsection
@section('content')
    <div class="content">
        <div class="container mt-30 mb-30 tab-content">

            @include('internal.bkpa.receipt.info.company', compact('application'))
            @include('internal.bkpa.receipt.info.project', compact('application'))

        </div>
    </div>
@include('internal._partials.documentModal')
@endsection
@push('scripts')
<script>
    $(function(){
        $(document).on('click','.documentModal',function(e){
            e.preventDefault();
//            var url = $(this).data('url');
//
//            $('#documentModal').find('iframe').attr('src', url);
//            $('#documentModal').modal();

//            var designs = $(this).data('designs');
//            var pays = $(this).data('pays');
            var name = $(this).data('name');
            var attachstr = $(this).data(name);
//            var id = $(this).data('content');
            var basic_path = $(this).data('basic');
            var attachArray = jQuery.makeArray(attachstr);
            $('iframe').remove();

            $.each(attachArray, function(key, value) {
                var image_path = basic_path+'/'+value;
                $('#documentModel-modal-body').append('<iframe id="attachment-iframe-' + key + '" src="' +
                    image_path + '" width="100%" height="auto" frameborder="0"></iframe>');
            });

            $('#documentModal').modal();

        });
    });
</script>
@endpush