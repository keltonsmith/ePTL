@extends('layouts.app')

@section('tabs')
    @include('partials.tabs', compact('tabs'))
@endsection

@section('content')
    @include('partials/preview')
    <div class="content">
        <div class="container mt-30 mb-30 tab-content">
            @include('internal.bpo.application.info.company', compact('project'))
            @include('internal.bpo.application.info.project', compact('project'))
            @if(!empty($project->inspection))
                @include('internal.bpo.project.info.report', compact('project'))
            @endif
            @include('internal.bpo.project.info.results', compact('project'))
            @include('internal.bpo.project.info.kkr', compact('kkr'))
            @include('internal.bpo.project.info.documents', compact('document', 'project'))

        </div>
    </div>
@include('internal.bpo._partials.imageModal')
@include('internal.bpo._partials.inspectionModal')
@include('internal.bpo._partials.documentModal')
@endsection

@push('scripts')
<script>
    $(function(){
        $('#inspectionModal input').attr('readonly', true);
        $('#inspectionModal input').attr('disabled', true);
        $('#inspectionModal textarea').attr('readonly', true);
        $('#inspectionModal select').attr('disabled', true);
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
@endpush()