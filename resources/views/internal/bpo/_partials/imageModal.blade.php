@if($file_paths != null)
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <div class="row-table">
                    <b class="col-cell">
                        <!--{{trans('bkpa.procedure_guide')}}-->Inspection Form
                    </b>

                    <div class="col-cell cell-tight"data-dismiss="modal" >
                        <i class="zmdi zmdi-close text-muted size-20" style="vertical-align: middle; cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-body clearfix">
                    @foreach($file_paths as $file)
                    <img class="col-md-4" src="/inspections/{{$file->inspection_id}}/{{$file->multipath}}">
                    @endforeach
                    <div class="clearfixs"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.close')}}</button>
            </div>
        </div>
    </div>
</div>
@endif