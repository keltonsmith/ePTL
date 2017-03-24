@extends('layouts.app')

@section('content')
    @include('internal._partials.preview')
    <div class="content">
        <div class="container mt-30 mb-30">

            @include('internal.pw.project.questions._partials.top');

            <div class="row row-10">
                <div class="column col-sm-10 col-sm-offset-1">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Any duplicates application on the same location
                                ?</label>
                            <div class="col-sm-8">
                                <div class="radio">
                                    <input type="radio" id="apply-1" name="apply" checked="">
                                    <label for="apply-1">Yes</label>&nbsp;&nbsp;
                                    <input type="radio" id="apply-1" name="apply" checked="">
                                    <label for="apply-1">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">If yes, please state duplicate's Application
                                No</label>
                            <div class="col-sm-3">
                                {!! Form::text('duplicates', old('duplicates'), ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end.row-->

            <div class="form-title row-table text-500 mt-30">
                <div class="col-cell cell-icon">
                    <i class="zmdi zmdi-n-2-square text-muted mr-5"></i>
                </div>
                <div class="col-cell pl-10">
                    Site Inspection Checklist
                </div>
            </div>

            <hr class="mt-10 mb-30">

            <div class="panel panel-table mb-30 mt-10">
                <table class="datatabless td-middle table ma-0">
                    <thead>
                    <tr>
                        <th class="tight">No.</th>
                        <th width="350">Description</th>
                        <th>Compliance Status</th>
                        <th>Notes</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if ($compliance_status == null)
                    @foreach(trans('pw.questions.ad') as $questionNum => $question)
                    <tr>
                        <td class="tight">{{$question['no']}}</td>
                        <td>{{$question['description']}}</td>
                        <td>
                            @foreach($question['statuses'] as $no => $status)
                                <div class="radio">
                                    <input type="radio"
                                           id="q{{$questionNum}}_{{$no}}"
                                           name="q{{$questionNum}}"
                                           value="{{$status['value']}}"
                                    @if(old('q'.$questionNum) == $no)
                                        {{'checked=checked'}}@endif
                                    >
                                    {!! Form::label('q'.$questionNum.'_'.$no, $status['text']) !!}
                                </div>
                            @endforeach
                        </td>
                        <td class="text-right">
                            {!! Form::textarea(
                            'q'.$questionNum.'_note',
                            old('q'.$questionNum.'_note'),
                            ['rows' => 3, 'cols' => 30]) !!}
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @foreach(trans('pw.questions.ad') as $questionNum => $question)
                    <tr>
                        <td class="tight">{{$question['no']}}</td>
                        <td>{{$question['description']}}</td>
                        <td>
                            @foreach($question['statuses'] as $no => $status)
                                <div class="radio">
                                    <input type="radio"
                                           id="q{{$questionNum}}_{{$no}}"
                                           name="q{{$questionNum}}"
                                           value="{{$status['value']}}"
                                    @if($compliance_status{'q'.$questionNum} == ($no+1))
                                        {{'checked=checked'}}@endif
                                    >
                                    {!! Form::label('q'.$questionNum.'_'.$no, $status['text']) !!}
                                </div>
                            @endforeach
                        </td>
                        <td class="text-right">
                            {!! Form::textarea(
                            'q'.$questionNum.'_note',
                            $compliance_status{'q'.$questionNum.'_note'},
                            ['rows' => 3, 'cols' => 30]) !!}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            @include('internal.pw.project.questions._partials.files')
            @include('internal.pw.project.questions._partials.bottom')
        </div>
    </div>
@endsection

@section('script')
<script>
    // Initialize the datePicker
    $("#datepicker").pickadate({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true,
        datepicker: true
    });

    $(document).ready(function () {
        $('#add-more-but').click(function() {
            var last_div = $('.add-more-file-div').prev(), last_file_ipt = $(last_div).find("input");
//            var last_ipt_name = $(last_file_ipt[0]).attr('name'), cur_ipt_cnt = parseInt(last_ipt_name.replace( /[^\d.]/g, '' )), new_ipt_name = 'file' + (cur_ipt_cnt + 1).toString();

            var new_file_div = '<div class="fileinput fileinput-new input-group" data-provides="fileinput">' +
                                    '<div class="form-control" data-trigger="fileinput"><i' +
                                    'class="glyphicon glyphicon-file fileinput-exists"></i>' +
                                        '<span class="fileinput-filename"></span>' +
                                    '</div>' +
                                    '<a data-toggle="modal" data-target=".bd-example-modal-lg" class="input-group-addon btn btn-default fileinput-exists preview-image-a"' +
                                    '>{{trans('apply.files.buttons.preview')}}</a>' +
                                    '<span class="input-group-addon btn btn-default btn-file text-400">' +
                                        '<span class="fileinput-new">{{trans('apply.files.buttons.select')}}</span>' +
                                        '<span class="fileinput-exists">{{trans('apply.files.buttons.change')}}</span>' +
                                        '{!! Form::file("files[]", array("class" => "preview-image-input")) !!}' +
                                    '</span>' +
                                    '<a href="#" class="input-group-addon btn btn-default fileinput-exists"' +
                                    'data-dismiss="fileinput">{{trans('apply.files.buttons.remove')}}</a>' +
                                    '</div>';
            $(last_div).after(new_file_div);
//            $(last_div).next().find("input").attr('name', new_ipt_name);
//            $('.add-more-file-div').next().val(cur_ipt_cnt + 1);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-modal-img-description').text('Name: ' + input.files[0].name + ', Type: ' + input.files[0].type);
                    $('#preview-modal-img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('click', '.preview-image-a', function() {
            var img_ipt = $(this).next().find('input.preview-image-input');
            readURL(img_ipt[0]);
        });


        $(document).on('click', '.preview-existing-image-a', function() {
            var img_path = $(this).attr('data-path');
            var inspection_id = $(this).attr('data-inspection');
            $('#preview-modal-img').attr('src', '/inspections/' + inspection_id + '/' + img_path);
        });
    });
</script>
@endsection