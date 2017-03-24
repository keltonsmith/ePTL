<div class="form-title row-table text-500 mt-30">
    <div class="col-cell cell-icon">
        <i class="zmdi zmdi-n-3-square text-muted mr-5"></i>
    </div>
    <div class="col-cell pl-10">
        Site Visit Pictures
    </div>
</div>


<hr class="mt-10 mb-30">

<div class="panel panel-table mb-30 mt-10">
    <table class="datatabless td-middle table ma-0">
        <tr>
            <td>
                Gambar Lokasi
            </td>
            <td>
                @if (count($file_paths) < 1)
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"><i
                                class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename"></span>
                    </div>

                    <a data-toggle="modal" data-target=".bd-example-modal-lg" class="input-group-addon btn btn-default fileinput-exists preview-image-a">{{trans('apply.files.buttons.preview')}}</a>

                    <span class="input-group-addon btn btn-default btn-file text-400">
                        <span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>
                        <span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>
                        {!! Form::file('files[]', array("class" => "preview-image-input")) !!}
                    </span>
                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                            data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>
                </div>
                <div class="add-more-file-div" style="width: calc(100% - 20px); text-align: center; margin-top: 10px;">
                    <a class="btn btn-default" id="add-more-but">{{trans('apply.files.buttons.add')}}</a>
                </div>
                {!! Form::hidden('files_cnt', 1) !!}
                @else
                @foreach($file_paths as $each_file)
                <div class="fileinput input-group fileinput-exists" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"><i
                                class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename">{{ $each_file->multipath }}</span>
                    </div>

                    <a data-toggle="modal" data-target=".bd-example-modal-lg" class="input-group-addon btn btn-default fileinput-exists preview-existing-image-a" data-inspection="{{ $each_file->inspection_id }}" data-path="{{ $each_file->multipath }}">{{trans('apply.files.buttons.preview')}}</a>

                    <span class="input-group-addon btn btn-default btn-file text-400">
                        <span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>
                        <span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>
                        {!! Form::file('files[]', old($each_file->multipath, array("class" => "preview-image-input"))) !!}
                    </span>
                    <input type="hidden" class="existing-files-path" name="existing-files[]" value="{{ $each_file->multipath }}">
                    <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                            data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>
                </div>
                @endforeach
                <div class="add-more-file-div" style="width: calc(100% - 20px); text-align: center; margin-top: 10px;">
                    <a class="btn btn-default" id="add-more-but">{{trans('apply.files.buttons.add')}}</a>
                </div>
                {!! Form::hidden('files_cnt', count($file_paths)) !!}
                @endif

                {{--<div class="fileinput fileinput-new input-group mt-5" data-provides="fileinput">--}}
                    {{--<div class="form-control" data-trigger="fileinput"><i--}}
                                {{--class="glyphicon glyphicon-file fileinput-exists"></i>--}}
                        {{--<span class="fileinput-filename"></span>--}}
                    {{--</div>--}}

                    {{--<span class="input-group-addon btn btn-default btn-file text-400">--}}
                        {{--<span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>--}}
                        {{--<span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>--}}
                        {{--{!! Form::file('file2') !!}--}}
                    {{--</span>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                            {{--data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                            {{--data-dismiss="fileinput">{{trans('apply.files.buttons.preview')}}</a>--}}
                {{--</div>--}}

                {{--<div class="fileinput fileinput-new input-group mt-5" data-provides="fileinput">--}}
                    {{--<div class="form-control" data-trigger="fileinput"><i--}}
                                {{--class="glyphicon glyphicon-file fileinput-exists"></i>--}}
                        {{--<span class="fileinput-filename"></span>--}}
                    {{--</div>--}}
                    {{--<span class="input-group-addon btn btn-default btn-file text-400">--}}
                        {{--<span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>--}}
                        {{--<span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>--}}
                        {{--{!! Form::file('file3') !!}--}}
                    {{--</span>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                            {{--data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                            {{--data-dismiss="fileinput">{{trans('apply.files.buttons.preview')}}</a>--}}
                {{--</div>--}}

                {{--<div class="fileinput fileinput-new input-group mt-5" data-provides="fileinput">--}}
                    {{--<div class="form-control" data-trigger="fileinput"><i--}}
                                {{--class="glyphicon glyphicon-file fileinput-exists"></i>--}}
                        {{--<span class="fileinput-filename"></span>--}}
                    {{--</div>--}}

                    {{--<span class="input-group-addon btn btn-default btn-file text-400">--}}
                        {{--<span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>--}}
                        {{--<span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>--}}
                        {{--{!! Form::file('file4') !!}--}}
                    {{--</span>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                       {{--data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                            {{--data-dismiss="fileinput">{{trans('apply.files.buttons.preview')}}</a>--}}
                {{--</div>--}}

                {{--<div class="fileinput fileinput-new input-group mt-5" data-provides="fileinput">--}}
                    {{--<div class="form-control" data-trigger="fileinput"><i--}}
                                {{--class="glyphicon glyphicon-file fileinput-exists"></i>--}}
                        {{--<span class="fileinput-filename"></span>--}}
                    {{--</div>--}}
                    {{--<span class="input-group-addon btn btn-default btn-file text-400">--}}
                        {{--<span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>--}}
                        {{--<span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>--}}
                        {{--{!! Form::file('file5') !!}--}}
                    {{--</span>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                            {{--data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>--}}
                    {{--<a href="#" class="input-group-addon btn btn-default fileinput-exists"--}}
                                            {{--data-dismiss="fileinput">{{trans('apply.files.buttons.preview')}}</a>--}}
                {{--</div>--}}
            </td>
        </tr>
    </table>
</div>