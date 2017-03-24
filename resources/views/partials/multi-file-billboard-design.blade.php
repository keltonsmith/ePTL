    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
        <div class="form-control" data-trigger="fileinput"><i
                    class="glyphicon glyphicon-file fileinput-exists"></i>
            <span class="fileinput-filename"></span>
        </div>

        <a data-toggle="modal" data-target=".bd-example-modal-lg" class="input-group-addon btn btn-default fileinput-exists preview-image-a">{{trans('apply.files.buttons.preview')}}</a>

        <span class="input-group-addon btn btn-default btn-file text-400">
        <span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>
        <span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>
            {!! Form::file($image_ipt_name . '[]', array("class" => "preview-image-input")) !!}
    </span>
        <a href="#" class="input-group-addon btn btn-default fileinput-exists"
           data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>
    </div>
    <div class="add-more-file-div-{{ $image_ipt_name }}" style="width: calc(100% - 20px); text-align: center; margin-top: 10px;">
        <a class="btn btn-default add-more-but" data-content="{{ $image_ipt_name }}">{{trans('apply.files.buttons.add')}}</a>
    </div>
    {!! Form::hidden('files_cnt', 1) !!}